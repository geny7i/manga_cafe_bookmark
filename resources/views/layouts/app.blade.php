<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '漫画カフェブックマーク')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    <nav>
        <ul>
            @auth
                <li><a href="{{ url('/') }}">ホーム</a></li>
                <li>
                    {{ Auth::user()->name }}
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('oauth.redirect', 'google') }}">ログイン/登録</a></li>
            @endauth
        </ul>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} Manga Cafe Bookmark.</p>
</footer>

</body>
</html>
