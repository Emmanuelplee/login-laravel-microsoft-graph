<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Exports\ExcelRolesExport;
use function Laravel\Prompts\error;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class RolesTable extends DataTableComponent
{
    protected $model = Role::class;

    public array $filters = [
        'start_date' => null,
        'end_date' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        // ======= Búsqueda global============================================================
        $this->setSearchEnabled();
        $this->setEmptyMessage('No se encontraron registros');
        // $this->setSearchDisabled();
        $this->setSearchPlaceholder('Buscar en la tabla ...');
        $this->setSearchDebounce(1000); // esperará 1 segundo antes de enviar la solicitud.
        // $this->setSearchBlur(); // Búsqueda una vez que cambie el foco

        //========= Paginado ===============================================================
        $this->setPageName('rolePage');
        $this->setPerPageVisibilityStatus(true);// variable de pagina en la url
        $this->setPerPageAccepted([25, 50, 100]);// array de registros a visualizar
        $this->setPerPageFieldAttributes([
            'class' => 'bg-info bg-opacity-10 border border-info', // Add these classes to the dropdown
            'default-colors' => false, // Do not output the default colors
            'default-styles' => true, // Output the default styling
        ]);

        // ======= Ordenamiento o clasificación ==============================================
        $this->setSortingStatus(true);
        // $this->setSortingStatus(false);
        // $this->setDefaultSortingLabels('Asc', 'Desc'); // Default A-Z y Z-A

        // ======= Tabla ====================================================================
        $this->setTheadAttributes([
            'default' => true,
            'class' => 'bg-info bg-opacity-25 border border-info',
        ]);
        $this->setOfflineIndicatorEnabled();
        // $this->setOfflineIndicatorDisabled();

        // ===== Filtros ===================================================================
        $this->setFiltersStatus(true);
        $this->setFiltersVisibilityEnabled();
        // $this->setFilterLayoutPopover();
        // $this->setFilterLayoutSlideDown();

    }
    public function builder(): Builder
    {
        $query = Role::query()
            ->with('roleTipo:id,nombre,descripcion,estatus');
            // ->join() // Join some tables
            // ->select(); // Select some things

        // if ($this->filters['start_date']) {
        //     $query->where('roles.created_at', '>=', Carbon::parse($this->filters['start_date'])->startOfDay());
        // }

        // if ($this->filters['end_date']) {
        //     $query->where('roles.created_at', '<=', Carbon::parse($this->filters['end_date'])->endOfDay());
        // }

        return $query;
    }
    public function filters(): array
    {
        return [
            SelectFilter::make('Activo', 'status')
                ->options([
                    '' => 'Todos',
                    '1' => 'activos',
                    '0' => 'inactivos',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('roles.status', 1);
                    } elseif ($value === '0') {
                        $builder->where('roles.status', 0);
                    }
            }),
            DateRangeFilter::make('Fecha creación', 'created_at')
                ->config([
                    'allowInput' => true,   // Permitir la entrada manual de fechas
                    'altFormat' => 'd/m/y', // Formato de fecha que se mostrará una vez seleccionado
                    'ariaDateFormat' => 'd/m/y', // Un formato de fecha compatible con aria
                    'dateFormat' => 'Y-m-d', // Formato de fecha que recibirá el filtro
                    'earliestDate' => '2024-01-01', // La fecha más temprana aceptable
                    'latestDate' => '2024-12-31', // La última fecha aceptable
                    'placeholder' => 'Rango de fechas',
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // Los valores que se mostrarán para los valores de fecha mínima/máxima
                ->filter(function (Builder $builder, array $dateRange) { // Espera un array.
                    $builder
                        ->whereDate('roles.created_at', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('roles.created_at', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
                }),
            DateRangeFilter::make('Fecha actualización', 'updated_at')
                ->config([
                    'allowInput' => true,   // Permitir la entrada manual de fechas
                    'altFormat' => 'd/m/y', // Formato de fecha que se mostrará una vez seleccionado
                    'ariaDateFormat' => 'd/m/y', // Un formato de fecha compatible con aria
                    'dateFormat' => 'Y-m-d', // Formato de fecha que recibirá el filtro
                    'earliestDate' => '2024-01-01', // La fecha más temprana aceptable
                    'latestDate' => '2024-12-31', // La última fecha aceptable
                    'placeholder' => 'Rango de fechas',
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // Los valores que se mostrarán para los valores de fecha mínima/máxima
                ->filter(function (Builder $builder, array $dateRange) { // Espera un array.
                    $builder
                        ->whereDate('roles.updated_at', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('roles.updated_at', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
                }),
        ];
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable() // Search general
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            // Column::make("Guard name", "guard_name")
            //     ->sortable(),
            BooleanColumn::make('Activo', 'status')
                ->setView('common.dataTable.status'),
            SelectFilter::make('Activo', 'status')
            ->setCustomFilterLabel('common.dataTable.status'),
                // ->setSuccessValue(false),
            // Column::make("Id_rolTipo", "id_role_tipo")
            //     ->sortable()
            //     ->collapseOnTablet(),
            // ===================================================
            Column::make('Rol Tipo', 'roleTipo.nombre')
                ->sortable()
                ->searchable(),
            Column::make('Rol Tipo Descrip.', 'roleTipo.descripcion')
                ->sortable()
                ->searchable(),

            DateColumn::make("Creado", "created_at")
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
                ->collapseOnTablet(),
            DateColumn::make('Actualizado', 'updated_at')
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
                ->collapseOnTablet(),
        ];
    }
    public function bulkActions(): array
    {
        return [
            'exportExcel' => 'EXCEL',
            // 'exportPdf' => 'PDF',
        ];
    }

    public function exportExcel()
    {
        // User::whereIn('id', $this->getSelected())->update(['active' => true]);
        error_log('exportExcel');
        $roles = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new ExcelRolesExport($roles), 'roles.xlsx');
    }

    public function exportPdf()
    {
        // User::whereIn('id', $this->getSelected())->update(['active' => false]);
        error_log('exportPdf');

        $this->clearSelected();
    }
}
