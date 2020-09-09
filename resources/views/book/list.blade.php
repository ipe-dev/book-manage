@extends('layouts/default')
@section('title','書籍一覧')

@section('content')
@if(Auth::check())
<p>User: {{$user->name . '(' . $user->email . ')'}}</p>
@else
<p>ログインしていません( <a href="/login">ログイン</a> | <a href="/register">登録</a> )</p>
@endif
<h1>@yield('title')</h1>
<div id="app">
    <form action="{{ url('/book/list') }}" method="GET" onsubmit="return false;">
        <div style="text-align:center;">
            <div class="search-box">
                <button id="search-btn" class="material-icons" type="button" >
                    search
                </button>
                <input id="search-window" v-model="search" > 
                <button id="close-btn" class="material-icons" type="button">
                    close
                </button>
            </div>
        </div>
    </form>
    @foreach ($books as $book)
    <div style="margin:auto; width:50%;">
        <div class="card" style="margin:15px;">
            <div class="card-body">
                <h5 class="card-title"><a href="{{ url( '/book/detail', $book->id ) }}">{{ $book->title }}</a></h5>
                <p class="card-text">{{ $book->memo }}</p>
            </div>
        </div>    
    </div>
    @endforeach
</div>
@endsection