<div class="row justify-content-between">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="search-input-group-style input-group mb-2">
            <span class="input-group-prepend ">
                <span class="input-group-text __border" id="basic-addon1">
                    <i class="fas fa-search"></i>
                </span>
            </span>
            <!-- Variable de serch  wire:model.lazy menos peticiones-->
            <input type="text" wire:model = "search" class="form-control __border" placeholder="Buscar">
        </div>
    </div>
</div>

{{-- <style>
    .__border {
        border: 2px solid #0A65FF !important;
    }
    #basic-addon1 {
        background-color: #0A65FF !important;
        height: 35px;
    }
    #basic-addon1 i {
        color: #ffffff !important;
        font-size: 1.5rem;
    }
    .search-input-group-style input {
        border-radius: 10px;
        padding: 6px 16px;
        height: 35px;
        }
</style> --}}
