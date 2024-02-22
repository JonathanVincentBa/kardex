<div class="row">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-3">SELECCIONAR UN CLIENTE</h5>
            <div class="connect-sorting-content">

                <div wire:ignore class="car-body">
                    <div class="task-header">
                        <div class="row justify-content-between">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input-group mb-4" width="100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <select id="cliente" class="form-control">
                                        <option value="" disabled selected>SELECIONAR UN CLIENTE</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->codigo }} - {{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-4" width="100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <input wire:model='search' class="form-control" type="text"
                                        placeholder="BUSCAR SEGÚN EL CLIENTE">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @can('control-archivos.create')
            <h5 class="text-center mb-2">SERVICIOS</h5>
            <div wire:ignore class="car-body">
                <div class="task-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group mb-4" width="100%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>

                                <select id="tipo" class="form-control" data-placeholder="SELECCIONE UN SERVICIO">
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->codigo }} -
                                            {{ $tipo->nombre }} </option>
                                    @endforeach
                                </select>
                                @error('tipo_servicio_id')
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
                                        Carpeta
                                    </span>
                                </div>
                                <input type="text" value="{{ $codigo }}" class="form-control text-center" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
