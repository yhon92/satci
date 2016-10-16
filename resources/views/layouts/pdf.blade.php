<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    @if ( Config::get('app.debug') )
      <link href="<% asset('css/pdf.css') %>" rel="stylesheet">
    @else
      <link href="<% elixir('css/pdf.css') %>" rel="stylesheet">
    @endif
  </head>
  <body>
    <header class="Header">
      <div class="Header-Logo">
        <img src="<% asset('img/logo.png') %>" alt="" width="100%">
      </div>
      <div class="Header-Menbrete center-text">
        <h2>@yield('title')</h2>
      </div>
      <div class="Header-Date">
        <p>Fecha: {!! Carbon\Carbon::now()->format('d-m-Y'); !!}</p>
        <p>Hora: {!! Carbon\Carbon::now()->format('h:i:s A'); !!}</p>
      </div>
    </header>
    @yield('content')
  </body>
</html>