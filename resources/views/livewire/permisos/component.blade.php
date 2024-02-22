<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <a href="javascript:void(0)" class="btn btn-dark float-right" data-toggle="modal"
                    data-target="#theModal">Agregar</a>
                <h4 class="card-title">
                    <b> {{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">CODIGO</th>
                                <th class="table-th text-wite">NOMBRE</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td>
                                        <h6>{{ $permiso->id }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $permiso->name }}</h6>
                                    </td>
                                    <td>
                                        <button wire:click='Edit({{ $permiso->id }})' class="btn btn-dark mtmobile"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button onclick="Confirm(' {{ $permiso->id }}')" class="btn btn-dark"
                                            title="Eliminar Registro">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $permisos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.permisos.form')
</div>


<script>
    document.addEventListener('livewire:load', function() {
        window.livewire.on('permiso-add', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('permiso-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('permiso-delete', msg => {
            noty(msg)
        })
        window.livewire.on('permiso-exists', msg => {
            noty(msg)
        })

        window.livewire.on('permiso-error', msg => {
            noty(msg)
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
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

    function Confirm(id, contacto_clientes) {
        if (contacto_clientes > 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'No se puede eliminar por que tiene registros relacionados',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }
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
                window.livewire.emit('destroy', id)
                swal.close()
            }
        })

        function noty(msg, option = 1) {
            Snackbar.show({
                text: msg.toUpperCase(),
                actionText: 'CERRAR',
                actionTextColor: '#fff',
                backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
                pos: 'top-rigth'
            });
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }
</script>