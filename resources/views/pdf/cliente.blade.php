<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Control de archivo</title>
    <link rel="stylesheet" href="{{ asset('custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-pagination.css') }}">
</head>

<body>
    <section class="header" style="top: -287px;">
        <table width="100%">
            <tr>
                <td align=" center" colspan="2">
                    <span style="font-size: 35px; font-weight: bold">SISTEMA KARDEX</span>
                </td>
            </tr>
            <tr>
                <td align=" center" width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ asset('images/LOGO-NPT.png') }}" alt="" class="invoice-logo" width="100"
                        height="50">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">

                    @if ($reportType == 0)
                        <span style="font-size: 20px"><strong>Reporte de Activos y Pasivos</strong></span>
                    @endif
                    @if ($reportType == 1)
                        <span style="font-size: 20px"><strong>Reporte de Activos</strong></span>
                    @endif
                    @if ($reportType == 2)
                        <span style="font-size: 20px"><strong>Reporte de Pasivos</strong></span>
                    @endif
                </td>
            </tr>
        </table>
    </section>
    <section>
        <table border="1" cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="10%">CODIGO</th>
                    <th width="12%">NOMBRE</th>
                    <th>DIRECION</th>
                    <th width="10%">DNI</th>
                    <th width="10%">TELEFONOS</th>
                    <th width="10%">EMAIL</th>
                    <th width="10%">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td align=" center">{{ $item->codigo }}</td>
                        <td align=" center">{{ $item->nombre }}</td>
                        <td align=" center">{{ $item->direccion }}</td>
                        <td align=" center">{{ $item->dni }}</td>
                        <td align=" center">{{ $item->fono1 }} - {{ $item->fono2 }}</td>
                        <td align=" center">{{ $item->email }}</td>
                        <td align=" center">
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
    </section>
</body>
</html>
