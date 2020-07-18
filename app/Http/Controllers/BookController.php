<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller {
    //

  public function list( Request $request ) {

    //$books = Book::all();
    //$books = Book::orderBy('created_at','desc')->get();

    $query = Book::query();

    //title
    if( !empty($request->input('title')) ) {

      $title_list = explode(' ',$request->input('title'));
      if( $title_list != null ) {
        
        foreach( $title_list as $title ) {

          $query->orWhere('title','like','%'.$title.'%');
        }
      }
    }
    //memo
    if( !empty($request->input('memo')) ) {

      $query->where('memo','like','%'.$request->input('memo').'%');

    }
    //read_start_date
    if( !empty($request->input('read_start_date_from')) ) {

      $query->where('read_start_date', '>=', $request->input('read_start_date_from'));

    }
    if( !empty($request->input('read_start_date_to')) ) {

      $query->where('read_start_date', '<=', $request->input('read_start_date_to'));

    }
    //read_end_date
    if( !empty($request->input('read_end_date_from')) ) {

      $query->where('read_end_date', '>=', $request->input('read_end_date_from'));

    }

    if( !empty($request->input('read_end_date_to')) ) {

      $query->where('read_end_date', '<=', $request->input('read_end_date_to'));

    }

    $books = $query->orderBy('created_at','desc')->paginate(10);

    return view('book.list')->with('books',$books);
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
    $label_name = $form['name'];
    unset($form['_token']);
    unset($form['name']);
    $book->fill($form)->save();

    $book->labels()->sync(['name'=>$label_name],[]);

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
