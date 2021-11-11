@extends('layout.site')

@section('js')
    <script src="{{asset('site/activity.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="mt-5 text-center text-success">Atividades</h2>
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
            <div class="card mt-5 text-center boxShadowSecondary">
                <div class="card-body">
                    @if (isset($mensagem['activities']) && count($mensagem['activities']))
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
                                @foreach ($mensagem['activities'] as $atividade)
                                    @if (mb_strpos($mensagem['userRegistration'], $atividade->id) !== false)
                                        <tr style="background-color: #E0F8E6">
                                        <td><i class="bi bi-check-circle-fill text-success h5" title="Inscrito"></i></td>
                                    @else
                                            <tr>
                                        <td><a class="bi bi-check-circle text-success h5" href="{{route('registration.userRegistration', $atividade->id)}}" title="Selecionar" onclick="return registerActivity({{$atividade->id}})"></a></td>
                                    @endif
                                        <td scope="row">{{$atividade->id}}</td>
                                        <td>{{ucfirst(mb_strtolower($atividade->title))}}</td>
                                        <td>2</td>
                                        <td>
                                            <i class="bi bi-info-circle-fill text-primary h5" title="Detalhes" style="cursor: pointer" onclick="openModal('{{ucfirst(mb_strtolower($atividade->title))}}', '{{ucfirst(mb_strtolower($atividade->description))}}')"></i>
                                            <a href="{{route('activity.inactivate', $atividade->id)}}" class="bi bi-trash-fill text-danger h5" title="Inativar" onclick="return confirmInactivate()"></a>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Modal -->
                                <div class="modal fade" id="modalDescricao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloAtividade">Title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" id="descricaoAtividade">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tbody>
                        </table>
                    @endif
                    <a href="{{route('activity.register')}}" class="btn btn-success">Novo</a>
                </div>  
            </div>
        </div>
    </div>
@endsection