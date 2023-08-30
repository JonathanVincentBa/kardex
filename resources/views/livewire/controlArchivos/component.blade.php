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
        window.livewire.on('controlArchivo-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('controlArchivo-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('controlArchivo-deleted', msg => {
            noty(msg)
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');

        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');

        })
        window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display', 'none');

        })
    });

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
            var tipoId = $('#tipo').select2("val");
            @this.set('selectedTipo', tipoId);
        });
    });

    function Confirm(control) {

        Swal.fire({
            title: 'CONFIRMAR',
            text: "CONFIRMAS ELIMINAR EL REGISTRO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b3f5c',
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                window.livewire.emit('deleteRow', control)
                swal.close()
            }
        })
    }
</script>
