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
    document.addEventListener('livewire:load', function(){
        $('#cliente').select2();
        $('#cliente').on('change', function(){
            @this.set('search', this.value);
        });
    });
    document.addEventListener('livewire:load', function(){
        $('#tipo').select2();
        $('#tipo').on('change', function(){
            @this.set('tipoId', this.value);
        });
    });

</script>
