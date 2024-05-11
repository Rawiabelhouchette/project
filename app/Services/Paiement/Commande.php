<?php
namespace App\Services\Paiement;

use App\Models\Abonnement;
use App\Models\Transaction;
use App\Models\User;

class Commande
{
    public $_montant;
    public $_transId;
    public $_methode;
    public $_payId;
    public $_buyerName;
    public $_transStatus;
    public $_signature;
    public $_phone;
    public $_errorMessage;
    public $_statut;
    public $_dateCreation;
    public $_dateModification;
    public $_datePaiement;

    public $entreprise;
    public $offre_id;
    public $numero_telephone;
    public $numero_whatsapp;

    public function getCurrentUrl()
    {
       return  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
        
    }

    public function create()
    {
        // Création d'une nouvelle commande
        Transaction::create([
            'abonnement_id' => Abonnement::inRandomOrder()->first()->id,
            'montant' => $this->_montant,
            'trans_id' => $this->_transId,
            'method' => $this->_methode,
            'pay_id' => $this->_payId,
            'buyer_name' => $this->_buyerName,
            'trans_status' => $this->_transStatus,
            'signature' => $this->_signature,
            'phone' => $this->_phone,
            'error_message' => $this->_errorMessage,
            'statut' => $this->_statut,
            'date_creation' => $this->_dateCreation,
            'date_modification' => $this->_dateModification,
            'date_paiement' => $this->_datePaiement,
            'user_id' => auth()->user()->id,

            'entreprise' => $this->entreprise,
            // 'offre_id' => $this->offre_id,
            'numero' => $this->numero_telephone,
            'numero_whatsapp' => $this->numero_whatsapp,
        ]);
    }

    public function update()
    {
        // Mise à jour d'une ligne spécifique
    }

    public function getCommandeByTransId()
    {
        // Recuperation d'une commande par son $_transId
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->_montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->_montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getTransId()
    {
        return $this->_transId;
    }

    /**
     * @param mixed $transId
     */
    public function setTransId($transId)
    {
        $this->_transId = $transId;
    }

    /**
     * @return mixed
     */
    public function getMethode()
    {
        return $this->_methode;
    }

    /**
     * @param mixed $methode
     */
    public function setMethode($methode)
    {
        $this->_methode = $methode;
    }

    /**
     * @return mixed
     */
    public function getPayId()
    {
        return $this->_payId;
    }

    /**
     * @param mixed $payId
     */
    public function setPayId($payId)
    {
        $this->_payId = $payId;
    }

    /**
     * @return mixed
     */
    public function getBuyerName()
    {
        return $this->_buyerName;
    }

    /**
     * @param mixed $buyerName
     */
    public function setBuyerName($buyerName)
    {
        $this->_buyerName = $buyerName;
    }

    /**
     * @return mixed
     */
    public function getTransStatus()
    {
        return $this->_transStatus;
    }

    /**
     * @param mixed $transStatus
     */
    public function setTransStatus($transStatus)
    {
        $this->_transStatus = $transStatus;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->_signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->_signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->_statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->_statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getDateModification()
    {
        return $this->_dateModification;
    }

    /**
     * @param mixed $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->_dateModification = $dateModification;
    }

    /**
     * @return mixed
     */
    public function getDatePaiement()
    {
        return $this->_datePaiement;
    }

    /**
     * @param mixed $datePaiement
     */
    public function setDatePaiement($datePaiement)
    {
        $this->_datePaiement = $datePaiement;
    }
}