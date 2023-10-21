<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laravel</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
            <a class="navbar-brand">Practical Task</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                @if(Auth::check())
                @if(Auth::user()->role == 'admin')
                  <a class="nav-link active" aria-current="page" href="{{ route('product.index') }}">Products</a>
                @else 
                  <a class="nav-link active" aria-current="page" href="{{ route('product.index') }}"> My Products</a>
                @endif
                <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                @else 
                  <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                  <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endif
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
      @endif
      @yield('content')
  </body>
</html>
