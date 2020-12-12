@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notas Fiscais</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notas Fiscais</li>
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
                        <th class="text-center">Cidade</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->name }}</td>
                            <td>{{ $invoice->email }}</td>
                            <td class="text-center">{{ $invoice->city }}</td>
                            <td class="text-center">{{ $invoice->state }}</td>
                            <td class="text-center">{{ $invoice->validated == 0 ? 'Necessita Validação' : 'Validado' }}</td>
                            <td class="text-center">
                                @if(in_array('view_invoice', $permissions))
                                    <a href="{{ route('admin.invoices.view', ['uuid' => $invoice->uuid]) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Visualizar Nota Fiscal">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                @endif

                                @if($invoice->validated == 0 && ein_array('validate_invoice', $permissions))
                                        <a href="{{ route('admin.invoices.validate', ['uuid' => $invoice->uuid]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Validar Nota Fiscal">
                                            <i class="fas fa-check"></i>
                                        </a>
                                @endif


                                @if(in_array('destroy_invoice', $permissions))
                                    <a href="{{ route('admin.invoices.destroy', ['uuid' => $invoice->uuid]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir Nota Fiscal">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
