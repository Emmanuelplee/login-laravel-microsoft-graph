<?php

namespace App\Livewire\ActivityLog;

use Carbon\Carbon;
use App\Models\Table;
use App\Models\CustomActivity;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class ActivityLogTableController extends DataTableComponent
{
    protected $model = CustomActivity::class;

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
        // * ===== Filtros ====================================================
        $this->setFiltersVisibilityEnabled();
        $this->setFilterLayoutSlideDown();

        // * ===== Multiples tablas misma vista ===============================
        // $this->setQueryStringDisabled();
        // $this->setColumnSelectStatus(false);
    }
    public function builder(): Builder
    {
        $query = CustomActivity::query()
            ->with('user:id,alias,name');
        return $query;
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Tabla', 'log_name')
                ->options([
                    '' => 'Todos',
                    // 'user' => 'user',
                    // 'role' => 'role',
                    // 'permission' => 'permission',
                    'modelo'  => Table::query()->orderBy('id')->get()
                        ->keyBy('name')->map(fn($table) => $table->name)->toArray()
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value != '') {
                        $builder->where('activity_log.log_name','=',$value);
                    }

            }),
            TextFilter::make('Descripcion')
                ->config([
                    'placeholder' => 'Buscar registro por descripción',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('activity_log.description', 'like', '%'.$value.'%');
                }),
            NumberFilter::make('Id Modelo')
                ->config([
                    'min' => 0, // Minimum Value Accepted
                    'max' => 100000, // Maximum Value Accepted
                    'placeholder' => 'Numero mayor a 0', // A placeholder value
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('subject_id', '=', $value);
            }),
            NumberFilter::make('Id Usuario')
                ->config([
                    'min' => 0, // Minimum Value Accepted
                    'max' => 100000, // Maximum Value Accepted
                    'placeholder' => 'Numero mayor a 0', // A placeholder value
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('causer_id', '=', $value);
            }),
            TextFilter::make('Nombre Usuario')
                ->config([
                    'placeholder' => 'Buscar por nombre del usuario',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('user.alias', 'like', '%'.$value.'%');
            }),
            DateRangeFilter::make('Rango Fecha Creado')
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
                        ->whereDate('activity_log.created_at', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('activity_log.created_at', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
            }),
            DateFilter::make('Dia Fecha Creado','created_at')
                    ->config([
                        'min' => $this->dateMin,
                        'max' => $this->dateMax,
                    ])
                    ->filter(function(Builder $builder, string $value) {
                        $from = Carbon::parse($value)->format('Y-m-d') . ' 00:00:00';
                        $to = Carbon::parse($value)->format('Y-m-d') . ' 23:59:59';
                        $builder->whereBetween('roles.created_at',array($from, $to));
            }),
        ];
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable() // buscador general
                ->sortable()
                ->excludeFromColumnSelect()
            ->html(),
            Column::make("Tabla", "log_name")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Descripcion", "description")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Tipo Modelo", "subject_type")
                ->sortable()
                ->deselected()
            ->html(),
            Column::make("id Modelo", "subject_id")
                ->sortable(),

            Column::make("Nombre Modelo")
                ->label((
                    fn($item) => view('livewire.activity-log.model', compact('item'))
                ))
            ->html(),

            Column::make("Evento", "event")
                ->sortable(),
            Column::make("Modelo Causante", "causer_type")
                ->sortable()
                ->deselected()
            ->html(),
            Column::make("Id Usuario", "causer_id")
                ->sortable()
            ->html(),

            Column::make("Nombre Usuario",'user.alias')
                ->sortable()
            ->html(),

            Column::make("Campos")
                ->label((
                    fn($item) => view('livewire.activity-log.properties', compact('item'))
                ))
            ->html(),

            Column::make("Propiedades", "properties")
                ->searchable() // buscador general
                ->deselected()
                ->sortable()
            ->html(),
            Column::make("Ip", "ip")
                ->sortable(),
            Column::make("Host", "host")
                ->sortable(),
            Column::make("Navegador", "browser")
                ->sortable(),
            DateColumn::make("Fecha Creado", "created_at")
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
                ->collapseOnTablet()
            ->html(),
        ];
    }
}
