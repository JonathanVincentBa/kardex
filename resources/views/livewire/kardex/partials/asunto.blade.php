<div class="row">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-3">SELECCIONAR UN CLIENTE</h5>
            <div class="connect-sorting-content">

                <div class="car-body">
                    <div class="task-header">
                        <div class="row justify-content-between">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div wire:ignore class="input-group mb-4" width="100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <select wire:model='cliente' id="cliente" class="form-control"
                                        data-placeholder="SELECCIONE UN CLIENTE">
                                        <option value="" disabled>SELECCIONE UN CLIENTE</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <h5 class="text-center mb-2">SERVICIOS</h5>
            <div class="car-body">
                <div class="task-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group mb-4" width="100%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <select wire:model='servicio' id="tipo" class="form-control"
                                    data-placeholder="SELECCIONE UN CLIENTE PRIMERO">
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->codigo }} -
                                            {{ $servicio->carpeta }} </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!is_null($servicio))
                <div class="connect-sorting-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="input-group input-group-md mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp hideonsm"
                                        style="font-size: 15px; font-weight: bold;">
                                        Fecha:
                                    </span>
                                </div>
                                <input type="text" value="{{ $fechaActual }}" class="form-control text-center"
                                    disabled>
                            </div>
                            <div class="input-group input-group-md mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp hideonsm"
                                        style="font-size: 13px; font-weight: bold;">
                                        Realizado por:
                                    </span>
                                </div>
                                <input style="font-size: 13px;" type="text" value="{{ Auth::user()->name }}"
                                    class="form-control text-center"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
                            </div>
                            <div class="input-group input-group-md mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp hideonsm"
                                        style="font-size: 15px; font-weight: bold;">
                                        Destinatario
                                    </span>
                                </div>
                                <input wire:model="destinatario" type="text" value=""
                                    class="form-control text-center"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="text-center">
                                <span style="font-size: 15px; font-weight: bold;">
                                    DESCRIPCIÓN
                                </span>
                            </div>
                            <textarea wire:model="descripcion" class="form-control" rows="3" style="text-transform:uppercase;"
                                onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>

                        </div>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
                    <button wire:click.prevent="saveKardex" class="btn btn-dark btn-md btn-block">
                        Guardar F9
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
