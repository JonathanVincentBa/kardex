<div>
    <div class="widget-heading">
        <h4 class="card-title">
            <b>{{ $componetName }} </b>
        </h4>
    </div>
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
    document.addEventListener('livewire:load', function() {
        const remitenteSelect2 = $('#remitente')
        remitenteSelect2.select2();
        remitenteSelect2.on('change', function(e) {
            var remitenteId = remitenteSelect2.select2("val");
            @this.set('selectedRemitente', remitenteId);
        });

        livewire.on('errorFecha', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })
        livewire.on('ingreso-added', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })
        livewire.on('ingreso-updated', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })

        livewire.on('updateSelect2Remitente', function() {
            remitenteSelect2.val(@this.get('selectedRemitente')).trigger('change');
        })
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
