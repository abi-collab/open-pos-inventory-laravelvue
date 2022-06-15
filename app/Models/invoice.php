<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    public $table = 'purchases';
    protected $guarded = []; 

    protected $fillable = 
    ['customer_ID',
       'amount_due',
       'order_id',
       'ID',
       'createdBy',
       'transaction_date',
       'time'

];

    protected $casts = ['order_details' => 'array'];
}
