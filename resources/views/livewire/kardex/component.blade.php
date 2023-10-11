<div>
    <div class="widget-heading">
        <h4 class="card-title">
            <b>{{ $componetName }} | {{ $pageTitle }} </b>
        </h4>

    </div>
    <div class="widget-content">
        <div class="row layout-top-spacing">
            <div class="col-sm-12 col-md-7">
                <!-- BUSCADOR -->
                @include('livewire.kardex.partials.buscador')
                <!-- DETALLES -->
                @include('livewire.kardex.partials.detail')
            </div>
            <div class="col-sm-12 col-md-5">

                <!-- ASUNTO -->
                @include('livewire.kardex.partials.datos')
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('livewire:load', function() {
        const clienteSelect2 = $('#cliente')
        const servicioSelect2 = $('#tipo')

        clienteSelect2.select2({
            placeholder: '{{ __('SELECCIONE UN CLIENTE') }}',
            allowClear: true
        });
        servicioSelect2.select2({
            placeholder: '{{ __('SELECCIONE CLIENTE PRIMERO') }}',
            allowClear: true,
        });

        clienteSelect2.on('change', function(e) {
            var clienteId = clienteSelect2.select2("val");
            @this.set('clienteId', clienteId);
        });

        servicioSelect2.on('change', function(e) {
            var servicioId = servicioSelect2.select2("val");
            @this.set('servicioId', servicioId);
        });
        $(document).ready(function() {
            window.initSelectStationDrop = () => {
                servicioSelect2.select2({
                    placeholder: '{{ __('SELECCIONE UN SERVICIO') }}',
                    allowClear: true,
                });
            }
            initSelectStationDrop();
            window.livewire.on('select2Servicio', () => {
                initSelectStationDrop();
            });

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
        livewire.on('updateSelect2', function() {
            servicioSelect2.val(@this.get('servicioId')).trigger('change');
            clienteSelect2.val(@this.get('clienteId')).trigger('change');
        })
    });
</script>
