<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $guarded = array('id');
    //
    public static $rules = array(

        'title' => 'required|min:3'
    );

    public function message() {

        return [ 'title.required' => 'タイトルを入力してください' ];
    }
}
