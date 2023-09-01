<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- BUSCADOR -->
            @include('livewire.kardex.partials.buscador')
            <!-- DETALLES -->
            @include('livewire.kardex.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">

            <!-- ASUNTO -->
            @include('livewire.kardex.partials.asunto')
        </div>
    </div>
</div>

@section('scripts')
    <script>
        document.addEventListener('livewire:load', function() {

            const servicioSelect2 = $('#tipo');

            $('#cliente').select2().val(@this.get('selectedCliente')).trigger('change');

            $('#cliente').on('change', function(e) {
                var clienteId = $('#cliente').select2("val");
                @this.updateCliente(clienteId);
            });




            console.log("Cliente id: ", @this.get('selectedCliente'), "selet servicio id: ", @this.get(
                'selectedTipo'));
            servicioSelect2.select2();
            servicioSelect2.val(@this.get('selectedTipo')).trigger('change');
            servicioSelect2.on('change', function() {
                var tipoId = servicioSelect2.select2("val");
                @this.set('selectedTipo', tipoId);
            });



            livewire.on('updateSelect2Servicio', function() {
                servicioSelect2.val(@this.get('selectedTipo')).trigger('change');
            })



        });
    </script>
    @stack('scripts')
@endsection
