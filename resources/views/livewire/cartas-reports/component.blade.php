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
                                    <select wire:model='clienteId' id="cliente" class="form-control">
                                        <option selected>SELECCIONA UNO</option>
                                        <option value="0">Todos</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige el Tipo de Servicio</h6>
                                <div class="form-group">
                                    <select wire:model='tipoId' id="tipo" class="form-control">
                                        <option value="0">Todos los servicios</option>
                                        @foreach ($tipos as $item)
                                            <option value="{{ $item->id}}">{{ $item->codigo }} - {{ $item->nombre }}</option>
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
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('report/pdf' . '/' . $clienteId . '/' . $tipoId . '/' . $dateFrom . '/' . $dateTo) }}"
                                    target="_blank">Generar PDF</a>
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('report/excel' . '/' . $clienteId . '/' . $tipoId . '/' . $dateFrom . '/' . $dateTo) }}"
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
                                        <th class="table-th text-wite text-center">Cliente</th>
                                        <th class="table-th text-wite text-center"># Tramite</th>
                                        <th class="table-th text-wite text-center">Destinatario</th>
                                        <th class="table-th text-wite text-center">Fecha</th>
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
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->cliente }}</td>
                                            <td>{{ $d->tipo }}-{{ $d->carpeta }}</td>
                                            <td>{{ $d->destinatario }}</td>
                                            <td>
                                                <h6>{{ \Carbon\Carbon::parse($d->updated_at)->format('d-M-Y') }}</h6>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        /*const clienteSelect2 = $('#cliente')
        const reporteSelect2 = $('#reportType')
        clienteSelect2.select2();
        reporteSelect2.select2();*/

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
