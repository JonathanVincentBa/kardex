<div>
    <select wire:model="selectedCliente" id="cliente">
        <option value="">Select Country</option>
        @foreach ($clientes as $item)
            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
        @endforeach
    </select>

    <label for="city">City:</label>
    <select id="city">
        <option value="">Select City</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
</div>