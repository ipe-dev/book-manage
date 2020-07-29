@extends('layouts/default')
@section('title','ログイン')    

@section('content')
    <form action="" method="post">
        <table>
            <tr>
                <th>
                    メールアドレス
                </th>
                <td>
                    
                    {!! Form::text('email', old('email'),[]) !!}
                    
                </td>
            </tr>
            <tr>
                <th>
                    パスワード
                </th>
                <td>
                    {!! Form::text('password', old('password'), []) !!}
                </td>
            </tr>
            <tr>
                <td>
                    {!! Form::submit('ログイン',[]) !!}
                </td>
            </tr>
        </table>
    </form>
@endsection