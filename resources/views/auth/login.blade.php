<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link href="{{asset('/css/login-style.css')}}" rel="stylesheet">
  <link href="{{asset('/css/global-style.css')}}" rel="stylesheet">
<title>Login</title>
</head>
    <body>
        <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card mt-5">
        @include('shared.validation-error-message')
        <form method="POST" action="/admin/login">
        @csrf
        <h1 class="d-flex justify-content-center align-items-center my-5">Admin Login</h1>
        <p class="d-flex justify-content-center align-items-center">Please enter your credentials below to continue.</p>
        <div class="d-flex justify-content-center align-items-center my-4">
            <label for="username"></label><br>
            <input type="text" id="username" class="form-control-lg border border-2 border-dark" placeholder="Username" name="username" required>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <label for="password"></label><br>
            <input type="password" id="password" class="form-control-lg border border-2 border-dark" placeholder="Password" name="password" required>
        </div>
        <div class="d-flex justify-content-center align-items-center my-5">
            <button id="submit" type="submit" class="btn btn-primary btn-lg" name="login" value="login">Login</button>
        </div>
        </form>
        </div>
        </div>
</body>
</html>
