<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
            <a href="javascript:void(0)" class="btn btn-dark float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
                <h4 class="card-title">
                    <b> {{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
            </div>
            Search

            <div class="widget-content">
                <div class="table-resposive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-wite">CODIGO</th>
                                <th class="table-th text-wite">NOMBRE</th>
                                <th class="table-th text-wite">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h6>Nombre de categoria</h6></td>
                                <td>
                                    <img src="" alt="Imagen de ejemplo">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    Pagination
                </div>
            </div>
        </div>
    </div>
    include form
</div>


<script>
    document.addEventListener('livewire:load', function() {

    });
</script>
