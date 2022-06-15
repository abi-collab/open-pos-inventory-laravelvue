<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoiceimages extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'invoiceimg'
   ];
    
}
