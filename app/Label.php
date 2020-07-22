<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //

    public function books() {

        return $this->belongsToMany('App/Book')->using('/App/BookLabel');
    }

    static public function save_labels_and_pivot( $label_name, $book ) {

        $label = Label::where('name',$label_name)->first();
        // すでにラベルがあるとき
        if( $label != null ) {
    
          //pivotに入れる
          $book->labels()->attach($label->id);
  
        // 新しいラベルのとき
        } else {
    
          // 新しくラベルを保存
          $label = new Label();
          $label->name = $label_name;
          $label->save();

          //pivotに入れる
          $book->labels()->attach($label->id);  
        }  
    }
}