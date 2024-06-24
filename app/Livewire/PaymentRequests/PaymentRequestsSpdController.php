<?php

namespace App\Livewire\PaymentRequests;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ApiService;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\SolicitudPagoSpd;

class PaymentRequestsSpdController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $user_auth,$showModal;
    public $selected_id;
    public $stepTable;

    public $tableControllerKey;// key refrescar TableController

    // ~ Otras propiedades
    // public $propiedades;

    // * Propiedades para la api
    protected $apiServicios;
    public $apiEmail;
    public $apiData;
    public $apiError;

    public function mount(ApiService $apiServicios)
	{
		$this->componentName    = 'Solicitudes de pago';
		$this->pageTitle        = 'Listado';
        $this->user_auth        = auth()->user();
        $this->showModal        = false;

        $this->selected_id      = 0;
        $this->stepTable        = 1; // Mostrar principal por defecto
        $this->tableControllerKey = uniqid();

        // ~ Otras propiedades
        // $this->properties = [];

        // * Servicio api
        $this->apiService       = $apiServicios;
        $this->apiEmail        = $this->user_auth->email;

        $this->user_auth->email == 'emmanuel.perez@mspv.com.mx' ? $this->apiEmail = 'rhpuebla@mspv.com.mx': '';
        $this->user_auth->email == 'emmanuelplee@gmail.com' ? $this->apiEmail = 'rhmorelos@mspv.com.mx' : '';
        $this->user_auth->email == 'saul.rosales@mspv.com.mx' ? $this->apiEmail = 'rhdf@mspv.com.mx' : '';
    }
    /**
     * Esta función es para refrescar el componente
     * De la tabla por medio del key uniqid()
     *
     * @return void
     */
    #[On('refreshChildTable')]
    public function refreshChildTable()
    {
        error_log('refreshChildTable');
        $this->tableControllerKey = uniqid();
    }
    public function render()
    {
        // $spdFind = SolicitudPagoSpd::where('user_id', '=', $this->user_auth->id)->get();
        // $spdFind = SolicitudPagoSpd::where('user_id', '=', 2)->get();
        // if (count($spdFind) <= 0) {
        //     $this->apiCrearRegistros();
        // }else {
        //     $this->apiActualizarRegistros();
        // }
        return view('livewire.payment-requests.payment-requests-spd-component',
        [
            'data' => SolicitudPagoSpd::latest()->take(1)->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function apiCrearRegistros()
    {
        error_log('apiCrearRegistros');
        $apiData = $this->apiService->fetchDataByEmail($this->apiEmail);
        // Crear registros si no existen en la base de datos
        foreach ($apiData['data'] as $key => $value) {
            // dd($value);
            // Buscar la sdp por folio si no existe se crea
            $spd = SolicitudPagoSpd::firstOrCreate([
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
        // Si existen solo actualizar registros y solo si cambio algo

        //refrescar tabla
    }
    public function apiActualizarRegistros()
    {
        error_log('apiActualizarRegistros');
        $apiData = $this->apiService->fetchDataByEmail($this->apiEmail);
        // Crear registros si no existen en la base de datos
        foreach ($apiData['data'] as $key => $value) {
            // dd($value);
            // Buscar la sdp por folio si no existe se crea
            $spd = SolicitudPagoSpd::firstOrCreate([
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
        // Si existen solo actualizar registros y solo si cambio algo

        //refrescar tablalizar registros
        //refrescar tabla
    }

    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;
        $this->showModal        = false;
        // ~ Otras propiedades
        // $this->properties       = [];
    }
}
