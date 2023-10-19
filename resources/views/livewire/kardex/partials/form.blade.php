<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>{{ $componetName }}</b> | Ver
                </h5>
                <h6 class="text-center text-warnig" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

               {{--  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CLIENTE</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="text" wire:model.lazy='' class="form-control"
                                    style="text-transform:uppercase;" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SERVICIO</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="text" wire:model.lazy='' class="form-control"
                                    style="text-transform:uppercase;" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>FECHA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="number" wire:model.lazy='' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>REALIZADO POR</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="text" wire:model.lazy='' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>DESTINATARIO</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="email" wire:model.lazy='' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>DESCRIPCIÓN</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </div>
                                <input type="number" wire:model.lazy='' class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
