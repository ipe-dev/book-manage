    @extends('layouts.default')
    @section('title','書籍編集')
    @section('content')        
      <form method="POST" action="{{ url('/book', $book->id) }}" class="mt-4">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <input type="hidden" name="user_id" value="1">
      <div class="container">
        <div class="row justify-content-center">
          <h2>
            @yield('title')
          </h2>
        </div>
          <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
              <label for="book-title">
                  タイトル
              </label>
            <input type="text" name="title" class="form-control" id="book-title" value="{{ old('title',$book->title) }}">
            @if( $errors->has('title') )
            <p>{{ $errors->first('title') }}</p>
            @endif
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="form-group col-md-6">
              <label for="status">
                  状態
              </label>
            <select name="status" id="status" >
              @foreach ($codes['status_codes'] as $key=>$value)
                <option value="{{$key}}" @if($key==$book->status) selected @endif>{{$value}}</option>                  
              @endforeach
            </select>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="form-group col-md-6">
              <label for="memo">
                  メモ
              </label>
            <textarea rows="5" name="memo" class="form-control" id="memo">{{ old('memo',$book->memo) }}</textarea>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="form-group col-md-6">
              <label for="start-date">
                  読み始めた日
              </label>
            <input type="date" rows="5" name="read_start_date" class="form-control" id="start-date" value="{{ old('read_start_date',$book->read_start_date) }}">
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="form-group col-md-6">
              <label for="end-date">
                  読み終わった日
              </label>
            <input type="date" rows="5" name="read_end_date" class="form-control" id="end-date" value="{{ old('read_end_date', $book->read_end_date ) }}">
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="form-group col-md-6">
              <label for="label">
                  ラベル
              </label>
                <input id="label" type="text" name="name" value="{{ old('name',$label_name) }}">
            </div>
          </div>
          <div class="row justify-content-center">
            <input type="submit" class="btn btn-primary" value="登録">
          </div>
      </div>
    </form>
    @endsection

