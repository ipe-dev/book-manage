@extends('layouts/default')
@section('title','書籍一覧')

@section('content')
@if(Auth::check())
<p>User: {{$user->name . '(' . $user->email . ')'}}</p>
@else
<p>ログインしていません( <a href="/login">ログイン</a> | <a href="/register">登録</a> )</p>
@endif
<h1>@yield('title')</h1>

<form action="{{ url('/book/list') }}" method="GET">
    <table class="table">
        <tr>
            <th>
                タイトル
            </th>    
            <td>
                <input type="text" name="title" value="{{ old('title') }}">
            </td>    
        </tr>
        <tr>
            <th>
                メモ
            </th>    
            <td>
                <input type="text" name="memo" value="{{ old('memo') }}">
            </td>    
        </tr>
        <tr>
            <th>
                読み始めた日
            </th>    
            <td>
                <input type="date" name="read_start_date_from" value="{{ old('read_start_date_from') }}"> -
                <input type="date" name="read_start_date_to" value="{{ old('read_start_date_to') }}">
            </td>    
        </tr>
        <tr>
            <th>
                読み終わった日
            </th>    
            <td>
                <input type="date" name="read_end_date_from" value="{{ old('read_end_date_from') }}"> -
                <input type="date" name="read_end_date_to" value="{{ old('read_end_date_to') }}">
            </td>    
        </tr>
    </table>
    <input type="submit" value="検索">
</form>    
<table class="table table-striped" style="width:50%;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">
                タイトル
            </th>
            <th scopec="col">
                読み始めた日
            </th>
            <th scopec="col">
                読み終わった日
            </th>
            <th scope="col">
                編集
            </th>
            <th scope="col">
                削除
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
        <tr>
            <td>
                <a href="{{ url( '/book/detail', $book->id ) }}">{{ $book->title }}</a>
            </td>
            <td>
                {{ $book->read_start_date }}
            </td>
            <td>
                {{ $book->read_end_date }}
            </td>
            <td>
                <a href="{{ action('BookController@edit', $book) }}" >編集</a>
            </td>
            <td>
                <a href="#" data-id="{{ $book->id }}" class="del">削除</a>
                <form method="POST" action="{{ url('/book', $book->id) }}" id="del-{{ $book->id }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                書籍情報はありません。
            </td>
        </tr>            
        @endforelse    
    </tbody>
</table>
{{ $books->links() }}
@endsection