<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Jobs\MyJob;
use App\Label;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller {
    //

  // 一覧画面
  public function list( Request $request ) {

    $user = Auth::user();

    $query = Book::query();
    $sort = $request->sort;

    //user_id
    $query->where('user_id',$user->id);

    //title
    // if( !empty($request->input('title')) ) {

    //   $title_list = explode(' ',$request->input('title'));
    //   if( $title_list != null ) {
        
    //     foreach( $title_list as $title ) {

    //       $query->orWhere('title','like','%'.$title.'%');
    //     }
    //   }
    // }
    // //memo
    // if( !empty($request->input('memo')) ) {

    //   $query->where('memo','like','%'.$request->input('memo').'%');

    // }
    // //read_start_date
    // if( !empty($request->input('read_start_date_from')) ) {

    //   $query->where('read_start_date', '>=', $request->input('read_start_date_from'));

    // }
    // if( !empty($request->input('read_start_date_to')) ) {

    //   $query->where('read_start_date', '<=', $request->input('read_start_date_to'));

    // }
    // //read_end_date
    // if( !empty($request->input('read_end_date_from')) ) {

    //   $query->where('read_end_date', '>=', $request->input('read_end_date_from'));

    // }

    // if( !empty($request->input('read_end_date_to')) ) {

    //   $query->where('read_end_date', '<=', $request->input('read_end_date_to'));

    // }

//    $books = $query->orderBy('created_at','desc')->paginate(2);
    $books = $query->orderBy('created_at','desc')->get();

    return view('book.list')->with('books',$books)->with("user",$user);
  }

  public function ajax( Request $request ) {

    $Word = $request->query('word');

    $user = Auth::user();
    $query = Book::query();
    $query->where('user_id',$user->id);
    $query->where(function($query) use($Word){

      $query->orWhere('title','like','%' . $Word . '%');
      $query->orWhere('memo','like','%' . $Word . '%');
    });

    $books = $query->orderBy('created_at','desc')->get();
    return response()->json($books);

  }

  public function detail( Book $book ) {

    $status_codes = ['1'=>'未読','2'=>'読了'];
    $book->disp_status = $status_codes[$book->status];

    return view('book.detail',['book'=>$book]);
  }

  // 登録画面
  public function entry() {

    $user = Auth::user();

    $dto["user_id"] = $user->id;

    $dto['status_codes'] = config('code.status');

    return view('book.entry',$dto);
  }

  // 登録実行
  public function create(Request $request) {

    $this->validate($request, Book::$rules );
    $book = new Book;
    $form = $request->all();
    $label_name = $form['name'];
    unset($form['_token']);
    unset($form['name']);
    // book登録
    $book->fill($form)->save();

    // ラベル登録
    // 同じラベルがあるか
    $label_name_list = explode(' ',$label_name);

    foreach( $label_name_list as $name ) {

      Label::save_labels_and_pivot( $name, $book );
    }

    return redirect('/book/list');
  }

  public function destroy( Book $book ) {

    $book->delete();

    // リレーションテーブルのデータも削除する
    $labels = $book->labels;
    if( $labels != null ) {

      foreach( $labels as $label ) {

        $pivot = $label->pivot;
        $pivot->delete();
      }
    }

    return redirect( '/book/list' );

  }

  // 編集画面
  public function edit(Book $book) {

    $codes['status_codes'] = config('code.status');

    $user = Auth::user();
    $user_id = $user->id;

    $label_name_list = null;
    if( $book->labels != null ) {

      foreach ( $book->labels as $label ) {

        $label_name_list[] = $label->name;
      }
    }

    $label_name = implode(' ',$label_name_list);

    return view('book.edit',['book'=>$book,'codes'=>$codes, 'label_name'=>$label_name,'user_id'=>$user_id]);

  }

  // 編集実行
  public function update(Request $request, Book $book) {

    $this->validate($request, Book::$rules );
    $form = $request->all();
    $label_name = $form['name'];
    unset($form['name']);
    unset($form['_token']);
    $book->fill($form)->save();
    $book->save();
    

    // リレーションテーブルからデータを削除
    $labels = $book->labels;
    if( $labels != null ) {

      foreach( $labels as $label ) {

        $pivot = $label->pivot;

        $pivot->delete();
      }
    }

    // ラベル登録
    // 同じラベルがあるか
    $label_name_list = explode(' ',$label_name);

    foreach( $label_name_list as $name ) {

      Label::save_labels_and_pivot( $name, $book );
    }

    return redirect('/book/list');

  }

  public function getLogin(Request $request) {
    
    $message = 'ログインしてください';

    return view('book.login')->with('message',$message);

  }

  public function postLogin( Request $request ) {

    
  }
}
