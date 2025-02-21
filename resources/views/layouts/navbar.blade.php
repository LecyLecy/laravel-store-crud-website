<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">ChipiChapa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    @auth
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/main">Daftar Barang</a>
        </li>
        @can('admin')
        <li>
          <a class="nav-link active" aria-current="page" href="/crud" style="background-color: yellow; color: black;">Ubah Barang</a>
        </li>
        @endcan
      </ul>

      <ul class="navbar-nav ms-auto">
          <div class="ms-auto">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </div>
        @else
          <div class="ms-auto">
            <a href="/login" class="btn btn-success">Login</a>
          </div>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div>
    @yield('container')
</div>
    
</body>
</html>