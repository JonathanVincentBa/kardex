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
                                <h6>Elige el Cliente</h6>
                                <div class="form-group">
                                    <select wire:model='clienteId' id="cliente" class="js-states form-control">
                                        <option></option>
                                        <option value="0">TODOS LOS CLIENTES</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Estado de carpeta</h6>
                                <div class="form-group selectpicker">
                                    <select wire:model='reportType' id="reportType" class="form-control">
                                        <option value="0">Carpetas Activos y Pasivos</option>
                                        <option value="1">Carpetas Activos</option>
                                        <option value="2">Carpetas Pasivos</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige el Tipo de Carpeta</h6>
                                <div class="form-group">
                                    <select wire:model='carpetaId' id="carpeta" class="form-control">
                                        <option value="0">Todas</option>
                                        @foreach ($carpetas as $item)
                                            <option value="{{ $item->id }}">{{ $item->codigo }} -
                                                {{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                {{-- <button wire:click='$refresh' class="btn btn-dark btn-block">Consultar</button> --}}
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('control-report/pdf' . '/' . $clienteId . '/' . $reportType . '/' . $carpetaId) }}"
                                    target="_blank">Generar PDF</a>
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('control-report/excel' . '/' . $clienteId . '/' . $reportType . '/' . $carpetaId) }}"
                                    target="_blank">Exportar a Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 table-responsive tblscroll"
                        style="max-height: 499px; overflow-y: scroll; overflow-y: auto;">
                        <!--TABLA-->
                        <div class="table-resposive">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c">
                                    <tr>
                                        <th class="table-th text-center text-white">CLIENTE</th>
                                        <th class="table-th text-center text-white">CARPETA</th>
                                        <th class="table-th text-center text-white">ASUNTO</th>
                                        <th class="table-th text-center text-white">CAJA</th>
                                        <th class="table-th text-center text-white">ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) < 1)
                                        <tr>
                                            <td class="table-th text-center" colspan="6">
                                                <h5>Sin Resultados</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->cliente }}</td>
                                                <td>{{ $item->tipo }}-{{ $item->carpeta }}</td>
                                                <td>{{ $item->asunto }}</td>
                                                <td>{{ $item->caja_deleted }}</td>
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
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clienteSelect2 = $('#cliente')
            /* const reporteSelect2 = $('#reportType')
            const carpetaSelect2 = $('#carpeta') */
            clienteSelect2.select2({
                placeholder: 'SELECCIONAR UN CLIENTE',
                allowClear: true
            });

            /* reporteSelect2.select2({
                placeholder: '{{ __('ESTADO DE LA CARPETA') }}',
                allowClear: true
            });
            carpetaSelect2.select2({
                placeholder: '{{ __('SELECCIONE UN SERVICIO') }}',
                allowClear: true
            }); */
        });
    </script>
@endsection --}}
