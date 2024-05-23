<?php

namespace App\Livewire\Roles;

use Carbon\Carbon;
use App\Models\Role;
use App\Exports\ExcelRolesExport;
use function Laravel\Prompts\error;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class RolesTableController extends DataTableComponent
{
    protected $model = Role::class;

    // public $filters = [
    //     'start_date' => null,
    // ];
    public $dateMin, $dateMax;

    public function mount()
    {
        $this->dateMin = '2024-01-01 00:00:01';
        $this->dateMax = Carbon::parse(Carbon::now())->format('Y-m-d');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setLoadingPlaceholderStatus(true);
        $this->setLoadingPlaceholderBlade('livewire.common.dataTable.loading');
        // $this->setLoadingPlaceholderContent('cargando ...');

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
        // $this->setDefaultSortingLabels('Asc', 'Desc'); // Default A-Z y Z-A

        // ======= Tabla ====================================================================
        $this->setTheadAttributes([
            'default' => true,
            'class' => 'bg-info bg-opacity-25 border border-info',
        ]);
        $this->setOfflineIndicatorEnabled();
        // $this->setOfflineIndicatorDisabled();

        // ===== Filtros ===================================================================
        $this->setFiltersVisibilityEnabled();
        // $this->setFilterLayoutPopover();
        $this->setFilterLayoutSlideDown();

        // $this->setSecondaryHeaderTrAttributes(function($rows) {
        //     return ['class' => 'bg-success p-2 text-white bg-opacity-75'];
        // });
        // $this->setRefreshMethod('refresh');
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
        return $query;
    }
    public function filters(): array
    {
        return [
            TextFilter::make('Nombre')
                ->config([
                    'placeholder' => 'Buscar nombre',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('roles.name', 'like', '%'.$value.'%');
            }),
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
            TextFilter::make('Rol Tipo')
                ->config([
                    'placeholder' => 'Buscar rol tipo nombre',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('roleTipo.nombre', 'like', '%'.$value.'%');
            }),
            TextFilter::make('Rol Tipo Descrip')
                ->config([
                    'placeholder' => 'Buscar rol tipo descripción',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('roleTipo.descripcion', 'like', '%'.$value.'%');
            }),
            DateRangeFilter::make('Fecha Creado')
                ->config([
                    'allowInput' => true,   // Permitir la entrada manual de fechas
                    'altFormat' => 'd-m-y', // Formato de fecha que se mostrará una vez seleccionado
                    'ariaDateFormat' => 'd-m-y', // Un formato de fecha compatible con aria
                    'dateFormat' => 'Y-m-d', // Formato de fecha que recibirá el filtro
                    'earliestDate' => $this->dateMin, // La fecha más temprana aceptable
                    'latestDate' => $this->dateMax, // La última fecha aceptable
                    'placeholder' => 'Rango de fechas',
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // Los valores que se mostrarán para los valores de fecha mínima/máxima
                ->filter(function (Builder $builder, array $dateRange) { // Espera un array.
                    $builder
                        ->whereDate('roles.created_at', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('roles.created_at', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
            }),
            DateRangeFilter::make('Fecha Actualizado')
                ->config([
                    'allowInput' => true,   // Permitir la entrada manual de fechas
                    'altFormat' => 'd-m-Y', // Formato de fecha que se mostrará una vez seleccionado
                    'ariaDateFormat' => 'd-m-Y', // Un formato de fecha compatible con aria
                    'dateFormat' => 'Y-m-d', // Formato de fecha que recibirá el filtro
                    'earliestDate' => $this->dateMin, // La fecha más temprana aceptable
                    'latestDate' => $this->dateMax, // La última fecha aceptable
                    'placeholder' => 'Rango de fechas',
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // Los valores que se mostrarán para los valores de fecha mínima/máxima
                ->filter(function (Builder $builder, array $dateRange) { // Espera un array.
                    $builder
                        ->whereDate('roles.updated_at', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('roles.updated_at', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
            }),
            DateFilter::make('Fecha Creado Mismo día','created_at')
                    ->config([
                        'min' => $this->dateMin,
                        'max' => $this->dateMax,
                    ])
                    ->filter(function(Builder $builder, string $value) {
                        $from = Carbon::parse($value)->format('Y-m-d') . ' 00:00:00';
                        $to = Carbon::parse($value)->format('Y-m-d') . ' 23:59:59';
                        $builder->whereBetween('roles.created_at',array($from, $to));
            }),
            DateFilter::make('Fecha Actualizado Mismo día','updated_at')
                    ->config([
                        'min' => $this->dateMin,
                        'max' => $this->dateMax,
                    ])
                    ->filter(function(Builder $builder, string $value) {
                        $from = Carbon::parse($value)->format('Y-m-d') . ' 00:00:00';
                        $to = Carbon::parse($value)->format('Y-m-d') . ' 23:59:59';
                        $builder->whereBetween('roles.updated_at',array($from, $to));
            }),
        ];
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable() // Search general
                ->sortable()
                ->excludeFromColumnSelect()
                // ->secondaryHeader(function($rows) {
                //     return $rows->sum('id');
                // }),
                // ->footer(function($rows) {
                //     return 'Subtotal: ' . $rows->sum('id');
                // }),
            ->html(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable()
                ->excludeFromColumnSelect()
            ->html(),
            BooleanColumn::make('Activo', 'status')
                ->setView('livewire.common.dataTable.status')
            ->html(),
            Column::make('Rol Tipo', 'roleTipo.nombre')
                ->sortable()
                ->searchable()
            ->html(),
            Column::make('Rol Tipo Descrip', 'roleTipo.descripcion')
                ->sortable()
                ->searchable()
            ->html(),
            DateColumn::make("Fecha Creado", "created_at")
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
                ->collapseOnTablet()
            ->html(),
            DateColumn::make('Fecha Actualizado', 'updated_at')
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
                ->collapseOnTablet()
            ->html(),
            Column::make('Acciones')
                ->label((
                    fn($item) => view('livewire.roles.acciones', compact('item'))
                ))
                ->excludeFromColumnSelect()
            ->html(),
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
