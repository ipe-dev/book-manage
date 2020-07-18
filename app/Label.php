<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //

    public function books() {

        return $this->belongsToMany('App/Book')->using('/App/BookLabel');
    }
}
