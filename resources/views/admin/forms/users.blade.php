<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nome</label>
    <div class="col-sm-9">
        <input required type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? null)  }}" id="name" name="name" placeholder="Nome">
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">E-mail</label>
    <div class="col-sm-9">
        <input @if($user) readonly @endif required type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? null) }}" id="email" name="email" placeholder="E-mail">
    </div>
</div>

<div class="form-group row">
    <label for="cpf" class="col-sm-3 col-form-label">CPF</label>
    <div class="col-sm-9">
        <input @if($user) readonly @endif required type="text" class="cpf form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf', $user->cpf ?? null) }}" id="cpf" name="cpf" placeholder="CPF">
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">Senha</label>
    <div class="col-sm-9">
        <input @if($user) readonly @endif required type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Senha">
    </div>
</div>
@if(count($profiles) > 0)
    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Perfil</label>
        <div class="col-sm-9">
            <select class="select2-single form-control" name="profile" id="profile">
                <option value="">Selecione...</option>
                @foreach($profiles as $profile)
                    <option value="{{ $profile->uuid }}" {{ isset($user) && !is_null($user->profile) && $user->profile->id == $profile->id ? 'selected' : ''  }} >{{ $profile->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
