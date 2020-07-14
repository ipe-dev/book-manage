@extends('layouts/default')
@section('title','書籍一覧')

@section('content')    
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
                {{ $book->title }}
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
                <form action="{{ url('/book', $book->id) }}" id="del-{{ $book->id }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                書籍情報はありません。
            </td>
        </tr>            
        @endforelse    
    </tbody>
</table>
@endsection