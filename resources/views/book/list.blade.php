@extends('layouts/default')
@section('title','書籍一覧')

<table class="table table-striped" style="width:50%;">
    <thead class="thead-dark">
<!--                <tr>
            <th colspan="3" class="col">
                <a href="/book/entry">新規登録</a>
            </th>
        </tr>-->
        <tr>
            <th scopec="col">
                日付
            </th>
            <th scope="col">
                タイトル
            </th>
            <th scope="col">
                編集
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                2020/02/10
            </td>
            <td>
                <a href="/book/detail/1">ファストアンドスロー</a>
            </td>
            <td>
                編集
            </td>
        </tr>
        <tr>
            <td>
                2020/02/10
            </td>
            <td>
                <a href="/book/detail/2">罪と罰</a>
            </td>
            <td>
                編集
            </td>
        </tr>
        <tr>
            <td>
                2020/02/10
            </td>
            <td>
                <a href="/book/detail/2">ノルウェイの森</a>
            </td>
            <td>
                編集
            </td>
        </tr>
    </tbody>
</table>
