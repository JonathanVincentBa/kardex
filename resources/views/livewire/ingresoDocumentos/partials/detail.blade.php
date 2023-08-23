<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="car simple-title-task ui-sortable-handle">
            <div class="car-body">
                {{-- @if (!is_null($selectedCliente)) --}}
                    <div class="table-responsive tblscroll"
                        style="max-height: 499px; overflow-y: scroll; overflow-y: auto;">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3b3f5c">
                                <tr>
                                    <th width="8%" class="table-th text-center text-white">FECHA</th>
                                    <th width="8%" class="table-th text-center text-white">EMPRESA</th>
                                    <th width="8%" class="table-th text-center text-white">DOCUMENTO</th>
                                    <th width="8%" class="table-th text-center text-white">DESTINATARIO</th>
                                    <th width="8%" class="table-th text-center text-white">RECIBIDO POR</th>
                                    <th width="8%" class="table-th text-center text-white">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($controlArchivos as $item)
                                    <tr>
                                        <td>{{ $item->cliente }}</td>
                                        <td>{{ $item->tipo }} {{ $item->carpeta }}</td>
                                        <td>{{ $item->asunto }}</td>
                                        <td width="8%">
                                            <a href="javascript:void(0)" wire:click='Edit({{ $item->id }})'
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="javascript:void(0)" onclick="Confirm('{{ $item->id }}')"
                                                class="btn btn-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                {{-- @else 
                    <h5 class="text-center text-white" style="background: #3b3f5c;">Selecciona un cliente</h5>
                @endif--}}
                <div wire:loading.inline wire:target='saveSale'>
                    <h4 class="text-danger text-center">Guardando Registro...</h4>
                </div>

            </div>
        </div>
    </div>
</div>
