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
                                <th class="table-th text-wite">Codigo</th>
                                <th class="table-th text-wite">Nombre</th>
                                <th class="table-th text-wite">D.N.I.</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->codigo }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->dni }}</td>
                                    <td>
                                        <a href="javascript:void(0)" wire:click='Edit({{ $cliente->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                            onclick="Confirm('{{ $cliente->id }}','{{ $cliente->contacto_clientes->count() }}')"
                                            class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.cliente.form')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('cliente-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('cliente-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('cliente-deleted', msg => {
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
                window.livewire.emit('deleteRow', id)
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
