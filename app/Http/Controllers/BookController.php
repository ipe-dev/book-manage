<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller {
    //

  public function list() {

    $books = Book::all();

    return view('book.list',['books'=>$books]);
  }

  public function detail() {


  }

  public function entry() {

    $dto['status_codes'] = ['1'=>'未読','2'=>'読了'];


    return view('book.entry',$dto);
  }

  public function create(Request $request) {

    $this->validate($request, Book::$rules );
    $book = new Book;
    $form = $request->all();
    unset($form['_token']);
    $book->fill($form)->save();

    return redirect('/book/list');
  }

  // public function update(Request $request) {

  //   $book = new Book();

  //   if( $id != null ) {

  //     $book = Book::find($request->id);
  //   }

  //   $book->fill($request)->save();

  //   return view('book.entry');
  // }
}
