<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <h3 class="text-center mb-2"><b>SELECCIÓN DE FECHAS</b></h3>
        </div>
    </div>
    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
        <div wire:ignore class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha desde</b></label>
            <input wire:model='desde' type="date" id="desde" class="form-control">
        </div>
    </div>
    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
        <div class="form-group text-center">
            <label for="nombre"><b>Seleccione una fecha hasta</b></label>
            @if (!is_null($desde))
                <input wire:model='hasta' type="date" class = "form-control" >
            @else
                <input wire:model='hasta' type="date" class = "form-control"disabled>
            @endif
        </div>
    </div>
</div>