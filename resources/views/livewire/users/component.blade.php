<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <a href="javascript:void(0)" class="btn btn-dark float-right" data-toggle="modal"
                    data-target="#theModal">Agregar</a>
                <h4 class="card-title">
                    <b> {{ $componetName }} | {{ $pageTitle }}</b>
                </h4>
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">USUARIO</th>
                                <th class="table-th text-wite text-center">EMAIL</th>
                                <th class="table-th text-wite text-center">ROLE</th>
                                <th class="table-th text-wite text-center">ESTATUS</th>
                                <th class="table-th text-wite text-center">IMAGEN</th>
                                <th class="table-th text-wite text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        <h6>{{ $item->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $item->email }}</h6>
                                    </td>
                                    <td class="text-center"><span>{{ $item->role }}</span></td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $item->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} text-uppercase">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($item->imagen == null)
                                            <img src="{{ asset('storage\users\noimg.png') }}" width="40"
                                                height="30" alt="User Image">
                                        @else
                                            <img src="{{ asset('storage/users/' . $item->imagen) }}" width="25"
                                                height="25" alt="User Image">
                                        @endif



                                    </td>
                                    <td>
                                        <button wire:click='Edit({{ $item->id }})' class="btn btn-dark mtmobile"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="Confirm({{ $item->id }})" class="btn btn-dark"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.users.form')
</div>


<script>
    document.addEventListener('livewire:load', function() {
        livewire.on('user-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })

        livewire.on('user-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })

        livewire.on('user-deleted', msg => {
            noty(msg)
        })

        livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        })

        livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        })

        livewire.on('user-withsales', msg => {
            noty(msg)
        })

    });


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
