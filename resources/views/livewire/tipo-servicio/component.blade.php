<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <a href="javascript:void(0)" class="btn btn-dark float-right" data-toggle="modal"
                    data-target="#theModal">Agregar</a>
                <h4 class="card-title">
                    <b>{{ $componetName }} | {{ $pageTitle }} </b>
                </h4>

            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">Nombre</th>
                                <th class="table-th text-wite">Codigo</th>
                                <th class="table-th text-wite">Servicio</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipoServicios as $tipoServicio)
                                <tr>
                                    <td>{{ $tipoServicio->servicio }}</td>
                                    <td>{{ $tipoServicio->codigo }}</td>
                                    <td>{{ $tipoServicio->nombre }}</td>
                                    <td>
                                        <a href="javascript:void(0)" wire:click='Edit({{ $tipoServicio->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                            onclick="Confirm('{{ $tipoServicio->id }}')"
                                            class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tipoServicios->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.tipo-servicio.form')
</div>

<script>
    document.addEventListener('livewire:load', function() {
        const servicioSelect2 = $('servicioid');

        servicioSelect2.select2({
                placeholder: '{{ __('SELECCIONE UN CLIENTE') }}',
                allowClear: true
            });

        window.livewire.on('tipoServicio-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('tipoServicio-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('tipoServicio-deleted', msg => {
            noty(msg)
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');

        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');

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

    function Confirm(id) {
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
