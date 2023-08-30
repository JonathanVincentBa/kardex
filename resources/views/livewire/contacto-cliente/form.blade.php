@include('common.modalHead')

<div wire:ignore class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>CLIENTE*</label>
            <br>
            <select wire:model='clienteid' id="clienteid" class="form-control" style="width: 100%">
                <option value="" disabled selected>SELECIONAR UN CLIENTE</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('clienteid')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>NOMBRE*</label>
            <input type="text" wire:model.lazy='nombre' class="form-control" "
                style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            @error('nombre')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>CORREO ELECTRONICO*</label>
            <input type="email" wire:model.lazy='email' class="form-control"
                style="text-transform:lowercase;" onkeyup="javascript:this.value=this.value.toLowerCase();">
            @error('email')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>TELÉFONO*</label>
            <input type="number" wire:model.lazy='fono' class="form-control" >
            @error('fono')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>EXTENSIÓN</label>
            <input type="number" wire:model.lazy='extension' class="form-control" >
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>CELULAR*</label>
            <input type="number" wire:model.lazy='celular' class="form-control" >
            @error('celular')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
