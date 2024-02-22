<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <h3 class="text-center mb-2"><b>SELECCIÓN DE FECHAS</b></h3>
        </div>	
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha desde</b></label>
            <input wire:model='desde'  type="date" class = "form-control">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha hasta</b></label>
            @if (!is_null($desde))
                <input wire:model='hasta' type="date" class = "form-control" >
            @else
                <input wire:model='hasta' type="date" class = "form-control"disabled>
            @endif
            
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div  wire:ignore class="form-group text-center">
            <label for="nombre"><b>Seleccione un remitente</b></label>
            <select wire:model='selectedRemitente' id="remitente" class="form-control">
                <option value="" disabled selected>SELECIONAR UN REMITENTE</option>
                @foreach ($remitentes as $remi)
                    <option value="{{$remi->remitente}}">{{ $remi->remitente }}</option>
                @endforeach
            </select>
            @error('remitente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>