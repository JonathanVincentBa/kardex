<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="car simple-title-task ui-sortable-handle">
            <div class="car-body">
                @if ($selectedCliente != '')
                    <div class="table-responsive tblscroll"
                        style="max-height: 499px; overflow-y: scroll; overflow-y: auto;">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3b3f5c">
                                <tr>
                                    <th width="8%" class="table-th text-center text-white">CODIGO</th>
                                    <th width="8%" class="table-th text-center text-white">CLIENTE</th>
                                    <th width="8%" class="table-th text-center text-white">CARPETA</th>
                                    <th width="8%" class="table-th text-center text-white">ASUNTO</th>
                                    <th width="8%" class="table-th text-center text-white">CREADO POR</th>
                                    <th width="8%" class="table-th text-center text-white">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!is_null($search))
                                    @foreach ($controles as $item)
                                        <tr>
                                            <td class="table-th text-center">{{ $item->cod_cliente }}</td>
                                            <td>{{ $item->cliente }}</td>
                                            <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                            <td>{{ $item->asunto }}</td>
                                            <td>{{ $item->usuario }}</td>
                                            <td width="8%">
                                                @can('control-archivos.uptated')
                                                    <button type="button" wire:click='Edit({{ $item->id }})'
                                                        class="btn btn-dark mtmobile" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endcan
                                                <button type="button" onclick="Confirm('{{ $item->id }}')"
                                                    class="btn btn-dark" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($controlArchivos as $item)
                                        <tr>
                                            <td class="table-th text-center">{{ $item->cod_cliente }}</td>
                                            <td>{{ $item->cliente }}</td>
                                            <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                            <td>{{ $item->asunto }}</td>
                                            <td>{{ $item->usuario }}</td>
                                            <td width="8%">
                                                @can('control-archivos.uptated')
                                                    <button type="button" wire:click='Edit({{ $item->id }})'
                                                        class="btn btn-dark mtmobile" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endcan


                                                <button type="button" onclick="Confirm('{{ $item->id }}')"
                                                    class="btn btn-dark" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5 class="text-center text-white" style="background: #3b3f5c;">Selecciona un cliente</h5>
                @endif
                <div wire:loading.inline wire:target='saveSale'>
                    <h4 class="text-danger text-center">Guardando Registro...</h4>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function Confirm(control) {
                Swal.fire({
                    title: 'NÚMERO CARPETA PASIVO',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: '#3b3f5c',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#d33',
                    preConfirm: (valor) => {
                        if (!valor) {
                            Swal.showValidationMessage('Por favor, ingrese un valor');
                        }
                    }
                }).then((result) => {
                    const idRegistro = control;
                    if (result.isConfirmed) {
                        Livewire.emit('deleteRow', result.value, idRegistro)
                    }
                });
            }
        </script>
    @endpush
</div>
