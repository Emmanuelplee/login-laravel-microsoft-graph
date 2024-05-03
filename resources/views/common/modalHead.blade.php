<div wire:ignore.self
    class="modal fade modal-animate"
    id="theModal"
    tabindex="-1"
    role="dialog">
  <div class="modal-dialog modal-xl" role="document">
  {{-- <div class="modal-dialog modal-lg" role="document"> --}}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-6">
          <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
        </h5>
        {{-- <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE...</h6> --}}
        <h6 class="text-end text-warning col-5 m-0" wire:loading>PROCESANDO ESPERE...</h6>
        <button type="button" class="btn-close col-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <p>Modal body Start.</p> -->