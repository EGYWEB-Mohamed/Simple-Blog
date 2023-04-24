<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate(true) !!}
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full">
<div class="min-h-full">
    <nav class="bg-white-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between place-content-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ url('/') }}" class="text-dark-300 px-3 py-2 text-2xl font-medium">{{ config('app.name') }}</a>
                    </div>
                </div>
                @if(request()->is('/'))
                    <div class="flex items-center">
                        <livewire:home-search></livewire:home-search>
                    </div>
                @endif

                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @auth()
                            <a href="{{ route('filament.pages.dashboard') }}" class="text-dark-300 px-3 py-2 font-medium">{{ __('My Account') }}</a>
                            <a href="{{ route('filament.auth.logout') }}" class="text-dark-300 px-3 py-2 font-medium">{{ __('Logout') }}</a>
                        @else
                            <a href="{{ route('register') }}" class="text-dark-300 px-3 py-2 font-medium">{{ __('Register') }}</a>
                            <a href="{{ route('filament.auth.login') }}" class="text-dark-300 px-3 py-2 font-medium">{{ __('Login') }}</a>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<main>
    @yield('content')
</main>
@livewireScripts
</body>
</html>
