<!DOCTYPE html>
<html>
  <head>
    @include('layouts.theme.styles')
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <img src="{{asset('images/logo-white.png')}}"  alt="">
        </div>
        @yield('content')
    </section>
    @include('layouts.theme.scripts')
  </body>
</html>
