@extends('usuario.template')

@section('content')

    <div class="container my-5">
        <h1>Edição de Usuário</h1>

        <div id="success" class="alert alert-success " role="alert">
            <strong>Aviso!</strong> Atualização realizado com sucesso.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div id="error" class="alert alert-warning " role="alert">
            <strong>Opsss!</strong> Ocorreu um erro ao realizar a atualização.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="commentForm" >
            @csrf
            @method('put')
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" minlength="2" type="text" class="form-control" value="{{ $usuario->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <input id="data_nascimento" type="text" name="data_nascimento" value="<?php echo date( 'd/m/Y', strtotime($usuario->data_nascimento)) ?>" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password" name="senha" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="confirme_senha">Confirme a senha</label>
                    <input id="confirme_senha" type="password" name="confirme_senha" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="confirme_senha">Data de cadastro: </label>
                    {{ $usuario->created_at->format('d/m/Y') }}
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Salvar">
                    <a class="btn btn-info" href="{{ url('usuarios') }}">Cancelar</a>
                </div>
            </fieldset>
        </form>


    </div>




@endsection

@section('script')

    <script>

        $('#success').hide();
        $('#error').hide();

        $(document).ready(function() {
            $('#data_nascimento').mask('00/00/0000');

        });

        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    url: "{{ route('usuarios.update', ['id'=>$usuario->id]) }}",
                    type: 'post',
                    dataType: 'json',
                    data: $('#commentForm').serialize(),

                    cache: false,
                    beforeSend: function() {
                    },
                    success: function(response) {
                        console.log(response.statusCode);
                        if(response.statusCode == true){
                            $('#success').show();

                        } else {
                            $('#error').show();
                        }
                    },
                    complete: function() {
                    },
                    error: function() {
                    }
                });

            }
        });

        $(document).ready(function() {
            // validate the comment form when it is submitted
            //$("#commentForm").validate();

            // validate signup form on keyup and submit
            $("#commentForm").validate({
                rules: {
                    nome: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    senha: {
                        required: true,
                        minlength: 8
                    },
                    confirme_senha: {
                        required: true,
                        minlength: 8,
                        equalTo: "#senha"
                    }
                },
                messages: {
                    nome: "Nome obrigatório",
                    email: "E-mail obrigatório",
                    senha: {
                        required: "Informa senha",
                        minlength: "Informe pelo menos 8 caracteres"
                    },
                    confirme_senha: {
                        required: "Informe a senha",
                        minlength: "Informe pelo menos 8 caracteres",
                        equalTo: "Senha diferente"
                    },
                }
            });

        });


    </script>



@endsection
