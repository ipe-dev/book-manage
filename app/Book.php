<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Label;

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

    public function labels() {

        return $this->belongsToMany('App\Label','book_label','book_id','label_id');

    }
}
