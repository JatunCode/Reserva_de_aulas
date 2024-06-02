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
