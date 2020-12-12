@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perfis</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfis</li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush @if(in_array('view_profile', $permissions)) table-hover @endif" id="dataTableHover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td class="text-center">
                                    @if(in_array('view_profile', $permissions))
                                        <a href="{{ route('admin.profiles.view', [ 'uuid' => $profile->uuid ]) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Visualizar Perfil">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    @endif

                                    @if(in_array('update_profile', $permissions))
                                        <a href="{{ route('admin.profiles.edit', ['uuid' => $profile->uuid]) }}" class="btn btn-warning btn-sm " data-toggle="tooltip" data-placement="top" title="Editar Perfil">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                    @endif


                                    @if(in_array('destroy_profile', $permissions))
                                        <a href="{{ route('admin.profiles.destroy', [ 'uuid' => $profile->uuid]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir Perfil">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-primary mb-1" onclick="window.location.href = '{{ route('admin.profiles.create') }}'">Novo Perfil</button>

        </div>
    </div>
@endsection
