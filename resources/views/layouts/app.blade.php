@php
    $activeLinkClass = 'bg-gray-900 ';
@endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<nav class="bg-gray-800">
    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('authors.index') }}"
                           class="{{ Route::is('authors.*') ? $activeLinkClass : '' }}text-white px-3 py-2 rounded-md text-sm font-medium"
                        >Авторы</a>
                        <a href="{{ route('journals.index') }}"
                           class="{{ Route::is('journals.*') ? $activeLinkClass : '' }}text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                        >Журналы</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<body class="bg-gray-100">
<div class="container mx-auto max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 pb-8">
    @if ($message = Session::get('success'))
        <div class="alert success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <h1 class="text-3xl my-8">@yield('title')</h1>

    @yield('content')
</div>
</body>
</html>
