@include('common.modalHead')

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>NOMBRE *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='name' class="form-control" style="text-transform:uppercase;"
                    onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus placeholder="ej: Jonathan Vincent">
            </div>
        </div>
        @error('name')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>CORREO *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='email' class="form-control"  placeholder="ej: correo@correo.com" style="text-transform:lowercase;"  onkeyup="javascript:this.value=this.value.toLowerCase();">
            </div>
        </div>
        @error('email')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>CONTRASEÑA *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="password" wire:model.lazy='password' class="form-control">
            </div>
        </div>
        @error('password')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>ESTATUS *</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="ELEGIR" selected disabled>ELEGIR</option>
                <option value="ACTIVE">ACTIVO</option>
                <option value="LOCKED">BLOQUEADO</option>
            </select>
        </div>
        @error('status')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>ASIGNAR ROL *</label>
            <select wire:model.lazy="role_id" class="form-control">
                <option value="ELEGIR" selected disabled>ELEGIR</option>
                @foreach ($roles as $role) 
                    <option value="{{ $role->id}}">{{$role->name}}</option>
                @endforeach
                
            </select>
        </div>
        @error('role_id')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>IMAGEN DE PERFIL</label>
            <input type="file" wire:model="imagen" accept="image/x-png,image/jpeg, image/gif" class="form-control">
        </div>
        @error('image')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>

@include('common.modalFooter')
