@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes do Usuário</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.home')  }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes do Usuário</li>
        </ol>
    </div>

    <div class="card">
        <div class="card-body">
            <dl>
                <dt>Nome:</dt>
                <dd>{{ $user->name }}</dd>

                <dt>E-mail:</dt>
                <dd>{{ $user->email }}</dd>

                <dt>CPF:</dt>
                <dd class="cpf">{{ $user->cpf }}</dd>

                <dt>Perfil:</dt>
                <dd>{{ $user->profile->name ?? 'N/A' }}</dd>

                <dt>Data de Registro:</dt>
                <dd>{{ date_format(date_create($user->created_at), 'd/m/Y H:m:s') }}</dd>
            </dl>

            @if(in_array('update_user', $permissions))
                <a href="{{ route('admin.users.edit', ['uuid' => $user->uuid]) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Editar</span>
                </a>
            @endif
        </div>
    </div>
@endsection
