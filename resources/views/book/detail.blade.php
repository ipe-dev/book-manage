@extends('layouts/default')
@section('title','書籍一覧')

@section('content')    
<table class="table table-striped" style="width:50%;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">
                タイトル
            </th>
            <td>
                {{ $book->title }}
            </td>
        </tr>
        <tr>
            <th scope="col">
                メモ
            </th>
            <td>
                {!! nl2br(e($book->memo)) !!}
            </td>
        </tr>
        <tr>
            <th scopec="col">
                読み始めた日
            </th>
            <td>
                {{ $book->read_start_date }}
            </td>
        </tr>
        <tr>
            <th scopec="col">
                読み終わった日
            </th>
            <td>
                {{ $book->read_end_date }}
            </td>
        </tr>
        <tr>
            <th>
                状態
            </th>
            <td>
                {{ $book->disp_status }}
            </td>
        </tr>
    </thead>
</table>
@endsection