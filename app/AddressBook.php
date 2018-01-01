<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    //
    
    public function places() {
        return $this->belongsTo('App\UserPlaces', 'user_id')->select(array('place_name'));
    }
}
