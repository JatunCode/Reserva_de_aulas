<!DOCTYPE html>
<html lang="es">  
<head>    
    <title>Título de la WEB</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Título de la WEB">
    <meta name="description" content="Descripción de la WEB">    
    <link href="estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="script.js"></script>  
    <script type="text/javascript">
        /* Código JS */
    </script> 
</head>  
<body>    
<nav class="navbar navbar-light bg-body-tertiary">
    <div class="container-fluid">
    <a href="{{ url('/') }}">
    <img src="{{ asset('image/jatuncode.ico') }}" alt="JatunCode" class="img-fluid" style="width: 40px; height: 40px;">
</a>
        <a class="navbar-brand" href="{{ url('/') }}">
            JatunCODE
        </a>
        <div class="d-flex align-items-center">
            @auth
                @if (Auth::user()->cargo === 'docente')
                    <a href="{{ route('docente.inicio') }}" class="btn btn-outline-success me-3">Ingresar</a>
                @elseif (Auth::user()->cargo === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success me-3">Ingresar</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success me-3">Ingresar</a>
            @endauth
            
        </div>
    </div>
</nav>
<section class="bg-light vh-100 d-flex justify-content-center align-items-center">
  <div class="card border-light-subtle shadow-sm w-100" style="max-width: 800px;">
    <div class="row g-0">
      <div class="col-md-6">
        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('image/jatuncode.ico') }}" alt="JatunCode">
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <div class="card-body">
          <h4 class="text-center mb-4">Iniciar Sesión</h4>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
              <label for="email">Correo</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              <label for="password">Contraseña</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
              <label class="form-check-label text-secondary" for="remember_me">Recordar</label>
            </div>
            <div class="d-grid mb-3">
              <button class="btn btn-dark btn-lg" type="submit">Ingresar</button>
            </div>
          </form>
          <div class="text-center">
          <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">¿Olvidaste tu contraseña?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>  
</html>
