@extends('layouts.theme.app')
    <!-- [ Main Content ] start -->
    {{-- <div class="pc-container"> --}}
        @section('content')
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block card mb-0">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 ms-1">
                                        <h4 class="mb-0">Titulo de contenido | Listado</h4>
                                    </div>
                                    <span>
                                        <a href="#" class="rounded btn btn-button bg-info text-white">Creacion</a>
                                    </span>
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
        </div>
        @endsection
    {{-- </div> --}}
    <!-- [ Main Content ] end -->
