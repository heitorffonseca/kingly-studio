
<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nome</label>
    <div class="col-sm-9">
        <input required type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $profile->name ?? null)  }}" id="name" name="name" placeholder="Nome">
    </div>
</div>

<div class="form-group row">
    <label for="permissions" class="col-sm-3 col-form-label">Permissões</label>
    <div class="col-sm-9">
        @foreach($permissionsToSync as $permission)
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" {{ isset($profile) && in_array($permission->reference, $permissionsToProfile) ? 'checked': '' }} value="{{ $permission->uuid }}" name="permissions[]" id="{{ $permission->uuid }}">
                <label class="custom-control-label" for="{{ $permission->uuid }}">{{ $permission->name }}</label>
            </div>
        @endforeach
    </div>
</div>
