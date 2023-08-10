<div class="row">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-3">SELECCIONAR UN CLIENTE</h5>
            <div class="connect-sorting-content">
                
                    <div class="car-body">
                        <div class="task-header">
                            <div class="row justify-content-between">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group mb-4" width="100%" wire:ignore>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-gp">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                        <select wire:model='search' id="cliente" class="form-control">
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->nombre }}">{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('clienteid')
                                            <span class="text-danger er">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{ $clienteId }}
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
            <h5 class="text-center mb-2">SERVICIOS</h5>
            <div class="container">
                <div class="row">
                    <div class="row justify-content-between">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group mb-4" width="100%" wire:ignore>
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <select wire:model='tipoId' id="tipo" class="form-control">
                                    @foreach ($tipos as $tipo)
                                        <option value=" {{ $tipo->id }}">{{ $tipo->codigo }} - {{ $tipo->nombre }} </option>
                                     @endforeach 
                                </select>
                                @error('tipoid')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="connect-sorting-content">
                <div class="card simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        <div class="input-group input-group-md mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp hideonsm"
                                    style="background: #3b3f5c; color:white">
                                    Codigo
                                </span>
                            </div>
                            <input type="text" id="cash" wire:model='efectivo' wire:keydown.enter='saveSale'
                                class="form-control text-center" value= disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
