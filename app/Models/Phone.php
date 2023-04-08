<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'verified', 'verification_code'];
    public function user(){
        return $this->hasOne(User::class);
    }
}
