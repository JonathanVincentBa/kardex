<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- BUSCADOR -->
            @include('livewire.kardex.partials.buscador')
            <!-- DETALLES -->
            @include('livewire.kardex.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">

            <!-- ASUNTO -->
            @include('livewire.kardex.partials.asunto')
        </div>
    </div>
</div>

@section('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            const clienteSelect2 = $('#cliente');  
            const servicioSelect2 = $('#tipo');  
            clienteSelect2.select2();
            servicioSelect2.select2();

            clienteSelect2.on('change', function(){
                /*alert(this.value)*/
                @this.set('cliente', this.value);
            })
        });
        function noty(msg) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 1500
        })
    }
    </script>
    @stack('scripts')
@endsection
