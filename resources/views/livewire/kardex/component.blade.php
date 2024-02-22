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
            @include('livewire.kardex.partials.form')
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
            clienteSelect2.on('change', async function(e) {
                const clienteId = clienteSelect2.val();
                @this.set('clienteId', clienteId);
                console.log('Cliente', clienteId);
                const servicios = await @this.getDataServicios(clienteId);
                updateDataServicios(servicios);
            });
            servicioSelect2.on('change', function(e) {
                const servicioId = servicioSelect2.select2("val");
                @this.set('servicioId', servicioId);

            });

          const  updateDataServicios =  async function(servicios) {
                const dataServicios = await servicios;
                if (!dataServicios) {
                    return;
                }
                const data = [];
                dataServicios.map(function({
                    id,
                    codigo,
                    carpeta,
                    nombre
                }) {
                    const option = {
                        id: id,
                        text: `${codigo}-${carpeta}-${nombre}`
                    }
                    data.push(option);
                });
                servicioSelect2.select2('destroy');
                servicioSelect2.empty();
                servicioSelect2.select2({
                    placeholder: '{{ __('SELECCIONE UN SERVICIO') }}',
                    allowClear: true,
                    data: data
                });
                servicioSelect2.val(@this.get('servicioId')).trigger('change');
            }

       /*       $(document).ready(function() {
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
            });  */

            Livewire.on('updateSelect2', async function() {
                const clienteId = @this.get('clienteId');
                clienteSelect2.val(clienteId).trigger('change');
            })



            livewire.on('hide-modal', msg => {
                $('#theModal').modal('hide');

            })
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

        })
    </script>
</div>
