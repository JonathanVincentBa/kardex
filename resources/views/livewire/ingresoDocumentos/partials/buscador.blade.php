<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <h3 class="text-center mb-2"><b>SELECCIÓN DE FECHAS</b></h3>
        </div>	
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha desde</b></label>
            <input wire:model=''  type="date" class = "form-control">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha hasta</b></label>
            <input type="date" class = "form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione un cliente</b></label>
            <select wire:model='selectedCliente' id="cliente" class="form-control">
                <option value="" disabled selected>SELECIONAR UN CLIENTE</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->remitente }}">{{ $cliente->remitente }}</option>
                @endforeach
            </select>
            @error('cliente_id')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>