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

            @can('control-archivos.create')
                <!-- ASUNTO -->
                @include('livewire.controlArchivos.partials.asunto')
            @endcan
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

        function noty(msg) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        }
        Livewire.on('control-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        Livewire.on('control-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        Livewire.on('control-deleted', msg => {
            noty(msg)
        })
    </script>
    @stack('scripts')
@endsection
