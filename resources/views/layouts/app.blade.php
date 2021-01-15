<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="front-banner text-center">
        <div class="front-logo">
            <img src="/images/shade-logo.png" alt="cookrey-logo">
        </div>
        <div class="CKHM-srch">
            <form>
                <div class="inner-form">
                    <div class="input-field first-wrap">
                        <div class="input-select">
                            <div class="choices" role="listbox" data-type="select-one" tabindex="0" aria-haspopup="true" aria-expanded="false" dir="ltr" aria-activedescendant="choices-choices-single-defaul-11-item-choice-2">
                                <div class="choices__inner"><select data-trigger="" name="choices-single-defaul" class="choices__input is-hidden" tabindex="-1" style="display:none;" aria-hidden="true" data-choice="active"><option value="Category" selected="">Category</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable choices__placeholder" data-item="" data-id="1" data-value="Category" aria-selected="true">
                                            Category
                                        </div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false">
                                    <div class="choices__list" dir="ltr" role="listbox"><div class="choices__item choices__item--choice choices__item--selectable choices__placeholder is-highlighted" data-select-text="" data-choice="" data-id="2" data-value="Category" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-2" role="option" aria-selected="true">
                                            Category
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="1" data-value="Accessories" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-1" role="option">
                                            Accessories
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="3" data-value="Clothing" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-3" role="option">
                                            Clothing
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="4" data-value="Footwear" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-4" role="option">
                                            Footwear
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="5" data-value="Ladies" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-5" role="option">
                                            Ladies
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="6" data-value="Men" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-6" role="option">
                                            Men
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="7" data-value="New Arrivals" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-7" role="option">
                                            New Arrivals
                                        </div><div class="choices__item choices__item--choice choices__item--selectable" data-select-text="" data-choice="" data-id="8" data-value="Sale" data-choice-selectable="" id="choices-choices-single-defaul-11-item-choice-8" role="option">
                                            Sale
                                        </div></div></div></div>
                        </div>
                    </div>
                    <div class="input-field second-wrap">
                        <input id="search" type="text" placeholder="Enter Keywords?">
                    </div>
                    <div class="input-field third-wrap">
                        <button class="btn-search" type="button">
                            <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>






    </div>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script
    src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=AIzaSyD1fJmzwJMy35N0rfY_btipuz6f8_zFvZA"
    type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
