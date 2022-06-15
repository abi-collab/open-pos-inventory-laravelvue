<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serial extends Model
{
    use HasFactory;

    protected $fillable = [
         'ssku','serialnumber','petsa','orderno','orderdate','returnno','remarks','customerid','imageid','returnStatus','authoredBy','ser_createdBy','ser_updatedBy','ser_updatedAt'
    ];
}
