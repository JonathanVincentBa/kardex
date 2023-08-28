<div>
    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- BUSCADOR -->
            @include('livewire.ingresoDocumentos.partials.buscador')

            <!-- DETALLES -->
            @include('livewire.ingresoDocumentos.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">


            <!-- Ingreso -->
            @include('livewire.ingresoDocumentos.partials.ingreso')

            <!-- ASUNTO -->
            @include('livewire.ingresoDocumentos.partials.asunto')
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
</script>
