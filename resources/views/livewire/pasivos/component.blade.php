<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
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
                                <th class="table-th text-center text-white">ID</th>
                                <th class="table-th text-center text-white">CODIGO DEL CLIENTE</th>
                                <th class="table-th text-center text-white">NOMBRE DEL CLIENTE</th>
                                <th class="table-th text-center text-white">CARPETA</th>
                                <th class="table-th text-center text-white">CAJA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($controlArchivos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->cod_cliente }}</td>
                                    <td>{{ $item->cliente }}</td>
                                    <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                    <td>{{ $item->caja_deleted }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $controlArchivos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
