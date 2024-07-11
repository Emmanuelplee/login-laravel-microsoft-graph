<!-- [ Pc Content ] start -->
<div class="pc-content pt-4">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block card mb-0">
        <div class="card-body py-0">
          <div class="col-md-12">
            <div class="page-header-title">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 ms-1">
                  <h4 class="mb-0 py-3">{{ $componentName }} | {{ $pageTitle }}</h4>
                </div>
                {{-- <span>
                  <a href="#" class="rounded btn btn-button bg-info text-white"
                      data-bs-toggle="modal" data-bs-target="#theModal">Crear</a>
                </span> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->

      <div class="col-sm-12">
        <div class="card">

            <div class="card card-header py-0 mb-0">

                  <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 1 ? 'active' : ''}}"
                        id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false">
                        <i class="ph ph-user-circle-plus me-2"></i> {{ $componentName }}
                      </a>
                    </li>

                    {{-- <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 2 ? 'active' : ''}}"
                        id="followers-tab" data-bs-toggle="tab" href="#followers" role="tab" aria-selected="false">
                        <i class="ph ph-file-lock me-2"></i>  Permisos por rol
                      </a>
                    </li> --}}

                  </ul>

            </div>

            <div class="card-body pt-0 pb-1">
                {{-- <div class="col-lg-8 col-xxl-9"></div> --}}
              <div class="col-lg-12 col-xxl-12">
                <div wire:ignore.self class="tab-content">
                    <div class="tab-pane show active" id="profile" role="tabpanel">

                        <div class="h4 py-2">{{ $componentName }}</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                             {{-- <span class="fs-6 fst-itali">{{ print_r(json_encode($data)) }}</span> --}}
                            <livewire:SolicitudPago.SolicitudPagoSdpTableController :key="$tableControllerKey"/>

                          </div>
                        </div>

                    </div>
                    {{-- <div class="tab-pane" id="followers" role="tabpanel" aria-labelledby="followers-tab">

                        <div class="h4 py-2">Permisos por rol</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                            <livewire:ReportPermissions.TableTwoPermissionsByRoles />

                          </div>
                        </div>

                    </div> --}}
                </div>
              </div>
            </div>

        </div>
      </div>

      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    @include('livewire.solicitud-pago.form')

  </div>
  <!-- [ Pc Content ] end -->
@script
  <script>
    // {{-- *========================================================= --}}
    //              EVENTOS DEL CONTROLLER
    Livewire.on('actualizar-todas-sdps', (msg) => {
        console.log('actualizar-todas-sdps msg:', msg);
        noty(msg[0],1);//Exito
    });
    Livewire.on('item-modal-edit', (msg) => {
        console.log("item-modal-edit " + JSON.stringify(msg));
        $('#theModal').modal('show');
    });
    Livewire.on('item-info-file', (msg) => {
        console.log('item-info-file msg:', msg);
        noty(msg[0],1);//Exito
    });
    Livewire.on('item-modal-updated', (msg) => {
        $('#theModal').modal('hide');
        noty(msg[0],1);//Exito
        Livewire.dispatch('refreshChildTable');
    });
        // {{-- *======================================================== --}}
    //            EVENTO DE ELIMINACION
    Livewire.on('Confirm', (value) => {
        console.log('id,eventName,text', value.id, value.eventName, value.text);
        swal({
            title: 'Atención',
            text: value.text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#dc3545',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Eliminar',
            reverseButtons: true,
        }).then(function(result) {
            if (result.value) {
            Livewire.dispatch(value.eventName,[value.id]);
            swal.close()
            }else if(result.dismiss === Swal.DismissReason.cancel) {
                swal({
                    title: 'Cancelado',
                    text: 'No se realizó modificación',
                    type: 'error',
                    timer: 5000
                })
            }
        })
    })
    Livewire.on('item-deleted', (msg) => {
        console.log('item-deleted msg:', msg)
        noty(msg[0],1)//Exito
        // setTimeout(() => Livewire.dispatch('refreshChildTable'), 5000);
        Livewire.dispatch('refreshChildTable')
    });
    // {{-- *======================================================== --}}
    //            EVENTO DE ERROR DEL CONTROLLER
    Livewire.on('item-error', (msg) => {
        console.log('item-error msg:', msg);
        noty(msg[0],0);//Error
    });
    // {{-- *=========================================================== --}}
    //            CERRAR MODAL
    $('#theModal').on('hidden.bs.modal', function(e) {
        console.log('borrar Errors clase(er) ejecutar resetUI');
        $('.er').css('display','none');
        Livewire.dispatch('resetUI');
    });
    // Foco primer input del Modal clase __focus_active
    $('#theModal').on('shown.bs.modal', msg => {
        $('.__focus_active').focus();
    });
  </script>
@endscript
