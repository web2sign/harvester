<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;


    protected $fillable = [
        'harvest_token',
        'account_id',
        'rate',
        'payment_method',
        'account_details',
        'address',
        'invoice_number',
        'invoice_prefix',
    ];


    public $timestamps = false;

}
