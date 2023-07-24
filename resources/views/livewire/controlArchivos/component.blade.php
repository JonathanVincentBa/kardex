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
                                <th class="table-th text-wite">Cliente</th>
                                <th class="table-th text-wite">Carpeta</th>
                                <th class="table-th text-wite">Asunto</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($controlArchivos as $controlArchivo)
                                <tr>
                                    <td>{{ $controlArchivo->cliente }}</td>
                                    <td>{{ $controlArchivo->tipo }}{{ $controlArchivo->carpeta }}</td>
                                    <td>{{ $controlArchivo->asunto }}</td>
                                    <td>
                                        <a href="javascript:void(0)" wire:click='Edit({{ $controlArchivo->id }})'
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)" onClick="Confirm('{{ $controlArchivo->id }}')"
                                            class="btn btn-dark">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $clientes->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    {{-- @include('livewire.cliente.form') --}}
</div>
