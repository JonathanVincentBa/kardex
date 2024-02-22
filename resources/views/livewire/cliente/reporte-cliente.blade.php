<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">

                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }} </b>
                </h4>
                <button wire:click="exportExcel">Exportar a Excel</button>
                <button wire:click="exportPDF">Exportar a PDF</button>
            </div>
            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">Codigo</th>
                                <th class="table-th text-wite">Nombre</th>
                                <th class="table-th text-wite">D.N.I.</th>
                                <th class="table-th text-wite">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->codigo }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->dni }}</td>
                                    <td class="text-center">
                                        @if ($cliente->deleted_at != null)
                                        <span
                                        class="badge badge-danger text-uppercase">
                                         PASIVO
                                    </span>
                                        @else
                                        <span
                                        class="badge badge-success text-uppercase">
                                         ACTIVO 
                                    </span>
                                        @endif
                                        
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
</div>
