@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush @if(in_array('view_user', $permissions)) table-hover @endif" id="dataTableHover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">CPF</th>
                        <th class="text-center">Perfil</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center cpf">{{ $user->cpf }}</td>
                                <td class="text-center">{{ $user->profile->name ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if(in_array('view_user', $permissions))
                                        <a href="{{ route('admin.users.view', [ 'uuid' => $user->uuid ]) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Visualizar Usuário">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    @endif

                                    @if(in_array('update_user', $permissions))
                                        <a href="{{ route('admin.users.edit', ['uuid' => $user->uuid]) }}" class="btn btn-warning btn-sm " data-toggle="tooltip" data-placement="top" title="Editar Usuário">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                    @endif


                                    @if(in_array('destroy_user', $permissions))
                                        <a href="{{ route('admin.users.destroy', [ 'uuid' => $user->uuid]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir Usuário">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-primary mb-1" onclick="window.location.href = '{{ route('admin.users.create') }}'">Novo Usuário</button>

        </div>
    </div>
@endsection
