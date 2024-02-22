<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{ $componentName }}</b></h4>
            </div>
            <dig class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>ELIGE EL TIPO DE REPORTE</h6>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="0">CLIENTE Y FECHAS</option>
                                        <option value="1">CLIENTE</option>
                                        <option value="2">POR FECHAS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <h6>ELIGE UN CLIENTE</h6>
                                <div class="form-group">
                                    <select id="clienteControl" class="form-control">
                                        <option></option>
                                        @foreach ($controlArchivos as $item)
                                            <option value="{{ $item->id }}">{{ $item->cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-sm-12 mt-2">
                                <h6>FECHA DESDE</h6>
                                <div class="form-group">
                                    <input type="text" wire:model='dateFrom' class="form-control fllatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>FECHA HASTA</h6>
                                <div class="form-group">
                                    <input type="text" wire:model='dateTo' class="form-control fllatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire::click="$refresh" class="btn btn-darl btn-block">
                                    Consultar
                                </button>

                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }}"
                                    href="{{ url('report/pdf' . '/' . $reporte . '/' . $reportType . '/' . $dataForm . '/' . $dataTo) }}">Generar
                                    PDF
                                </a>

                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }}"
                                    href="{{ url('report/excel' . '/' . $reporte . '/' . $reportType . '/' . $dataForm . '/' . $dataTo) }}">Exportar
                                    a Excel
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-9">
                        <!-- TABLA -->
                        <div class="table-resposive">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c;">
                                    <tr>
                                        <th class="table-th text" class="table-th text-wite">CLIENTE</th>
                                        <th class="table-th text" class="table-th text-wite">CARPETA</th>
                                        <th class="table-th text" class="table-th text-wite">ASUNTO</th>
                                        <th class="table-th text" class="table-th text-wite">CREADO POR</th>
                                        <th class="table-th text" class="table-th text-wite">FECHA</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($controlArchivos as $item)
                                        <tr>
                                            <td><h6>{{ $item->cliente }}</h6></td>
                                            <td><h6>{{ $item->carpeta }}</h6></td>
                                            <td><h6>{{ $item->asunto }}</h6></td>
                                            {{-- <td><h6>{{ $item->creadoX }}</h6></td> --}}
                                            <td><h6>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-y') }}</h6></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </dig>
        </div>
    </div>
    <script>
        const clienteControlSelect2 = $('#clienteControl');

        clienteControlSelect2.select2({
            placeholder: '{{  __('SELECCIONE UN CLIENTE')}}',
            allowClear: true
        })
    </script>
</div>
