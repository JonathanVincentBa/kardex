<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="car simple-title-task ui-sortable-handle">
            <div class="car-body">
                <div class="table-responsive tblscroll" style="max-height: 499px; overflow-y: scroll; overflow-y: auto;">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                                <th width="8%" class="table-th text-center text-white">CLIENTE</th>
                                <th width="8%" class="table-th text-center text-white"># TRAMITE</th>
                                <th width="8%" class="table-th text-center text-white">DESTINATARIO</th>
                                <th width="8%" class="table-th text-center text-white">ENVIADO POR</th>
                                <th width="8%" class="table-th text-center text-white">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kardexes as $item)
                                <tr>
                                    <td>{{ $item->cliente }}</td>
                                    <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                    <td>{{ $item->destinatario }}</td>
                                    <td>{{ $item->enviadoPor }}</td>
                                    <td width="8%">
                                        <button type="button" wire:click='Edit({{ $item->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- <button type="button" onclick="Confirm('{{ $item->id }}')"
                                                class="btn btn-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
