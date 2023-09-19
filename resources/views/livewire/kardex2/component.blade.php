<div>

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


<script>
    document.addEventListener('livewire:load', function() {
        const clienteSelect2 = $('#cliente')
        const servicioSelect2 = $('#tipo')

        clienteSelect2.select2();
        servicioSelect2.select2();

        clienteSelect2.on('change', function(e) {
            var clienteId = clienteSelect2.select2("val");
            @this.set('cliente', clienteId);
        });

        servicioSelect2.on('change', function(e) {
            var servicioId = sevicioSelect2.select2("val");
            @this.set('servicio', servicioId);
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

        livewire.on('kardex-added', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })

       /*  livewire.on('updateSelect2Remitente', function() {
            remitenteSelect2.val(@this.get('selectedRemitente')).trigger('change');
        }) */
    });
</script>