@extends('layouts.app')

@section('content')
    <h1>ブックマーク一覧</h1>

    <table>
        <thead>
        <tr>
            <th>書籍名</th>
            <th>URL</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($comics as $comic)
            @php
                // NOTE: 快活(なびコミ前提の実装)
                $url = "https://navi-comi.com/{$comic->shop->id_in_platform}/comics/detail/?isbn={$comic->isbn}U"
            @endphp
            <tr>
                <td>{{ $comic->title }}</td>
                <td>
                    <a href="{{$url}}">
                        {{$url}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
