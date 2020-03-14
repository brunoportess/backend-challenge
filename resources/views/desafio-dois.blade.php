@extends('layout')
@section('content')
<div class="container mt-5">


    <!-- Modal -->
    <div class="modal fade" id="modelCadastro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastro de usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCadastro">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Informe o nome do usuário" required>
                                    <small class="text-danger">Campo obrigatório</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="access_level">Nível de acesso</label>
                                    <select class="form-control" name="access_level" id="access_level" required>
                                        <option>Free</option>
                                        <option>Premium</option>
                                    </select>
                                    <small class="text-danger">Campo obrigatório</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password">Senha <small>(opcional)</small></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
                                </div>
                            </div>
                            <!-- NÃO FOI REALIZADO MASCARA DE TELEFONE DEVIDO A POSSIBILIDADE DE TELEFONE ESTRANGEIRO-->
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="msisdn">Telefone <small>(com DDD)</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+55</span>
                                        </div>
                                        <input type="text" name="msisdn" id="msisdn" class="form-control" placeholder="(99) 9999-9999" required>
                                    </div>
                                    <small class="text-danger">Campo obrigatório</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarUsuario">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Gestão de usuários</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <button type="button" class=" float-right btn btn-primary" data-toggle="modal" data-target="#modelCadastro">NOVO USUÁRIO</button>
                </div>
            </div>
            <div class="row">
                <div class="col  table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NOME</th>
                                <th>NIVEL DE ACESSO</th>
                                <th>TELEFONE CELULAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$listaUsuarios)
                                <tr>
                                    <td colspan="3" class=" text-center">
                                        <span class="font-weight-bold">
                                            Nenhum registro a ser exibido!
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($listaUsuarios as $usuario)
                                    <tr>
                                        <td scope="row">{{$usuario->name}}</td>
                                        <td>{{$usuario->access_level}}</td>
                                        <td>{{$usuario->msisdn}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/desafioDois.js')}}"></script>
@endsection
