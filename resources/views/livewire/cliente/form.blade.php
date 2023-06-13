@include('common.modalHead')

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='codigo' class="form-control" placeholder="CODIGO" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
            </div>
        </div>
        @error('codigo')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='nombre' class="form-control" placeholder="NOMBRE" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
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
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='dni' class="form-control" placeholder="DNI">
            </div>
        </div>
        @error('dni')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='direccion' class="form-control" placeholder="DIRECCIÓN" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">
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
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="email" wire:model.lazy='email' class="form-control" placeholder="CORREO ELECTRONICO" style="text-transform:lowercase;"  onkeyup="javascript:this.value=this.value.toLowerCase();">
            </div>
        </div>
        @error('email')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='fono1' class="form-control" placeholder="TELÉFONO 1">
            </div>
        </div>
        @error('fono1')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="number" wire:model.lazy='fono2' class="form-control" placeholder="TELÉFONO 2">
            </div>
        </div>
        @error('fono2')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>

@include('common.modalFooter')
