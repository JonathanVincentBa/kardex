<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <a href="javascript:void(0)" class="btn btn-dark float-right" data-toggle="modal"
                    data-target="#theModal">Agregar</a>
                <h4 class="card-title">
                    <b>{{ $componetName }} | {{ $pageTitle }}</b>
                </h4>
            </div>

            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">CLIENTE</th>
                                <th class="table-th text-wite">CONTACTO</th>
                                <th class="table-th text-wite">E-MAIL</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactoClientes as $contactoCliente)
                                <tr>
                                    <td>
                                        <h6>{{ $contactoCliente->cliente }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $contactoCliente->nombre }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $contactoCliente->email }}</h6>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            wire:click.prevent='Edit({{ $contactoCliente->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $contactoCliente->id }}')"
                                            class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $contactoClientes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.contacto-cliente.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#clienteid').select2();
        $('#clienteid').on('change', function(e) {
            var clienteId = $('#clienteid').select2("val");
            @this.set('clienteid', clienteId);
        });

        window.livewire.on('contactoCliente-added', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('contactoCliente-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('contactoCliente-deleted', msg => {
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
