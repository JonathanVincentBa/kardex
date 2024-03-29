@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <select wire:model='servicioid' id="servicioid" class="form-control">
                    <option></option>
                    @foreach ($servicios as $servicio)
                        <option value="{{$servicio->id}}">{{$servicio->nombre}} - {{$servicio->codigo}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('servicioid')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit"></span>
                    </span>
                </div>
                <input type="text" wire:model.lazy='codigo' class="form-control" placeholder="CODIGO" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            </div>
        </div>
        @error('codigo')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12">
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

@include('common.modalFooter')
