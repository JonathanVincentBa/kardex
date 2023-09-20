<div>
    <div class="widget-heading">
        <h4 class="card-title">
            <b>{{ $componetName }} | {{ $pageTitle }} </b>
        </h4>

    </div>
    <div class="widget-content">
        <div class="row layout-top-spacing">
            <div class="col-sm-12 col-md-8">
                <!-- BUSCADOR -->
                @include('livewire.kardex.partials.buscador')
                <!-- DETALLES -->
                @include('livewire.kardex.partials.detail')
            </div>
            <div class="col-sm-12 col-md-4">

                <!-- ASUNTO -->
                @include('livewire.kardex.partials.datos')
            </div>
        </div>
    </div>


    <script>
        function Habilitar() {
            var des = document.getElementById('desde');
            var has = document.getElementById('hasta');

            if (des.value != "") {
                has.disabled = false;
            } else {
                has.disabled = true;
            }
        }
        document.addEventListener('livewire:load', function() {
            const clienteSelect2 = $('#cliente')
            const servicioSelect2 = $('#tipo')
            const desdeDatePicker = $('#desde')
            const hastaDatePicker = $('#hasta')

            clienteSelect2.select2();
            servicioSelect2.select2();

            clienteSelect2.on('change', function(e) {
                var clienteId = clienteSelect2.select2("val");
                @this.set('cliente', clienteId);
            });

            servicioSelect2.on('change', function(e) {
                var servicioId = servicioSelect2.select2("val");
                @this.set('servicio', servicioId);
            });

            desdeDatePicker.datepicker({
                width: 300,
                format: 'yyyy-mm-dd'
            });
            desdeDatePicker.on('change', function(e) {
                var desdeId = desdeDatePicker.datepicker("val");
                @this.set('desde', desdeId);
            });

            hastaDatePicker.datepicker({
                width: 300,
                format: 'yyyy-mm-dd'
            });

            hastaDatePicker.on('change', function(e) {
                var hastaId = hastaDatePicker.datepicker("val");
                @this.set('hasta', hastaId);
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

            livewire.on('updateSelect2Cliente', function() {
                clienteSelect2.val(@this.get('cliente')).trigger('change');
                clienteSelect2.removeAttr('disabled');
            })

            livewire.on('updateSelect2Servicio', function() {
                servicioSelect2.val(@this.get('servicio')).trigger('change');
                servicioSelect2.removeAttr('disabled');
            })
        });
    </script>
