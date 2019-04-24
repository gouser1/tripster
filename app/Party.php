<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'party';
    // Primary Key
    public $primaryKey = 'party_id';
    // Timestamps
    public $timestamps = true; 

    // Fillable properties 
    protected $fillable = [
        'party_name'
    ];
}