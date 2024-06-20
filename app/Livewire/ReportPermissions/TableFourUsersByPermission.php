<?php

namespace App\Livewire\ReportPermissions;

use App\Models\User;
use App\Models\Permissions;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Exports\ReportPermissions\ExcelTableFourExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TableFourUsersByPermission extends DataTableComponent
{
    protected $model = Permissions::class;

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
        $this->setPageName('tablaFourPage');
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
        $query = Permissions::query()
            ->with('users:name,alias');
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
            Column::make("Permiso", "name")
                ->searchable()
                ->sortable()
            ->html(),
            Column::make("Descripcion", "description")
                ->sortable(),
            Column::make('Usuarios con rol')
                ->label((
                    fn($item) => view('livewire.report-permissions.table-four.list-users',['item' => $item,])
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

        return Excel::download(new ExcelTableFourExport($data), $excelName);
    }

    public function dataExcel($items){
        $data = [];
        if (isset($items)) {
            $permissionsFind = Permissions::query()
            ->whereIn('permissions.id', $items)
            ->get();
            foreach ($permissionsFind as $permission) {
                $usersWithPermission = User::query()
                    ->select('id','alias','email')
                    ->with('roles:id,name')
                    ->whereHas('roles.permissions', function ($query) use ($permission) {
                        $query->where('name', $permission->name);
                    })
                    ->get();

                    $data[] = [
                        'id' => $permission->id,
                        'name' => $permission->name,
                        'description' => $permission->description,
                        'created_at' => $permission->created_at,

                        'users' => $usersWithPermission,
                    ];
            }
        }
        return collect($data);
    }
}
