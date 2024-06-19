<?php

namespace App\Livewire\ReportPermissions;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Exports\ReportPermissions\ExcelTableOneExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TableOnePermissionsByUsers extends DataTableComponent
{
    protected $model = User::class;

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
        $this->setPageName('tablaUnoPage');
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

        // * ===== Multiples tablas misma vista ===============================
        $this->setQueryStringDisabled();
        // $this->setColumnSelectStatus(false);
    }

    public function builder(): Builder
    {
        error_log('builderTableOne');
        $query = User::query()
            ->with('my_role_is:id,name');
        return $query;
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable()
                ->excludeFromColumnSelect()
            ->html(),
            Column::make("Nombre", "alias")
                ->searchable()
                ->sortable()
            ->html(),
            // Column::make("Name", "name")
            //     ->sortable(),
            // Column::make("Surname", "surname")
            //     ->sortable(),
            Column::make("Email", "email")
                ->sortable()
                ->deselected()
            ->html(),
            Column::make('Rol', 'my_role_is.name')
                ->sortable()
                ->searchable()
            ->html(),
            Column::make('permisos')
                ->label((
                    fn($item) => view('livewire.report-permissions.table-one.list-permissions',['item' => $item,])
                ))
                ->excludeFromColumnSelect()
            ->html(),
        ];
    }
    public function bulkActions(): array
    {
        return [
            'exportExcel' => 'EXCEL',
        ];
    }

    public function exportExcel()
    {
        // User::whereIn('id', $this->getSelected())->update(['active' => true]);
        error_log('exportExcel');
        $excelName = 'reporte-permisos-tabla-uno_'.now()->format('Y_m_d_H_i').'.xlsx';
        $items = $this->getSelected();
        $data = $this->dataExcel($items);

        $this->clearSelected();

        return Excel::download(new ExcelTableOneExport($data), $excelName);
    }

    public function dataExcel($items){
        $data = [];
        if (isset($items)) {
            $data = User::join('roles as r','r.id','users.id_role')
            ->with('roles.permissions')
            ->select('users.*','r.name as role')
            ->whereIn('users.id', $items)
            ->get()
            ->map(function($user) {
                $user->permissions = $user->roles->flatMap(function($role) {
                    return $role->permissions->pluck('name');
                })->unique()->values()->toArray();
                return $user;
            });
            // $data = User::query()
            // ->with('roles:id,name','roles.permissions:id,name')
            // ->whereIn('users.id', $items)
            // ->where('roles.permissions.name','<>','Permissions_Index')
            // ->get();
        }
        // dd($data);
        return $data;
    }

}
