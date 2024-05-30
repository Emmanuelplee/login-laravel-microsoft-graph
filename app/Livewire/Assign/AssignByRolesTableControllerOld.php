<?php

namespace App\Livewire\Assign;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Permissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AssignByRolesTableControllerOld extends DataTableComponent
{
    protected $model = Permissions::class;

    public $dateMin, $dateMax, $permisosSelected=[], $oldPermisos=[];
    public $roles, $role;
    public function mount()
    {
        $this->dateMin  = '2024-01-01 00:00:01';
        $this->dateMax  = Carbon::parse(Carbon::now())->format('Y-m-d');

        // $this->roles    =  Role::orderBy('name', 'asc')->get();
        // $this->role     = 1;
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setLoadingPlaceholderStatus(true);
        $this->setLoadingPlaceholderBlade('livewire.common.dataTable.loading');
        // * ======= Búsqueda global =========================================
        $this->setSearchEnabled();
        $this->setEmptyMessage('No se encontraron registros');
        $this->setSearchPlaceholder('Buscar en la tabla ...');
        $this->setSearchDebounce(1000); // esperará 1 segundo antes de enviar la solicitud.
        // * ========= Paginación ===========================================
        $this->setPageName('permisosPage');
        $this->setPerPageVisibilityStatus(true);// variable de pagina en la url
        $this->setPerPageAccepted([25, 50, 100]);// array de registros a visualizar
        $this->setPerPageFieldAttributes([
            'class' => 'bg-info bg-opacity-10 border border-info', // Add these classes to the dropdown
            'default-colors' => false, // Do not output the default colors
            'default-styles' => true, // Output the default styling
        ]);
        // * ======= Ordenamiento o clasificación ============================
        $this->setSortingStatus(true);
        // * ======= Tabla ===================================================
        $this->setTheadAttributes([
            'default' => true,
            'class' => 'bg-info bg-opacity-25 border border-info',
        ]);
        $this->setOfflineIndicatorEnabled();
        // * ===== Filtros ====================================================
        $this->setFiltersVisibilityEnabled();
        $this->setFilterLayoutSlideDown();
        // * ===== Areas ====================================================
        $this->setConfigurableAreas([
            // 'toolbar-left-end' => ['livewire.assign.areas-select-roles',[
            //     'roles' => $this->roles,
            //     ]],
            'after-toolbar' => ['livewire.assign.areas-roles',[
                'roles' => $this->roles,
            ]],
        ]);
    }
    public function builder(): Builder
    {
        error_log('builder');
        $query = Permissions::query()
            ->select('id','name',DB::raw("0 as checked"));
            // DB::raw("CASE WHEN rp.permission_id IS NOT NULL THEN 1 ELSE 0 END as checked"))
            // ->leftJoin('role_has_permissions as rp', 'permissions.id', '=', 'rp.permission_id')
            // ->leftJoin('roles as r', function($join) {
            //     $join->on('roles.id', '=', 'rp.role_id')
            //     ->where('roles.id', '=', $this->role);
        // });
        return $query;
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable() // Search general
                ->sortable()
                // ->excludeFromColumnSelect()
            ->html(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable()
                // ->excludeFromColumnSelect()
            ->html(),
            // Column::make('Acción')
            //     ->label((
            //         fn($item) => view('livewire.assign.acciones', compact('item'))
            //     ))
            //     ->excludeFromColumnSelect()
            // ->html(),
            // Column::make('Roles con el permiso')
            //     ->label((
            //         fn($item) => view('livewire.assign.count', compact('item'))
            //     ))
            // ->html(),
        ];
    }
    // public function updateList()
    // {
    //     $query = Permissions::query()
    //     ->select('id','name','description',DB::raw("0 as checked"));
    //     if ($this->role != 'ELEGIR') {
    //         foreach ($query as $item) {
    //             $role = Role::find($this->role);
    //             $tienePermiso = $role->hasPermissionTo($item->name);
    //             if ($tienePermiso) {
    //                 $item->checked = 1;
    //             }
    //         }
    //     }
    // }
    // #[On('AsignarPermiso')]
    public function syncPermiso($state, $permisoName)
    {
        error_log('syncPermiso');
        if ($this->role != 'ELEGIR') {
            $roleName = Role::find($this->role);
            if ($state) {
                $roleName->givePermissionTo($permisoName);
                $this->dispatch('sync-permiso', "Permiso asignado al rol: $roleName->name");
            }else {
                $roleName->revokePermissionTo($permisoName);
                $this->dispatch('sync-permiso', "Permiso revocado al rol: $roleName->name");
            }
        }else {
            $this->dispatch('sync-error','Selecciona un rol valido');
        }
    }
}
