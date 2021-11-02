<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand text-success" href="{{route('home')}}">USC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('activity.home')}}">Atividades</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuário</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Configurações</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="{{route('user.logout')}}" class="dropdown-item text-danger" href="">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.home')}}">Acessar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>