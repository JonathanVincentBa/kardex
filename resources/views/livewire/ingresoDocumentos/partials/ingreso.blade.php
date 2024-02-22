<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">INGRESO DE DOCUMENTOS</h5>
            <div class="container">
                <div class="row">
                    <label for="">Fecha y Hora: </label>
                    <input class="form-control" type="text" value="{{ $fechaActual }}" disabled>
                </div>
                <div class="row">
                    <label for="">Recibido Por:</label>
                    <input wire:model='user' class="form-control" type="text" value=""
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        disabled>
                </div>
                <div class="row">
                    <label for="">Empresa:</label>
                    <input wire:model="remitente" class="form-control" type="text" value="Empresa"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
                @error('remitente')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                <div class="row">
                    <label for="">Destino Final:</label>
                    <input wire:model="destinatario" class="form-control" type="text" value="Destino final"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
                @error('destinatario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            </div>
            <div class="connect-sorting">
                <h5 class="text-center mb-2">ASUNTO O MOTIVO DEL DOCUMENTO</h5>
                <div class="container">
                    <div class="row">
                        <textarea wire:model="detalle" class="form-control" rows="3" style="text-transform:uppercase;"
                            onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                    </div>
                    @error('detalle')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
    </div>
    @if ($select_id > 0) 
        <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
            <button wire:click.prevent="actualizarIngresoDocumentos" class="btn btn-dark btn-md btn-block">
                Actualizar
            </button>
        </div>
        
        
    @else 
        <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
            <button wire:click.prevent="saveIngresoDocumentos" class="btn btn-dark btn-md btn-block">
                Guardar
            </button>
        </div>
    @endif
</div>
