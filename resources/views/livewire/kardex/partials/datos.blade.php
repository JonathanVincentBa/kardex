<div class="row">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <div class="connect-sorting-content">
                <div class="car-body">
                    <div class="task-header">
                        <div class="row justify-content-between">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h5 class="text-center mb-3">SELECCIONAR UN CLIENTE</h5>
                                <div wire:ignore class="input-group mb-4" width="100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <select wire:model='clienteId' id="cliente" style="width:400px">
                                        <option></option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <h5 class="text-center mb-2">SERVICIOS</h5>

                                <div wire:ignore class="input-group mb-4" width="100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <select id="tipo" style="width:400px">
                                        <option value=""></option>
                                    </select>
                                </div>
                                @if (!is_null($servicioId))
                                    <div class="input-group input-group-md mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-gp hideonsm"
                                                style="font-size: 15px; font-weight: bold;">
                                                Fecha:
                                            </span>
                                        </div>
                                        <input type="text" value="{{ $fechaActual }}"
                                            class="form-control text-center" disabled>
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
                                            <span class="input-group-text input-gp hideonsm "
                                                style="font-size: 15px; font-weight: bold;">
                                                Destinatario
                                            </span>
                                        </div>
                                        <input wire:model="destinatario" type="text" value=""
                                            class="form-control text-center">
                                    </div>
                                    @error('destinatario')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                    <div class="text-center">
                                        <span style="font-size: 15px; font-weight: bold;">
                                            DESCRIPCIÓN:
                                        </span>
                                    </div>
                                    <textarea wire:model="descripcion" class="form-control" rows="3"></textarea>
                                    @error('descripcion')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
                                        @if ($selected_id != null)
                                            <button wire:click.prevent="actualizarKardex"
                                                class="btn btn-dark btn-md btn-block">
                                                Actualizar
                                            </button>
                                        @else
                                            <button wire:click.prevent="saveKardex"
                                                class="btn btn-dark btn-md btn-block">
                                                Guardar
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
