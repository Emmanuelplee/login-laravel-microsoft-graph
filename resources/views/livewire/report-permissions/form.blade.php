@include('common.modalHead')
<div>
    <form wire.ignore.self>
        <div class="row">
          {{-- <b><p>Usuario: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b> --}}

          {{-- * MOSTRAR INFO --}}
          @if ($showModal)

            @if ($stepTable == 1)
                <div class="modal-content-sticky">
                    <div>
                        <p class="ps-2 py-1">
                            <b>Id:</b> {{ $selected_id == 0 ? '' : $selected_id }}
                            <b>Nombre:</b> {{ $userFind ? $userFind->alias :'' }}
                        </p>
                        @include('livewire.report-permissions.table-one.show')
                    </div>
                </div>
            @endif

            @if ($stepTable == 2)
                <b><p>Rol: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b>
                @include('livewire.report-permissions.table-two.show')
            @endif

            @if ($stepTable == 3)
                <b><p>Rol: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b>
                @include('livewire.report-permissions.table-three.show')
            @endif

            {{-- @if ($stepTable == 4)
                <b><p>Rol: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b>
                @include('livewire.report-permissions.table-two.show')
            @endif --}}

          @endif

          {{-- * FORMULARIO --}}
          @if (!$showModal)
            {{-- * Nombre rol --}}
            {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text"
                    id="name"
                    wire:model="name"
                    class="form-control __focus_active
                        @error('name') border border-danger border-1 @enderror"
                    placeholder="Nombre"
                    required>
                    @error('name')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                </div>
            </div> --}}
          @endif

        </div>
    </form>
</div>
@include('common.modalFooter')
