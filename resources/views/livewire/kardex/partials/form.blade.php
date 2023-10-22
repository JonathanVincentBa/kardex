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
      </div>
      <div class="modal-footer">
          <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">Cerrar</button>
          
      </div>
  </div>
</div>
</div>
