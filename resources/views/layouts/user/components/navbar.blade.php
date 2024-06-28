<nav class="navbar navbar-light bg-body-tertiary">
    <div class="container-fluid">
        @auth
            @if (Auth::user()->cargo === 'docente')
                <a class="navbar-brand" href="{{ url('docente.inicio') }}" ></a>
            @elseif (Auth::user()->cargo === 'admin')
                <a class="navbar-brand" href="{{ url('admin.inicio') }}" ></a>
            @endif
        @endauth    
    <img src="{{ asset('image/jatuncode.ico') }}" alt="JatunCode" class="img-fluid" style="width: 40px; height: 40px;">
</a>
        @auth
            @if (Auth::user()->cargo === 'docente')
                <a class="navbar-brand" href="{{ url('docente.inicio') }}" >JatunCODE</a>
            @elseif (Auth::user()->cargo === 'admin')
                <a class="navbar-brand" href="{{ url('admin.inicio') }}" >JatunCODE</a>
            @endif
        @endauth
        <div class="d-flex align-items-center">
            @auth
                @if (Auth::user()->cargo === 'docente')
                    <a href="{{ route('docente.inicio') }}" class="btn btn-outline-success me-3">Ingresar</a>
                @elseif (Auth::user()->cargo === 'admin')
                    <a href="{{ route('admin.inicio') }}" class="btn btn-outline-success me-3">Ingresar</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success me-3">Ingresar</a>
            @endauth
            
        </div>
    </div>
</nav>