<div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <select wire:model="selectedCliente" id="cliente" class="form-control" >
            <option></option>
            @foreach ($clientes as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <select wire:model="selectedServicio" id="tipo" class="form-control">
            <option></option>
            @foreach ($servicios as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
</div>
