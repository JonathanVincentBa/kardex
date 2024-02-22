<div>
    <button wire:click="exportExcel">Exportar a Excel</button>
    <button wire:click="exportPDF">Exportar a PDF</button>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientes as $invoice)
            <tr>
                <td>{{ $invoice->nombre }}</td>
                <td>{{ $invoice->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
