@extends('layout.site')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="mt-5 text-center text-success">Atividades</h2>
            <div class="card mt-5 text-center boxShadowSecondary">

                @if (isset($atividades) && count($atividades))
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">ID</th>
                                <th scope="col">Título</th>
                                <th scope="col">Inscritos</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($atividades as $atividade)
                                    <tr id="tr_{{$atividade->id}}">
                                        <td id="td_{{$atividade->id}}"><i class="bi bi-check-circle text-success h5" title="Selecionar" style="cursor: pointer" onclick=""></i></td>
                                        <td scope="row">{{$atividade->id}}</td>
                                        <td>{{ucfirst(strtolower($atividade->title))}}</td>
                                        <td>2</td>
                                        <td>
                                            <i class="bi bi-info-circle-fill text-primary h5" title="Detalhes" style="cursor: pointer"></i>
                                            <a href="#" class="bi bi-pencil-square text-danger h5" title="Editar"></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('activity.register')}}" class="btn btn-success">Novo</a>
                    </div>  
                @endif
        
            </div>
        </div>
    </div>
@endsection