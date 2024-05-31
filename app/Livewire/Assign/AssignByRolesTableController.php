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

class AssignByRolesTableController extends DataTableComponent
{
    protected $model = Permissions::class;

    public $dateMin, $dateMax, $permisosSelected=[], $oldPermisos=[];
    public $roles, $id_role;

    public function mount()
    {
        $this->dateMin  = '2024-01-01 00:00:01';
        $this->dateMax  = Carbon::parse(Carbon::now())->format('Y-m-d');

        $this->roles    =  Role::orderBy('id', 'asc')->get();
        $this->id_role  = "ELEGIR";
        // $this->id_role  = 21;
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
            'after-toolbar' => ['livewire.assign.areas-roles',[
                'roles' => $this->roles,
            ]],
        ]);
    }
    public function builder(): Builder
    {
        error_log('builder');
        $query = Permissions::query()
            ->select('id','name', DB::raw("0 as checked"));
        return $query;
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable()
                // ->excludeFromColumnSelect()
            ->html(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable()
            ->html(),
            Column::make("Description", "description")
                ->sortable()
                ->deselected()
            ->html(),
            Column::make('Acción')
                ->label((
                    fn($item) => view('livewire.assign.acciones',['item' => $item,'role' => $this->id_role])
                ))
                ->excludeFromColumnSelect()
            ->html(),
            Column::make('Roles con el permiso')
                ->label((
                    fn($item) => view('livewire.assign.count',['item' => $item,'role' => $this->id_role])
                ))
                ->excludeFromColumnSelect()
            ->html(),
        ];
    }
    #[On('EventRemoveAll')]
    public function removeAll()
    {
        error_log('removeAll');
        if ($this->id_role == 'ELEGIR') {
            $this->dispatch('sync-error','Selecciona un rol valido');
            return;
        }

        $role = Role::find($this->id_role);
        $role->syncPermissions([0]);
        $this->dispatch('remove-all',"Se revocaron todos lo permisos al role $role->name");
    }
    #[On('EventSyncAll')]
    public function syncAll()
    {
        error_log('syncAll');
        if ($this->id_role == 'ELEGIR') {
            $this->dispatch('sync-error','Selecciona un rol valido');
            return;
        }
        $role = Role::find($this->id_role);
        $permisos = Permissions::where('name','<>','Permissions_Index')->pluck('id')->toArray();
        $role->syncPermissions($permisos);
        $this->dispatch('sync-all',"Se sincronizaron todos lo permisos al role $role->name");
    }
    public function syncPermiso($state, $permisoName)
    {
        error_log('syncPermiso');
        if ($this->id_role != 'ELEGIR') {
            $roleName = Role::find($this->id_role);
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
