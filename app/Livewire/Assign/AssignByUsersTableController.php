<?php

namespace App\Livewire\Assign;


use App\Models\Role;
use App\Models\Permissions;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AssignByUsersTableController extends DataTableComponent
{
    protected $model = Permissions::class;

    public $users, $id_user, $selected_id;

    public function mount()
    {
        $this->users        =  User::orderBy('id', 'asc')->get();
        $this->id_user      = "ELEGIR";
        $this->selected_id  = 0;
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
            'class' => 'bg-info bg-opacity-10 border border-info', // Add classes to dropdown
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
            'after-toolbar' => ['livewire.assign.users.areas',[
                'users' => $this->users,
            ]],
        ]);
    }
    public function builder(): Builder
    {
        error_log('builder');
        error_log($this->id_user);
        // Mandar valores a vista padres
        if ($this->id_user != 'ELEGIR') {
            $this->dispatch('update-user',$this->id_user);
        }
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
                    fn($item) => view('livewire.assign.users.acciones',['item' => $item,'user_id' => $this->id_user])
                ))
                ->excludeFromColumnSelect()
            ->html(),
            Column::make('Permisos heredados')
                ->label((
                    fn($item) => view('livewire.assign.users.inherited-permissions',['item' => $item,'user_id' => $this->id_user])
                ))
                ->excludeFromColumnSelect()
            ->html(),
        ];
    }
    public function syncPermiso($state, $permisoName)
    {
        error_log('syncPermiso');
        error_log('state '.$state);
        error_log('permisoName '.$permisoName);
        if ($this->id_user != 'ELEGIR') {
            $userFind = User::find($this->id_user);
            if ($state) {
                $userFind->givePermissionTo($permisoName);
                $this->dispatch('sync-permiso', "Permiso asignado al usuario: $userFind->name");
            }else {
                $userFind->revokePermissionTo($permisoName);
                $this->dispatch('sync-permiso', "Permiso revocado al usuario: $userFind->name");
            }
        }else {
            $this->dispatch('sync-error','Selecciona un usuario valido');
        }
    }
}
