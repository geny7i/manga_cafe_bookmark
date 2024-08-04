@extends('layouts.app')

@section('content')
    <h1>店舗一覧</h1>

    <table>
        <thead>
        <tr>
            <th>店舗名</th>
            <th>URL</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($shops as $shop)
            @php
                // NOTE: 快活(なびコミ前提の実装)
                $url = "https://navi-comi.com/{$shop->id_in_platform}"
            @endphp
            <tr>
                <td>{{ $shop->name }}</td>
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
