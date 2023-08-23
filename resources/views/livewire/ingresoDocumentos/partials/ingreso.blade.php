<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">INGRESO DE DOCUMENTOS</h5>
            <div class="container">
                <div class="row">
                    <label for="">Fecha y Hora: </label>
                    <input wire:model="fechaActual" class="form-control" type="text" value="{{ $fechaActual }}" disabled>
                </div>
                <div class="row">
                    <label for="">Recibido Por:</label>
                    <input wire:model="user" class="form-control" type="text" value="{{ Auth::user()->name }}" disabled>
                </div>
                <div class="row">
                    <label for="">Empresa:</label>
                    <input wire:model="empresa" class="form-control" type="text" value="Empresa">
                </div>
                <div class="row">
                    <label for="">Destino Final:</label>
                    <input wire:model="destino" class="form-control" type="text" value="Destino final">
                </div>
            </div>
        </div>
    </div>
</div>