        <!-- <p>Modal body End.</p> -->
    </div>
      <div class="modal-footer">
      <button type="button" wire:click.prevent="resetUI()" class="btn btn-danger close-btn" data-dismiss="modal">CERRAR</button>
      @if ($selected_id < 1)
        <button type="button" wire:click.prevent="store()" class="btn btn-info close-modal">GUARDAR</button>
      @else
        <button type="button" wire:click.prevent="update()" class="btn btn-info close-modal">ACTUALIZAR</button>
      @endif
      </div>
    </div>
  </div>
</div>

{{-- <style>
    .modal-footer .btn[data-dismiss="modal"] {
    background-color: #e7515a;
    color: #1b55e2;
    font-weight: 700;
    border: 1px solid #e0e6ed;
    padding: 8px 25px;
    }
</style> --}}
