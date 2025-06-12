<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <form action="/store-url" method="post">
            @csrf
            <div>
                <label for="url">URL:*</label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" required>
                @if ($errors->has('url'))
                    <div class="text-red-600 mt-1">
                        {{ $errors->first('url') }}
                    </div>
                @endif
            </div>
            <div>
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" max="10" value="{{ old('slug') }}">
                @if ($errors->has('slug'))
                    <div class="text-red-600 mt-1">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
            </div>
            <button type="submit">Create</button>
        </form>
        @if (session('success'))
            <a href="{{ session('success') }}">
                {{ session('success') }}
            </a>
        @endif
    </body>
</html>
