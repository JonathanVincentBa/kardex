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
                                <th width="8%" class="table-th text-center text-white">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartas as $item)
                                <tr>
                                    <td>{{ $item->cliente }}</td>
                                    <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                    <td>{{ $item->destinatario }}</td>
                                    <td width="12%">
                                        <button type="button" wire:click='Edit({{ $item->id }})'
                                            class="btn btn-dark mtmobile" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                       

                                        <button type="button" class="btn btn-dark mtmobile" wire:click='Ver({{ $item->id }})' title="Ver">
                                            <i class="fas fa-regular fa-eye"></i>
                                        </button>


                                        <button type="button" wire:click='exportarWord({{ $item->id }})'
                                            class="btn btn-dark mtmobile" title="Exportar">
                                            <i class="fas fa-file-word-o"></i>
                                        </button>
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
