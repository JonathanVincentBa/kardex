<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{ $componentName }}</b>
                </h4>
            </div>
            <div class="widget-content">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model='role' class="form-control">
                            <option value="Elegir" selected disabled>== Selecione el Role ==</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                            </option>
                        </select>
                    </div>
                    <button wire:click='SyncAll()' type="button" class="btn btn-dark mbmobile inblock mr-5">Sincronizar
                        Todos</button>
                    <button onclick='Revocar()' type="button" class="btn btn-dark mbmobile mr-5">Revocar Todos</button>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-resposive">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c;">
                                    <tr>
                                        <th class="table-th text-wite text-center">ID</th>
                                        <th class="table-th text-wite text-center">PERMISO</th>
                                        <th class="table-th text-wite text-center">ROLES CON EL PERMISO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>
                                                <h6 class="text-center">{{ $permiso->id }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <div class="n-check">
                                                    <label class="new-control new-checkbox checkbox-primary">
                                                        <input type="checkbox"
                                                            wire:change="SyncPermiso($('#p' + {{ $permiso->id }}).is(':checked'), '{{ $permiso->name }}' )"
                                                            id="p{{ $permiso->id }}" value="{{ $permiso->id }}"
                                                            class="new-control-input"
                                                            {{ $permiso->checked == 1 ? 'checked' : '' }}>
                                                        <span class="new-control-indicator"></span>
                                                        <h6>{{ $permiso->name }}</h6>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ \App\Models\User::permission($permiso->name)->count() }}</h6>
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
        </div>
    </div>
    include form
</div>


<script>
    document.addEventListener('livewire:load', function() {
        livewire.on('sync-error', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })
        livewire.on('sync-permi', msg => {
            noty(msg)
        })
        livewire.on('sync-all', msg => {
            noty(msg)
        })
        livewire.on('remove-all', msg => {
            noty(msg)
        })

        livewire.on('permi', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })
        livewire.on('permi-error', msg => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        })
    });

    function Revocar() {
        Swal.fire({
            title: 'CONFIRMAR',
            text: "¿ CONFIRMAS REVOCAR TODOS LOS PERMISOS ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b3f5c',
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                window.livewire.emit('revokeall')
                swal.close()
            }
        })
    }

    function noty(msg) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 1500
        })
    };

    function notyError(msg) {

    };
</script>
