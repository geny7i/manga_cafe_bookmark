@extends('layouts.app')

@section('content')
    <h1>APIキー一覧</h1>

    <form action="{{ route('api_keys.store') }}" method="POST">
        @csrf
        <input name="name" type="text" placeholder="キーの名前">
        <button type="submit">キー生成</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>作成日時</th>
            <th>キー</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($api_keys as $api_kei)
            <tr>
                <td>{{ $api_kei->created_at }}</td>
                <td>{{ $api_kei->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
