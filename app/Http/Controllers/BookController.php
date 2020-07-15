<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller {
    //

  public function list( Request $request ) {

    //$books = Book::all();
    //$books = Book::orderBy('created_at','desc')->get();
    $books = Book::latest()->get();
    return view('book.list',['books'=>$books]);
  }

  public function detail( Book $book ) {

    $status_codes = ['1'=>'未読','2'=>'読了'];
    $book->disp_status = $status_codes[$book->status];

    return view('book.detail',['book'=>$book]);
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

  public function destroy( Book $book ) {

    $book->delete();

    return redirect( '/book/list' );

  }

  public function edit(Book $book) {

    $codes['status_codes'] = ['1'=>'未読','2'=>'読了'];

    return view('book.edit',['book'=>$book,'codes'=>$codes]);

  }

  public function update(Request $request, Book $book) {

    $this->validate($request, Book::$rules );
    $form = $request->all();
    unset($form['_token']);
    $book->fill($form)->save();
    $book->save();
    
    return redirect('/book/list');

  }
}
