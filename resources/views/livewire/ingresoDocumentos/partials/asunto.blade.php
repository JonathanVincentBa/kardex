<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">ASUNTO O MOTIVO DEL DOCUMENTO</h5>
            <div class="container">
                <div class="row">
                    <textarea wire:model="asunto" class="form-control" rows="3" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                </div>
            </div>
        </div>
    </div>
    @if (condition)
        <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
            <button wire:click.prevent="saveIngresoDocumentos" class="btn btn-dark btn-md btn-block">
                Guardar F9
            </button>
        </div>
    @else
        <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
            <button wire:click.prevent="saveIngresoDocumentos" class="btn btn-dark btn-md btn-block">
                Guardar F9
            </button>
        </div>
    @endif
</div>
