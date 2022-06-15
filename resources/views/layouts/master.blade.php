<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link to="/dashboard" class="brand-link">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </router-link>
    <div class="sidebar">
        <router-link to="/profile">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  {{ Auth::user()->name }}
                  <span class="d-block text-muted">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span>
              </div>
          </div>
        </router-link>
      @include('layouts.sidebar-menu')
    </div>
  </aside>
  <div class="content-wrapper">
    {{-- <div class="content-header">
      <div class="container-fluid">
       
      </div>
    </div> --}}
    <br>
    <br>
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>LARAVEL-VUE </b> POS & INVENTORY SYSTEM
    </div>
  </footer>
</div>
@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
