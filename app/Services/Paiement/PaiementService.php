<?php
namespace App\Services\Paiement;

use App\Models\Entreprise;
use App\Models\OffreAbonnement;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Paiement\CinetPay;
use App\Services\Paiement\Commande;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PaiementService
{
    public static function getGuichet($amount, $user_id, $validated)
    {
        $user = User::find($user_id);

        if (!$user) {
            return (object) [
                'status' => 'error',
                'message' => 'Utilisateur non trouvé',
                'url' => null,
            ];
        }

        // La class gère la table "Commande"( A titre d'exemple)
        $commande = new Commande();
        try {
            $commande->entreprise = $validated['nom_entreprise'];
            $commande->numero = $validated['numero_telephone'];
            $commande->numero_whatsapp = $validated['numero_whatsapp'];

            $customer_name = $user->prenom;
            $customer_surname = $user->nom;
            $description = 'description';
            $customer_phone_number = $user->telephone ?? '90 90 90 90';
            $customer_email = $user->email;
            $customer_address = 'adresse';
            $customer_city = 'Togo';
            $customer_state = 'TG';
            $customer_country = 'TG';
            $customer_zip_code = '1234';
            $currency = 'XOF';


            //transaction id
            $id_transaction = date("YmdHis"); // or $id_transaction = Cinetpay::generateTransId()

            //Veuillez entrer votre apiKey
            $apikey = env("CP_API_KEY");
            //Veuillez entrer votre siteId
            $site_id = env("CP_SITE_ID");


            $notify_url = route('payment.notification');
            $return_url = route('payment.return');

            // //notify url
            // $notify_url = $commande->getCurrentUrl() . 'cinetpay-sdk-php/notify/notify.php';
            // //return url
            // $return_url = $commande->getCurrentUrl() . 'cinetpay-sdk-php/return/return.php';
            // // $channels = "ALL";
            $channels = 'MOBILE_MONEY,CREDIT_CARD';


            /*information supplémentaire que vous voulez afficher
             sur la facture de CinetPay(Supporte trois variables 
             que vous nommez à votre convenance)*/
            $invoice_data = array(
                "Nom" => $customer_name . ' ' . $customer_surname, // exemple 'Nom' => 'Doe John',
                "Email" => $customer_email,
                "Data 3" => ""
            );

            //
            $formData = array(
                "transaction_id" => $id_transaction,
                "amount" => $amount,
                "currency" => $currency,
                "customer_surname" => $customer_name,
                "customer_name" => $customer_surname,
                "description" => $description,
                "notify_url" => $notify_url,
                "return_url" => $return_url,
                "channels" => $channels,
                "invoice_data" => $invoice_data,
                //pour afficher le paiement par carte de credit
                "customer_email" => $customer_email,
                "customer_phone_number" => $customer_phone_number,
                "customer_address" => $customer_address, // adresse du client
                "customer_city" => $customer_city, //La ville du client
                "customer_country" => $customer_country, //Le pays du client
                "customer_state" => $customer_state, //L'etat du client
                "customer_zip_code" => $customer_zip_code, //Le code postal du client
            );
            // enregistrer la transaction dans votre base de donnée
            /*  $commande->create(); */

            $CinetPay = new CinetPay($site_id, $apikey, $VerifySsl = false);//$VerifySsl=true <=> Pour activerr la verification ssl sur curl 
            $result = $CinetPay->generatePaymentLink($formData);

            if ($result["code"] == '201') {
                $url = $result["data"]["payment_url"];


                // ==================
                $commande->_montant = $amount;
                $commande->_transId = $id_transaction;
                $commande->_method = $channels;
                $commande->_payId =
                    $commande->_buyerName = $customer_name . ' ' . $customer_surname;
                // $commande->_transStatus = '';
                // $commande->_signature = '';
                $commande->_phone = $customer_phone_number;
                // $commande->_errorMessage = '';
                // $commande->_statut = '';
                // $commande->_dateCreation = date('Y-m-d H:i:s');
                // $commande->_dateModification = date('Y-m-d H:i:s');
                // $commande->_datePaiement = '';



                // ajouter le token à la transaction enregistré
                /* $commande->update(); */
                //redirection vers l'url de paiement
                // header('Location:' . $url);

                $commande->create();

                return (object) [
                    'status' => 'success',
                    'message' => 'Guihchet généré avec succès',
                    'url' => $url,
                ];

            }
        } catch (Exception $e) {
            return (object) [
                'status' => 'error',
                'message' => $e->getMessage(),
                'url' => null,
            ];
        }
    }

    public static function afterPayment(Request $request)
    {
        if (!$request->transaction_id && !$request->token) {
            abort(403, "transaction_id non transmis");
        }

        // check payment and return to staff is it's success

        return redirect()->route('pricing');
    }

    public function notify(Request $request)
    {
        // check if request contains transaction_id
        if (!$request->cpm_trans_id) {
            abort(403, "transaction_id non transmis");
        }
        
        DB::beginTransaction();

        try {
            // concatenate all the parameters
            $data_post = implode('', $request->all());

            // create token with HMAC-SHA256 method with a secret key
            $generated_token = hash_hmac('SHA256', $data_post, env('CP_SECRET_KEY'));

            // check if token is available in the header
            if ($request->header('X-Token')) {
                $xtoken = $request->header('X-Token');
            } else {
                abort(403, "X-token indisponible");
            }

            // check if the token is valid
            if (!hash_equals($xtoken, $generated_token)) {
                abort(403, "Token invalide");
            }

            // check if the transaction is valid in DB
            $transaction = Transaction::where('trans_id', $request->cpm_trans_id)->where('signature', $request->signature)->first();
            // -1 : error
            //  0  : pending
            //  1  : success
            if ($transaction == 1) {
                abort(403, "Transaction déjà effectuée");
            }

            // check if the transaction is valid
            $check_transaction = self::checkPayment($request->cpm_trans_id);
            if ($check_transaction->code != '00') {
                // session flash message
                session()->flash('error', 'Echec, votre paiement a échoué');
                abort(403, "Echec, votre paiement a échoué");
            }

            // update the transaction
            $transaction->update([
                'statut' => 1,
                'date_modification' => date('Y-m-d H:i:s'),
                'date_paiement' => date('Y-m-d H:i:s'),
                // other fields
            ]);

            // check if company is valid,
            $company_name = $transaction->entreprise;

            $check_company = Entreprise::where('nom', $company_name)->where('telephone', $transaction->numero)->first();

            // check if company name already exist 
            if ($check_company) {
                // update company information
                $company_name = $company_name . rand(10, 100);
            }

            // save company information
            $company = Entreprise::create([
                'nom' => $company_name,
                'telephone' => $transaction->numero,
                'whatsapp' => $transaction->numero_whatsapp,
            ]);

            // Get the user
            $user = User::find($transaction->user_id);

            // set the user entreprise_id
            $user->entreprises()->attach($company->id, [
                'is_admin' => true,
                'is_active' => true,
                'date_debut' => now(),
            ]);


            // Get offre dabonnement
            $offre_abonnement = OffreAbonnement::find($transaction->offre_id);

            // Create a new subscription for the company
            $subscription = $company->abonnements()->create([
                'offre_id' => $offre_abonnement->id,
                'date_debut' => date('Y-m-d H:i:s'),
                'date_fin' => date('Y-m-d H:i:s', strtotime('+' . $offre_abonnement->duree . ' month')),
            ]);

            // link the abonnement to the entreprise
            $subscription->entreprises()->attach($company->id);

            // remove role Usager
            $user->removeRole('Usager');
            $user->assignRole('Professionnel');

            // send email to the company and admin


            // logging in subscription channel
            $message = "New subscription from " . $company->nom . " with offer " . $offre_abonnement->libelle . " (" + $offre_abonnement->prix + ")at " . date('Y-m-d H:i:s') . "\n Subscritpion ID: " . $subscription->id . "\n Transaction ID: " . $transaction->id;
            Log::channel('subscription')->info($message);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            // Mail to admin
        }
    }

    public static function checkPayment($transaction_id)
    {
        $response = Http::
            withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post('https://api-checkout.cinetpay.com/v2/payment/check', [
                'transaction_id' => $transaction_id,
                'site_id' => env('CP_SITE_ID'),
                'apikey' => env('CP_API_KEY'),
            ]);

        return (object) $response->json();
    }
}