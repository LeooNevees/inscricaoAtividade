@extends('layout.site')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card mt-5 text-center boxShadowSecondary">
                <div class="card-body">
                    <h5 class="card-title text-success">Bem-vindo(a) !!</h5>
                    <p class="card-text mt-5">Este sistema foi desenvolvido para realização de cadastros em atividades presentes na USC</p>
                    <h6 class="card-title mt-5">Ver lista de atividades...</h6>
                    <a href="{{route('activity.home')}}" class="btn btn-primary mt-4">Bora lá?</a>
                </div>
            </div>
        </div>
    </div>
@endsection