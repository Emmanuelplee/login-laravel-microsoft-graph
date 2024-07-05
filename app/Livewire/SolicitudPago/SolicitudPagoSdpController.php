<?php

namespace App\Livewire\SolicitudPago;

use App\Models\User;
use App\Rules\ValidXml;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ArchivosSdps;
use App\Services\ApiService;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\SolicitudPagoSdp;
use App\Rules\XmlVersionFour;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SolicitudPagoSdpController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $pageTitle, $componentName, $user_auth,$showModal;
    public $selected_id;
    public $stepTable;

    public $tableControllerKey;// key refrescar TableController

    // ~ Otras propiedades
    // Para modal info
    public $info_sdp_selected, $monto_tipo_archivo, $monto_comprobado, $xml_status;
    // Para el Formulario
    public $files, $monto_capturado, $fecha, $uuid, $folio;
    public $existe_uuid;
    public $dateMin, $dateMax;


    public function mount()
	{
		$this->componentName    = 'Solicitudes de pago';
		$this->pageTitle        = 'Listado';
        $this->user_auth        = auth()->user();
        $this->showModal        = false;

        $this->selected_id      = 0;
        $this->stepTable        = 1; // Mostrar principal por defecto
        $this->tableControllerKey = uniqid();

        // ~ Otras propiedades
        $this->info_sdp_selected    = [];
        $this->monto_tipo_archivo   = [];
        $this->monto_comprobado     = 0;
        $this->xml_status           = false;

        $this->files            = '';
        $this->monto_capturado  = 0;
        $this->fecha            = '';
        $this->uuid             = '';
        $this->folio            = '';

        $this->existe_uuid      = false;
        $this->dateMin          = '2023-01-01 00:00:01';
        $this->dateMax          = Carbon::parse(Carbon::now())->format('Y-m-d');
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
    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                if ($validator->errors()->count() > 0) {
                    $errors = $validator->errors()->messages();
                    $firstKey = array_key_first($errors);
                    $this->dispatch('form-focus-error', firstName: $firstKey);
                    return;
                }
            });
        });
    }
    public function render()
    {
        return view('livewire.solicitud-pago.solicitud-pago-sdp-component',
        [
            'data' => SolicitudPagoSdp::latest()->take(1)->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function show($id)
    {
        error_log('show');
        $item = SolicitudPagoSdp::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;

            $this->info_sdp_selected    = $item;

            $this->monto_tipo_archivo   = $item->monto_tipo_archivo;
            $this->monto_comprobado     = $item->monto_comprobado;
            $this->xml_status           = $item->xml_estatus == 1 ? true : false;
            // $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

            $this->showModal = true;
            $this->dispatch('item-modal-edit', title: 'Mostrar modal show!');
            return;
        }else {
            $this->dispatch('item-error', 'No existe el registro!');
            return;
        }
    }
    public function edit($id)
    {
        error_log('edit');
        $item = SolicitudPagoSdp::find($id);
        if (isset($item)) {
            $this->selected_id  = $item->id;

            $this->info_sdp_selected    = $item;

            $this->monto_tipo_archivo   = $item->monto_tipo_archivo;
            $this->monto_comprobado     = $item->monto_comprobado;
            $this->xml_status           = $item->xml_estatus == 1 ? true : false;
            // $this->id_role_tipo = $item->roleTipo->only('id','nombre','descripcion');

            $this->dispatch('item-modal-edit', title: '¡Mostrar modal edit!');
            return;
        }else {
            $this->dispatch('item-error', '¡No existe el registro!');
            return;
        }
    }
    public function updatedFiles()
    {
        error_log('updatedFiles');
        // Reiniciar valores para cargar cualquier file
        $this->monto_capturado  = 0;
        $this->fecha            = '';
        $this->uuid             = '';
        $this->folio            = '';
        $this->existe_uuid      = false; // Mostrar botón y ocultar error

        $extension = $this->files->getClientOriginalExtension();
        if ($extension === 'xml') {
            $rules = [
                'files'     => ['required','mimes:xml,pdf,jpg,jpeg','max:1048', new XmlVersionFour],
            ];
        }else {
            $rules = [
                'files'     => ['required','mimes:xml,pdf,jpg,jpeg','max:1048'],
            ];
        }
        $messages = [
            'files.required'    => 'Debe seleccionar un archivo.',
            'files.mimes'       => 'Debe seleccionar un archivo de tipo (xml,pdf,jpg)',
            'files.max'         => 'El tamaño máximo del archivo es 1MB.',
        ];
        $this->validate($rules, $messages);
        Log::error('updatedFiles extension: '.$extension);

        if ($extension === 'xml') {
            // $this->procesarArchivoXml($this->files);
            $xml = simplexml_load_file($this->files->getRealPath());
            $namespaces = $xml->getNamespaces(true);
            $xml->registerXPathNamespace('cfdi', $namespaces['cfdi']);
            $xml->registerXPathNamespace('tfd', $namespaces['tfd']);

            $this->fecha = Carbon::parse((string) $xml['Fecha']);
            $this->monto_capturado = (float) $xml['Total'];
            $this->folio = (string) $xml['Folio'];

            $this->uuid = (string) $xml->xpath('//tfd:TimbreFiscalDigital')[0]['UUID'];

            if (ArchivosSdps::where('uuid', '=',$this->uuid)->first()) {
                $this->existe_uuid = true;
                $this->dispatch('item-error', 'El archivo xml ya está asociado a una sdp.');
                return;
            }
            error_log('Comprobado: ',$this->monto_comprobado, 'Capturado: '.$this->monto_capturado);
            $sdp = SolicitudPagoSdp::find($this->selected_id);
            if (($this->monto_comprobado + $this->monto_capturado) > $sdp->monto ) {
                $this->existe_uuid = true;
                $this->dispatch('item-error', 'El monto comprobado + capturado es mayor al total de la SDP.');
                return;
            }
            $this->dispatch('item-info-file','Archivo XML cargado correctamente');
            return;
        } else {
            if ($extension === 'jpg' || $extension === 'jpeg') {
                // NOTE: bajar la calidad a la imagen $this->files
                // $this->processPdfOrJpgFile($this->files);
            }
            $this->dispatch('item-info-file','Archivo PDF o JPG cargado correctamente');
            return;
        }
        $this->files            = '';
    }
    public function update()
    {
        error_log('update');
        $sdpFind = SolicitudPagoSdp::find($this->selected_id);
        $extension = $this->files->getClientOriginalExtension();
        Log::error('Extension: '.$extension);

        if ($extension === 'xml') {
            $rules = [
                'files'             => 'required|mimes:xml|max:1048',
                'monto_capturado'   => 'required|numeric|min:1',
            ];
            $messages = [
                'files.required'  => 'Debe seleccionar un archivo.',
                'files.max'       => 'El tamaño máximo del archivo es 1MB.',
                'monto_capturado.numeric'    => 'El monto debe ser un número.',
                'monto_capturado.min'       => 'El monto debe ser mayor a 0.',
            ];
            $this->validate($rules, $messages);
            // dd($data_xml);
            // crear el archivo con la data del xml
            $archivoFind = ArchivosSdps::create([
                'tipo'      => 'XML',
                'monto'     => $this->monto_capturado,
                'ruta'      => $this->files->store('archivos_sdps/XML', 'public'),
                'fecha_documento' => $this->fecha,
                'uuid'      => $this->uuid,
                'user_id'   => $this->user_auth->id,
                'sdp_id'    => $this->selected_id,
            ]);
            // Actualizar o crear el campo data
            $json = $sdpFind->monto_tipo_archivo ?? [];
            $json[$archivoFind->tipo] = ($json[$archivoFind->tipo] ?? 0) + $archivoFind->monto; // Actualizar monto

            //Actualizar la sdp con los datos nuevos actualizados
            $sdpFind->update([
                'monto_tipo_archivo'    => $json,
                'monto_comprobado'      => $sdpFind->monto_comprobado + $archivoFind->monto,
                'xml_estatus'           => $sdpFind->xml_estatus === 0 ?? 1,
            ]);
            // $this->dispatch('item-modal-updated','Registro actualizado');
            // return;
        } else {
            $rules = [
                'files'             => 'required|mimes:pdf,jpg,jpeg|max:1048',
                'monto_capturado'   => 'required|numeric|min:1',
                'fecha'             => 'required'
            ];
            $messages = [
                'files.required'  => 'Debe seleccionar un archivo.',
                'files.max'       => 'El tamaño máximo del archivo es 1MB.',

                'monto_capturado.numeric'   => 'El monto debe ser un número.',
                'monto_capturado.min'       => 'El monto debe ser mayor a 0.',
                'fecha.required'            => 'Debe ingresar la fecha.',
            ];
            $this->validate($rules, $messages);

            // $this->processPdfOrJpgFile($this->files);
            error_log('processPdfOrJpgFile');
            $ruta = $extension === 'pdf' ? 'archivos_sdps/PDF' : 'archivos_sdps/IMAGEN';
            $ArchivoFind =ArchivosSdps::create([
                'tipo'      => $extension === 'pdf' ? 'PDF' : 'IMAGEN',
                'uuid'      => $this->uuid,
                'fecha_documento' => $this->fecha,
                'ruta'      => $this->files->store($ruta, 'public'),
                'user_id'   => $this->user_auth->id,
                'sdp_id'    => $this->selected_id,
            ]);
        }
        // $this->resetUI();
        $this->dispatch('item-modal-updated','¡Registro Actualizado!');
        $this->refreshChildTable();

    }
    private function procesarArchivoXml($file)
    {
        error_log('Procesar Archivo XML');
        $xml = simplexml_load_file($file->getRealPath());
        $namespaces = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('cfdi', $namespaces['cfdi']);
        $xml->registerXPathNamespace('tfd', $namespaces['tfd']);

        $this->uuid = (string) $xml->xpath('//tfd:TimbreFiscalDigital')[0]['UUID'];
        $this->fecha = Carbon::parse((string) $xml['Fecha']);
        $this->monto_capturado = (float) $xml['Total'];
        $this->folio = (string) $xml['Folio'];
        error_log('nuevo uuid: '.$this->uuid);
        $existeSdpXml = ArchivosSdps::where('uuid', '=',$this->uuid)->first();
        if ($existeSdpXml->uuid === $this->uuid) {
            $this->dispatch('item-error', 'El archivo xml ya está asociado.');
            return;
        }
        dd($existeSdpXml);

        $sdp = SolicitudPagoSdp::find($this->selected_id);
        if (!$sdp || $sdp->monto !== $this->monto_capturado) {
            $this->dispatch('item-error', 'El archivo xml no corresponde a los datos de la SDP.');
            return;
        }
    }
    #[On('resetUI')]
    public function resetUI()
    {
        error_log('resetUI');
        $this->selected_id      = 0;
        $this->showModal        = false;
        // ~ Otras propiedades
        $this->info_sdp_selected    = [];
        $this->monto_tipo_archivo    = [];
        $this->monto_comprobado     = 0;
        $this->xml_status           = false;

        $this->files                = '';
        $this->monto_capturado      = 0;
        $this->fecha                = '';
        $this->uuid                 = '';
        $this->folio                = '';

        $this->existe_uuid          = false;

        $this->resetValidation();
    }
}
