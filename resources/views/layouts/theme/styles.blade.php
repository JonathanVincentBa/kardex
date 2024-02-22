<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Main CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!-- Font-icon css-->
<link rel="icon" href="{{ asset('images/AdminLTELogo.ico') }}">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="{{ asset('../css/fontawesome.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('../css/brands.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('../css/solid.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('../css/scrumboard.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('../css/notes.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('../css/bootstrap.min.css')}}"rel="stylesheet" type="text/css" >
<link href="{{ asset('../css/bootstrap.min.css.map')}}"rel="stylesheet" type="text/css" >
<link href="{{ asset('../css/bootstrap-datepicker.min.css')}}"rel="stylesheet" type="text/css" >
<link href="{{ asset('../css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('../css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">




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
