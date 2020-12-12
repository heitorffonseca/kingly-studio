@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes da Nota Fiscal</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home')  }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.invoices.home')  }}">Notas Fiscais</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes da Nota Fiscal</li>
        </ol>
    </div>

    <div class="card">
        <div class="card-body">
            <dl>
                <dt>Nome:</dt>
                <dd>{{ $invoice->name  }}</dd>

                <dt>E-mail:</dt>
                <dd>{{ $invoice->email  }}</dd>

                <dt>CPF:</dt>
                <dd class="cpf">{{ $invoice->cpf  }}</dd>

                <dt>CEP:</dt>
                <dd class="cep">{{ $invoice->cep }}</dd>

                <dt>Endereço:</dt>
                <dd>{{ $invoice->street  }}</dd>

                <dt>Número:</dt>
                <dd>{{ $invoice->number  }}</dd>

                <dt>Complemento:</dt>
                <dd>{{ $invoice->complement ?? 'N/A' }}</dd>

                <dt>Bairro:</dt>
                <dd>{{ $invoice->neighborhood  }}</dd>

                <dt>Cidade:</dt>
                <dd>{{ $invoice->city  }}</dd>

                <dt>Estado:</dt>
                <dd>{{ $invoice->state  }}</dd>

                <dt>Situação:</dt>
                <dd>{{ $invoice->validated == 0 ? 'Necessário validação' : 'Validado'  }}</dd>

                <dt>Data de Registro:</dt>
                <dd>{{ date_format(date_create($invoice->created_at), 'd/m/Y H:m:s')  }}</dd>

                <dt>Nota Fiscal:</dt>
                <dd>
                    <img src="{{ $invoiceImage }}">
                </dd>

            </dl>

            @if($invoice->validated == 0 && in_array('validate_invoice', $permissions))
                <a href="{{ route('admin.invoices.validate', ['uuid' => $invoice->uuid]) }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Validar</span>
                </a>
            @endif
        </div>
    </div>
@endsection
