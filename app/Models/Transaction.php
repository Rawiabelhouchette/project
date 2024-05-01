<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // $table->foreignId('abonnement_id')->constrained();
    // $table->double('montant');
    // $table->string('trans_id');
    // $table->string('method');
    // $table->string('pay_id');
    // $table->string('buyer_name');
    // $table->string('trans_status');
    // $table->string('signature');
    // $table->string('phone');
    // $table->string('error_message');
    // $table->string('statut');
    // $table->dateTime('date_creation');
    // $table->dateTime('date_modification');
    // $table->dateTime('date_paiement');

    protected $fillable = [
        'abonnement_id',
        'montant',
        'trans_id',
        'method',
        'pay_id',
        'buyer_name',
        'trans_status',
        'signature',
        'phone',
        'error_message',
        'statut',
        'date_creation',
        'date_modification',
        'date_paiement',
        'user_id',
    ];
}
