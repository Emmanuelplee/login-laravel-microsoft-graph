        <!-- <p>Modal body End.</p> -->
    </div>
      <div class="modal-footer">
      {{-- <button type="button" wire:click.prevent="resetUI()" class="btn btn-danger close-btn" data-bs-dismiss="modal">CERRAR</button> --}}
      <button type="button"
        {{-- wire:click="resetUI()" --}}
        class="btn btn-danger rounded"
        data-bs-dismiss="modal">CERRAR</button>
      @if ($selected_id === 0)
        <button type="button"
          wire:click="store()"
          wire:loading.attr="disabled"
          class="btn btn-info rounded">GUARDAR</button>
      @endif
      @if ($selected_id >= 1 && !$showModal)
        <button type="button"
          wire:click="update()"
          wire:loading.attr="disabled"
          class="btn btn-info rounded">ACTUALIZAR</button>
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
