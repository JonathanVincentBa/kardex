<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>{{ $componetName }}</b> | Ver
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CLIENTE</label>
                            <div class="input-group">
                                <input type="text" value='{{$clienteNombre}}' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SERVICIO</label>
                            <div class="input-group">
                                <input type="text" value="{{$tipoCodigo}}-{{$carpeta}}/{{$tipoNombre}}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>FECHA DE CREACIÓN</label>
                            <div class="input-group">
                                <input type="text" value='{{$date}}' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>REALIZADO POR</label>
                            <div class="input-group">
                                <input type="text" value="{{$enviadoX}}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>DESTINATARIO</label>
                            <div class="input-group">
                                <input type="text" value="{{$destinatario}}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>DESCRIPCIÓN</label>
                            <div class="input-group">
                                <textarea class="form-control" disabled>{{$descripcion}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info"
                    data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
