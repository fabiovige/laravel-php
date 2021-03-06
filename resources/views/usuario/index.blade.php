@extends('usuario.template')

@section('content')

    <div class="container my-5">

        <h1>Lista de Usuários</h1>

        <a href="{{ route('usuarios.create') }}" class="btn btn-primary text-white rounded my-3"><i class="fa fa-plus-circle"></i> Cadastrar novo usuário</a>

        <div class="table-responsive">
            <table class='table table-striped table-hover'>
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>E-mail</td>
                        <td>Data de criação</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>

                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-right">
                            <a href="{{ route('usuarios.edit', ['id'=>$usuario->id]) }}" class="btn btn-info text-white rounded"><i class="fas fa-edit"></i> Editar</a>
                            <button  rel="{{ route('usuarios.destroy', ['id'=>$usuario->id] ) }}" id="{{ $usuario->id }}" class="btn btn-danger text-white rounded"><i class="fas fa-trash-alt"></i> Excluir</button>
                        </td>
                    </tr>
                @endforeach




                </tbody>
            </table>
        </div>
    </div>



@endsection



@section('script')


    <script type="text/javascript">
        $("button").click(function(){
            var url = $(this).attr('rel');
            var id = $(this).attr('id');


            if (confirm('Confirmar exclusão de usuário?')) {
                $.ajax({
                    url: url,
                    type: 'delete',
                    dataType: 'json',
                    data: { id: id, _token: '{{csrf_token()}}' },
                    cache: false,
                    beforeSend: function() {
                    },
                    success: function(response) {
                        window.location = '';
                    },
                    complete: function() {
                    },
                    error: function() {
                    }
                });
            }


        });
    </script>



@endsection


