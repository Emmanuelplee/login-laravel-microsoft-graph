<?php

namespace App\Livewire\SolicitudPago;

use App\Services\ApiService;
use Illuminate\Support\Carbon;
use App\Models\SolicitudPagoSdp;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class SolicitudPagoSdpTableController extends DataTableComponent
{
    protected $model = SolicitudPagoSdp::class;
    public $user_auth;
    public $apiEmail;

    public $dateMin, $dateMax;
    public $isLoading = false; // Estado de carga
    public function mount()
    {
        $this->dateMin = '2023-01-01 00:00:01';
        $this->dateMax = Carbon::parse(Carbon::now())->format('Y-m-d');

        $this->user_auth = auth()->user();
        $this->apiEmail = $this->user_auth->email;

        $this->user_auth->email == 'emmanuel.perez@mspv.com.mx' ? $this->apiEmail = 'rhmorelos@mspv.com.mx' : '';
        $this->user_auth->email == 'emmanuelplee@gmail.com' ? $this->apiEmail = 'rhpuebla@mspv.com.mx' : '';
        $this->user_auth->email == 'saul.rosales@mspv.com.mx' ? $this->apiEmail = 'rhdf@mspv.com.mx' : '';

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
        // * ===== Areas ====================================================
        $this->setConfigurableAreas([
            'after-toolbar' => ['livewire.solicitud-pago.table.areas',[
                'correo' => $this->apiEmail,
            ]],
        ]);
    }
    public function builder(): Builder
    {
        error_log('builder');
        // Retornar solo los registros del usuario autenticado
        Log::info('User ID: ' . $this->user_auth->id); // Esto registrará el ID del usuario en logs de Laravel
        return SolicitudPagoSdp::query()->where('user_id', $this->user_auth->id);
    }
    public function filters(): array
    {
        return [
            TextFilter::make('Folio')
                ->config([
                    'placeholder' => 'Buscar folio',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('solicitudes_pago_sdps.folio','like','%'.$value.'%');
            }),
            SelectFilter::make('Estatus')
                ->options([
                    '' => 'Todas',
                    'CORREGIR SDP'                => 'CORREGIR SDP',
                    'REQUIERE PAGO DE TESORERIA'  => 'REQUIERE PAGO DE TESORERIA',
                    'REQUIERE Vo.Bo. de CXP'      => 'REQUIERE Vo.Bo. de CXP',
                    'REQUIERE Vo.Bo. de DIR ADMIN'=> 'REQUIERE Vo.Bo. de DIR ADMIN',
                    'REQUIERE Vo.Bo. de GS'       => 'REQUIERE Vo.Bo. de GS',
                    'REQUIERE Vo.Bo. de GTE ADMIN'=> 'REQUIERE Vo.Bo. de GTE ADMIN',
                    'SOLICITUD CANCELADA'         => 'SOLICITUD CANCELADA',
                    'SOLICITUD PAGADA'            => 'SOLICITUD PAGADA',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value != '') {
                        $builder->where('solicitudes_pago_sdps.estatus','=',$value);
                    }
            }),
            DateRangeFilter::make('Fecha sdp')
                ->config([
                    'allowInput' => true,   // Permitir la entrada manual de fechas
                    'altFormat' => 'Y-m-d', // Formato de fecha que se mostrará una vez seleccionado
                    'ariaDateFormat' => 'Y-m-d', // Un formato de fecha compatible con aria
                    'dateFormat' => 'Y-m-d', // Formato de fecha que recibirá el filtro
                    'earliestDate' => $this->dateMin, // La fecha más temprana aceptable
                    'latestDate' => $this->dateMax, // La última fecha aceptable
                    'placeholder' => 'Rango de fechas',
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // Los valores que se mostrarán para los valores de fecha mínima/máxima
                ->filter(function (Builder $builder, array $dateRange) { // Espera un array.
                    $builder
                        ->whereDate('solicitudes_pago_sdps.fecha_hr_sdp', '>=', $dateRange['minDate']) // minDate fecha de inicio seleccionada
                        ->whereDate('solicitudes_pago_sdps.fecha_hr_sdp', '<=', $dateRange['maxDate']); // maxDate fecha de finalización seleccionada
            }),
            DateFilter::make('Fecha sdp día')
                ->config([
                    'min' => $this->dateMin,
                    'max' => $this->dateMax,
                    'pillFormat' => 'Y-m-d', // Format for use in Filter Pills
                    'placeholder' => 'Enter Date', // A placeholder value
                ])
                // ->setFilterDefaultValue('2023-06-30')
                ->filter(function(Builder $builder, string $value) {
                    $from = Carbon::parse($value)->format('Y-m-d') . ' 00:00:00';
                    $to = Carbon::parse($value)->format('Y-m-d') . ' 23:59:59';
                    $builder->whereBetween('solicitudes_pago_sdps.fecha_hr_sdp',array($from, $to));
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
            Column::make("Folio", "folio")
                ->searchable() // buscador general
                ->sortable()
                ->excludeFromColumnSelect()
                ->format(function($value) {
                    return new HtmlString('<strong>' . $value . '</strong>');
                })
            ->html(),
            Column::make("Centro costo", "centro_costo")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            DateColumn::make('Fecha sdp', 'fecha_hr_sdp')
                // ->inputFormat('d-m-Y H:i:s')
                ->outputFormat('d-m-Y h:i:s A')
                ->sortable()
            ->html(),
            Column::make("Solicitante", "solicitante")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Sub conceptos", "sub_conceptos")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Cargo", "cargo")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Dirigido a", "dirigido_a")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Factura", "factura")
                ->searchable() // buscador general
                ->sortable()
            ->html(),
            Column::make("Monto", "monto")
                ->searchable() // buscador general
                ->sortable()
                ->format(function($value) {
                    return '$' . number_format($value, 2);
                })
            ->html(),
            Column::make("Estatus", "estatus")
                ->sortable()
            ->html(),

            Column::make("Monto por archivo", "monto_tipo_archivo")
                ->sortable()
                ->format(function($value, $column, $row) {
                    return new HtmlString($this->formatMontoTipoArchivo($value));
                })
            ->html(),
            Column::make("Monto comprobado", "monto_comprobado")
                ->sortable()
                ->format(function($value){
                    return '$' . number_format($value, 2);
                })
            ->html(),
            Column::make("Xml estatus", "xml_estatus")
                ->sortable(),
            Column::make("Aprobado", "aprobado")
                ->sortable()
            ->html(),
            Column::make("User id", "user_id")
                ->sortable(),

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
                    fn($item) => view('livewire.solicitud-pago.table.acciones', compact('item'))
                ))
                ->excludeFromColumnSelect()
            ->html(),
        ];
    }
    public function apiActualizarRegistros($apiEmail)
    {
        error_log('apiActualizarRegistros');
        // Obtener los registros de la api
        $apiData = (new ApiService)->fetchDataByEmail($apiEmail);
        if (isset($apiData['error'])) {
            error_log('Api error: ' . $apiData['error']);
            $this->dispatch('item-error','Error ('.$apiData['error'].')');
            return;
        }
        if (isset($apiData['data'])) {
            $countApi = count($apiData['data']);
            $countLocal = count(SolicitudPagoSdp::all());

            if ($countApi <= 0) {
                $this->dispatch('item-error','No hay registros de solicitudes de pago');
                return;
            }

            // Actualizar o Crear registros si no existen en la bd local
            foreach ($apiData['data'] as $key => $value) {
                // Buscar la sdp por folio si no existe se crea
                $spd = SolicitudPagoSdp::updateOrCreate([
                    'folio' => $value['folio'],
                ], [
                    'folio'         => $value['folio'],
                    'centro_costo'  => $value['cc1'],
                    'fecha_hr_sdp'  => Carbon::createFromFormat('Y-m-d h:i:s A', $value['fecha_hora']),
                    'solicitante'   => $value['solicitado'],
                    'sub_conceptos' => html_entity_decode($value['subconceptos_informativos'], ENT_QUOTES | ENT_HTML5),
                    'cargo'         => $value['cargo'],
                    'dirigido_a'    => $value['dirigido'],
                    'factura'       => $value['factura'],
                    'monto'         => $value['monto'],
                    'estatus'       => $value['estatus'],
                    'user_id'       => $this->user_auth->id,
                ]);

            }
            $this->dispatch('actualizar-todas-sdps', 'Se han actualizado todos los registros');
        }
        // refrescar tabla
        $this->dispatch('refreshChildTable');
    }
    public function apiActualizarPorFolio($folio)
    {
        error_log('apiActualizarPorFolio');
        // Obtener los registros de la api
        $apiData = (new ApiService)->fetchDataByFolio($folio);
        if (isset($apiData['error'])) {
            error_log('Api error: ' . $apiData['error']);
            $this->dispatch('item-error','Error ('.$apiData['error'].')');
            return;
        }
        if (isset($apiData['data'])) {
            $countApi = count($apiData['data']);
            if ($countApi <= 0) {
                $this->dispatch('item-error','No hay registro con el folio: '.$folio);
                return;
            }
            // Error no existe folio en la api
            if ($apiData['data']['folio'] === '') {
                $this->dispatch('item-error','No se pudo obtener la información del folio: '.$folio);
                return;
            }
            // Buscar la sdp por folio si existe se actualiza
            $spdFind = SolicitudPagoSdp::where('folio','=',$apiData['data']['folio'])->first();
            $spdFind->update([
                'folio'         => $apiData['data']['folio'],
                'centro_costo'  => $apiData['data']['cc1'],
                'fecha_hr_sdp'  => Carbon::createFromFormat('Y-m-d h:i:s A', $apiData['data']['fecha_hora']),
                'solicitante'   => $apiData['data']['solicitado'],
                'sub_conceptos' => html_entity_decode($apiData['data']['subconceptos_informativos'],ENT_QUOTES|ENT_HTML5),
                'cargo'         => $apiData['data']['cargo'],
                'dirigido_a'    => $apiData['data']['dirigido'],
                'factura'       => $apiData['data']['factura'],
                'monto'         => $apiData['data']['monto'],
                'estatus'       => $apiData['data']['estatus'],
                'user_id'       => $this->user_auth->id,
            ]);
            $this->dispatch('actualizar-todas-sdps', 'Se actualizo la sdp con folio: '.$folio);
        }
        // refrescar tabla
        // $this->dispatch('refreshChildTable');
    }
    private function formatMontoTipoArchivo($value)
    {
        if (is_array($value)) {
            $formatted = '<ul>';
            // Lista del json
            foreach ($value as $key => $amount) {
                if ($key === 'XML') {
                    $key = 'Facturas (XML)';
                }else {
                    $key ='Recibos ('.$key.')';
                }
                $formatted .= '<li>' . $key . ': $' . number_format($amount, 2) . '</li>';
            }
            $formatted .= '</ul>';
            return $formatted;
        }
        return 'No hay archivos';
    }
}
