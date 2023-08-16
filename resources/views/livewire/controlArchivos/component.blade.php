<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- DETALLES -->
            @include('livewire.controlArchivos.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            <!-- BUSCADOR -->
            @include('livewire.controlArchivos.partials.buscador')

            <!-- ASUNTO -->
            @include('livewire.controlArchivos.partials.asunto')
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#cliente').select2();
        $('#cliente').on('change', function(e) {
            var clienteId = $('#cliente').select2("val");
            @this.set('selectedCliente', clienteId);
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        $('#tipo').select2();
        $('#tipo').on('change', function() {
            var tipoId = $('tipo').select2("val");
            @this.set('selectedTipo', tipoId);
        });
    });
</script>
