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
    <body class="h-[100vh] flex flex-col justify-center">
        <form action="/store-url" method="post"
              class="w-[90%] max-w-[600px] mx-auto">
            @csrf
            <div>
                <label for="url" class="block mb-2 text-sm font-medium text-gray-900">
                    URL:*
                </label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if ($errors->has('url'))
                    <small class="block text-red-600 mt-1">
                        {{ $errors->first('url') }}
                    </small>
                @endif
            </div>
            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">
                    Slug:
                </label>
                <input type="text" name="slug" id="slug" max="10" value="{{ old('slug') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if ($errors->has('slug'))
                    <small class="block text-red-600 mt-1">
                        {{ $errors->first('slug') }}
                    </small>
                @endif
            </div>
            <button type="submit"
                    class="cursor-pointer text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Create
            </button>
        </form>
        @if (session('success'))
            <a href="{{ session('success') }}">
                {{ session('success') }}
            </a>
        @endif
    </body>
</html>
