@extends('layouts.public')

@section('content')
    <div class="container">
        <form class="form-horizontal" role="form" method="POST" id="form" action="{{ route('dashboard.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group btns text-center">
                <button type="button" id="newForm" class="btn-green-filled">Novo cadastro</button>
            </div>

            <div class="overlay col-md-6 col-md-offset-3">

                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} text-center">
                    <div class="col-xs-12">
                        <label for="file" class="nf-add">Adicionar nota fiscal</label>
                        <span class="check"><i class="fa fa-check"></i></span>
                    </div>
                    <div class=" text-left">
                        <input id="file" type="file" name="file" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label">Nome*</label>

                    <div class="">
                        <input id="name" type="text" class="form-control" name="name"required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class=" control-label">E-mail*</label>

                    <div class="">
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class=" control-label">CPF*</label>

                    <div class="">
                        <input id="cpf" type="text" class="form-control" name="cpf"  required>
                    </div>
                </div>

                <div class="">
                    <div class="form-group">
                        <label class=" control-label">CEP*</label>

                        <div class="">
                            <input type="text" id="cep" class="form-control" name="cep" placeholder="00000-000"  required>
                            <div id="spin" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Estado</label>

                        <div class="">
                            <input type="text" id="state" class="form-control" name="state" readonly placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Cidade</label>

                        <div class="">
                            <input type="text" id="city" class="form-control" name="city" readonly placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Endereço</label>

                        <div class="">
                            <input type="text" id="street" class="form-control" name="street" readonly placeholder=""  >
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Número*</label>

                        <div class="">
                            <input type="text" id="number" class="form-control" name="number" placeholder=""  required>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Complemento</label>

                        <div class="">
                            <input type="text" id="complement" class="form-control" name="complement" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class=" control-label">Bairro</label>

                        <div class="">
                            <input type="text" id="neighborhood" class="form-control" name="neighborhood" readonly placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="terms" id="terms"> Li e concordo com o regulamento
                        </label>
                    </div>
                </div>

                <div class="form-group text-center">
                    <div class="">
                        <button type="submit" class="btn-green" id="send">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
