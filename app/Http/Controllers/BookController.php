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

  public function edit(Request $request) {

    $book = Book::find($request->id);
    $codes['status_codes'] = ['1'=>'未読','2'=>'読了'];

    return view('book.edit',['book'=>$book,'codes'=>$codes]);

  }
}
