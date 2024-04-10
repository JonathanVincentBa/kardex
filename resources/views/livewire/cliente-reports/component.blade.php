<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{ $componentName }}</b></h4>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el Tipo de reporte</h6>
                                <div class="form-group">
                                    <select wire:model='reportType' class="form-control">
                                        <option value="">SELECCIONAR UNO</option>
                                        <option value="0">Clientes Activos y Pasivos</option>
                                        <option value="1">Clientes Activos</option>
                                        <option value="2">Clientes Pasivos</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                {{-- <button wire:click='$refresh' class="btn btn-dark btn-block">Consultar</button> --}}
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('cliente-report/pdf' . '/' . $reportType) }}"
                                    target="_blank">Generar PDF</a>
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('cliente-report/excel' . '/' . $reportType) }}"
                                    target="_blank">Exportar a Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <!--TABLA-->
                        <div class="table-resposive">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c;">
                                    <tr>
                                        <th class="table-th text-wite text-center">Nombre</th>
                                        <th class="table-th text-wite text-center">D.N.I.</th>
                                        <th class="table-th text-wite text-center">Email</th>
                                        <th class="table-th text-wite text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) < 1)
                                        <tr>
                                            <td colspan="7">
                                                <h5>Sin Resultados</h5>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->dni }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">
                                                @if ($item->deleted_at == '')
                                                    <span class="badge badge-success }} text-uppercase">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger }} text-uppercase">
                                                        Pasivo
                                                    </span>
                                                @endif
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
    </div>
</div>
