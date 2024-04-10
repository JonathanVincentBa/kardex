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
                                    <select wire:model='clienteId' class="form-control">
                                        <option value="">SELECCIONAR UNO</option>
                                        <option value="0">TODOS</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->remitente }}">{{ $cliente->remitente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model='dateFrom' class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model='dateTo' class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                {{-- <button wire:click='$refresh' class="btn btn-dark btn-block">Consultar</button> --}}
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }}"
                                    href="{{ url('report/pdf' . '/' . $clienteId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                    target="_blank">Generar PDF</a>
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }}"
                                    href="{{ url('report/excel' . '/' . $clienteId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
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
                                        <th width="13%" class="table-th text-wite text-center">FECHA</th>
                                        <th width="10%" class="table-th text-wite text-center">REMITENTE</th>
                                        <th width="10%" class="table-th text-wite text-center">DESTINATARIO</th>
                                        <th class="table-th text-wite text-center">ASUNTO</th>
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
                                            <td width="13%">{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                            <td width="10%">{{ $item->remitente }}</td>
                                            <td width="10%">{{ $item->destinatario }}</td>
                                            <td>{{ $item->detalle }}</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },
                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },
            }
        })

        //eventos

        
    });
</script>

