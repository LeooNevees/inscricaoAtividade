@extends('layout.site')

@section('js')
    <script src="{{asset('site/registerActivity.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <h2 class="mt-5 mb-5 text-center text-success">Cadastrar Atividade</h2>
            @if (!empty($mensagem['msg']))
                <div class="row justify-content-center">
                @if (isset($mensagem['error']) && $mensagem['error'] == false)
                    <div class="alert alert-success col-md-6 col-lg-6 mt-3 text-center" role="alert" style="height: 50px">
                        {{$mensagem['msg']}}
                    </div>
                @else
                    <div class="alert alert-danger col-md-6 col-lg-6 mt-3 text-center" role="alert" style="height: 50px">
                        {{$mensagem['msg']}}
                    </div>
                @endif
                </div>
            @endif

            <div class="col-md-6 col-lg-6 mt-2">
                <div class="card border-success mb-3 text-center boxShadowSuccess">
                    <div class="card-header">Informações</div>
                    <div class="card-body"> 
                        <form action="{{route('activity.create')}}" method="POST">
                            {{csrf_field() }}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Título">
                                <label for="floatingInput">Título</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Descrição" id="description" name="description" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Descrição</label>
                            </div>
                            {{-- <hr> --}}
                            <div class="d-grid gap-2 d-md-block mt-4">
                                <a href="{{route('activity.home')}}" class="btn btn-danger col-4" onclick="return cancel()">Cancelar</a>
                                <button type="submit" class="btn btn-success col-6" onclick="return validation()">Cadastrar</button>
                            </div>
                        </form>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection