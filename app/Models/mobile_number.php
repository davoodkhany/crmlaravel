<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobile_number extends Model
{
    use HasFactory;

    protected $fillable = ['verification_code' , 'verified','user_id','user_id'];
}