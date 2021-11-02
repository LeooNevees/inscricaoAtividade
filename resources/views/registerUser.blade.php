@extends('layout.site')

@section('js')
    <script src="{{asset('site/registerUser.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <h2 class="mt-4 text-center text-success">Cadastrar Usuário</h2>
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
                        <form action="{{route('user.create')}}" method="POST">
                            {{csrf_field() }}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
                                <label for="floatingInput">Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                <label for="floatingPassword">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Data Nascimento">
                                <label for="floatingPassword">Data Nascimento</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" onkeypress="mask(this, phone);" onblur="mask(this, phone);"  placeholder="Celular">
                                <label for="floatingPassword">Celular</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="document_number" name="document_number" onkeypress="mask(this, cpf);" onblur="mask(this, cpf);" placeholder="CPF">
                                <label for="floatingPassword">CPF</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>
                            {{-- <hr> --}}
                            {{-- <div class="d-grid gap-2 col-6 mx-auto mt-3">
                                <button type="submit" class="btn btn-success" onclick="return validation()">Cadastrar</button>
                            </div> --}}
                            <div class="d-grid gap-2 d-md-block">
                                <a href="{{route('user.home')}}" class="btn btn-danger col-4" onclick="return cancel()">Cancelar</a>
                                <button type="submit" class="btn btn-success col-6" onclick="return validation()">Cadastrar</button>
                              </div>
                        </form>                     
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection