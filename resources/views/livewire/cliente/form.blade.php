@include('common.modalHead')

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>CODIGO</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='codigo' class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
            </div>
        </div>
        @error('codigo')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>NOMBRE *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='nombre' class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus>
            </div>
        </div>
        @error('nombre')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>DNI*</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='dni' class="form-control">
            </div>
        </div>
        @error('dni')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>DIRECCIÓN</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='direccion' class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
            </div>
        </div>
        @error('direccion')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>CORREO ELECTRONICO*</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="email" wire:model.lazy='email' class="form-control" style="text-transform:lowercase;"  onkeyup="javascript:this.value=this.value.toLowerCase();">
            </div>
        </div>
        @error('email')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>TELÉFONO 1</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='fono1' class="form-control">
            </div>
        </div>
        @error('fono1')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>TELÉFONO 2</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='fono2' class="form-control">
            </div>
        </div>
        @error('fono2')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>

@include('common.modalFooter')
