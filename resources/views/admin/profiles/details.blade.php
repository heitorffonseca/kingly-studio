@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes do Perfil</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.home')  }}">Perfis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes do Perfil</li>
        </ol>
    </div>

    <div class="card">
        <div class="card-body">
            <dl>
                <dt>Nome:</dt>
                <dd>{{ $profile->name }}</dd>

                <dt>Data de Registro:</dt>
                <dd>{{ date_format(date_create($profile->created_at), 'd/m/Y H:m:s') }}</dd>

                <dt>Permissões:</dt>

                @foreach($profile->permissions as $permission)
                    <dd>{{ $permission->name }}</dd>
                @endforeach
            </dl>

            @if(in_array('update_profile', $permissions))
                <a href="{{ route('admin.profiles.edit', ['uuid' => $profile->uuid]) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Editar</span>
                </a>
            @endif
        </div>
    </div>
@endsection
