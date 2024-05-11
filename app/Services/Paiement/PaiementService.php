<?php
namespace App\Services\Paiement;

use App\Models\User;
use App\Services\Paiement\CinetPay;
use App\Services\Paiement\Commande;
use Exception;

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


            $notify_url = 'http://mondomaine.com/notify/';
            $return_url = 'http://mondomaine.com/return/';

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
}