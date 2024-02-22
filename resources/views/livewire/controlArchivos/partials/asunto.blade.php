<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">ASUNTO O MOTIVO DE LA CARPETA</h5>
            <div class="container">
                <div class="row">
                    <textarea wire:model="asunto" class="form-control" rows="3" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                </div>
                @error('asunto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center col-sm-12 col-md-12 col-lg-12 mt-3">
        @if ($selected_id > 1)
            <button type="button" wire:click.prevent="actualizarControl" class="btn btn-dark btn-md btn-block">
                Actualizar
            </button>
        @else
            <button type="button" wire:click.prevent="saveControl" class="btn btn-dark btn-md btn-block">
                Guardar
            </button>
        @endif

    </div>
</div>
