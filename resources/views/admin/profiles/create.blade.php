@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Novo Perfil</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.home')  }}">Perfis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Perfil</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.profiles.store') }}" method="POST">
                @csrf
                @include('admin.forms.profiles')

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
