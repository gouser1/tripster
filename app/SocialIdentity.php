<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialIdentity extends Model
{
    protected $fillable = ['id', 'provider_name', 'provider_id'];

    public function user() {
        return $this->belongsTo('App\User');
}
}
