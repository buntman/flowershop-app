<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin')</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- tailwind issue: conflicts with the css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="{{asset('css/sidebar-style.css')}}" rel="stylesheet">
  <link href="{{asset('/css/global-style.css')}}" rel="stylesheet">

<!-- Tailwind CSS (Development CDN) -->
    </head>
    <body>
  <nav class="sb-topnav navbar navbar-expand ">
    <button class="btn btn-link btn-sm me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  </nav>
    <div id="layoutSidenav">
        @include('components.admin-sidebar')
        <div id="layoutSidenav_content">
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('/js/sidebar.js') }}"></script>
    @stack('scripts')
    </body>
</html>
