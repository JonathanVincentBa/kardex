<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Main CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!-- Font-icon css-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('../css/fontawesome.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('../css/brands.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('../css/solid.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('../css/scrumboard.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('../css/notes.css')}}" rel="stylesheet" type="text/css">


<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}


<!-- Scripts -->
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

<title>{{ config('app.name', 'Kardex') }}</title>


<style type="text/css">
    a:link,
    a:visited,
    a:active {
        text-decoration: none;
    }
</style>

@livewireStyles






















<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
