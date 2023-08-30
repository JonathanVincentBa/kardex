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
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#remitente').select2();
        $('#remitente').on('change', function(e) {
            var remitenteId = $('#remitente').select2("val");
            @this.set('selectedRemitente', remitenteId);
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
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>
