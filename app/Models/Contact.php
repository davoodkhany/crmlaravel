<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable =['name', 'family', 'email', 'mobile', 'responsible'] ;

    public function companies(){
        return $this->belongsToMany(Company::class ,'company_contact');
    }

    public function user(){
        return $this->hasMany(User::class);
    }



}