    <!-- <p>Modal body End.</p> -->
</div>
    <div class="modal-footer">
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
        @if ($selected_id >= 1 && !$showModal && !$existe_uuid && $uuid != '')
            @if ($files && $files->getClientOriginalExtension() === 'xml')
                @if ($files !== '' && $monto_capturado > 0)
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='update'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @endif
            @endif
        @endif
        @if ($selected_id >= 1 && !$showModal && !$existe_uuid)
            @if ($files && ($files->getClientOriginalExtension() === 'pdf' || $files->getClientOriginalExtension() === 'jpg'))
                @if ($files !== '' && $monto_capturado > 0)
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='update'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @endif
            @endif
        @endif
    </div>
</div>
</div>
</div>
