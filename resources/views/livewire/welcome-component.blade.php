<!-- [ Pc Content ] start -->
<div class="pc-content">
  <!-- [ breadcrumb ] start -->
  <div class="page-header">
    <div class="page-block card mb-0">
      <div class="card-body">
        <div class="col-md-12">
          <div class="page-header-title">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1 ms-1">
                <h4 class="mb-0 py-3">{{ $componentName }} | {{ $pageTitle }}</h4>
              </div>
              <span hidden>
                <a href="#" class="rounded btn btn-button bg-info text-white">Creacion</a>
              </span>
              <span hidden>
                <a href="#" class="rounded btn btn-button bg-info text-white"
                    data-bs-toggle="modal" data-bs-target="#theModal">Modal</a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ breadcrumb ] end -->
  <div>
      livewire('users.dynamic-select-controller',['selectedOption' => 5,'options' => $positions])
  </div>
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
              <h5>Seccion del Contenido</h5>
          </div>
          <div class="card-body">
            <hr class="p-0 m-0">
            @auth
            <pre class="text-start" style="font-size: 1rem;">
                data: {{ print_r($data) }}
                </pre>
            @endauth
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

  <!-- Modal id="#theModal" -->
  include('livewire.users.form')
</div>
<!-- [ Pc Content ] end -->

@script
  <script>
    Livewire.on('newPositionId', function (value) {
      console.log('Valor seleccionado id puesto:', value);
    });
    Livewire.on('item-modal-edit', (msg) => {
      console.log("item-modal-edit " + JSON.stringify(msg));
      $('#theModal').modal('show');
    });
    Livewire.on('item-modal-updated', (msg) => {
      $('#theModal').modal('hide');
      alert(msg)
      location.reload();
      // noty(msg)
    });

    /* Item error */
    //   Livewire.on('item-error', (msg) => {
        // console.log('item-error msg:', msg)
        // alert(msg)
        // noty(msg)
    //   });
      /* Modal hide */
    Livewire.on('item-modal-close', (msg) => {
      console.log('item-modal-close msg:', msg)
      $('#theModal').modal('hide');
      dataTable.update();
    });
  </script>
@endscript

