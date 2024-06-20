<?php

namespace App\Livewire\ReportPermissions;

use App\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use App\Exports\ReportPermissions\ExcelTableThreeExport;

class TableThreePermissionsByRolAndUsers extends DataTableComponent
{
    protected $model = Role::class;

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
        $this->setPageName('tablaThreePage');
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
        error_log('builder');
        $query = Role::query()
            ->with('users:id,alias');
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
            Column::make("Rol", "name")
                ->searchable()
                ->sortable()
            ->html(),
            // Column::make("Status", "status")
            //     ->sortable(),
            // Column::make("Id role tipo", "id_role_tipo")
            //     ->sortable(),
            // Column::make('Usuarios')
            //     ->label((
            //         fn($item) => view('livewire.report-permissions.table-three.list-users',['item' => $item,])
            //     ))
            //     ->excludeFromColumnSelect()
            // ->html(),
            Column::make('Usuarios y permisos')
                ->label((
                    fn($item) => view('livewire.report-permissions.table-three.list-permissions',['item' => $item,])
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
        error_log('exportExcel');
        $excelName = 'reporte-permisos-tabla-tres_'.now()->format('Y_m_d_H_i').'.xlsx';
        $items = $this->getSelected();
        $data = $this->dataExcel($items);

        $this->clearSelected();

        return Excel::download(new ExcelTableThreeExport($data), $excelName);
    }

    public function dataExcel($items){
        $data = [];
        if (isset($items)) {
            $data = Role::query()
            ->with('permissions:id,name','users:id,alias,email')
            ->select('roles.*')
            ->whereIn('roles.id', $items)
            ->get()
            ->map(function ($role){
                $role->permissions = $role->permissions->pluck('name')->toArray();
                return $role;
            })
            ->map(function ($role){
                $role->users = $role->users->pluck('email')->toArray();
                return $role;
            });
        }
        // dd($data);
        return $data;
    }
}
