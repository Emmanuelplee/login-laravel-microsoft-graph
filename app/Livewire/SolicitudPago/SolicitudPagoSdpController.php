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
    public $archivos_sdps_find;
    // Para el Formulario
    public $files, $monto_capturado, $fecha, $uuid, $folio;
    public $existe_uuid, $sdp_asociado;
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
        $this->archivos_sdps_find   = [];

        $this->files            = '';
        $this->monto_capturado  = 0;
        $this->fecha            = '';
        $this->uuid             = '';
        $this->folio            = '';

        $this->existe_uuid      = false;
        $this->sdp_asociado     = '';
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
    /**
     * Muestra la solicitud de pago específica.
     *
     * @param int $id
     * @return void
     */
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

            $this->archivos_sdps_find = ArchivosSdps::where('sdp_id','=',$this->selected_id)->get();
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
    /**
     * Actualiza el archivo seleccionado con el archivo proporcionado.
     *
     * Esta función valida la extensión del archivo, el tamaño y su contenido antes de actualizar el archivo seleccionado.
     * También valida el monto total capturado y lo compara con el total de la SDP seleccionada.
     *
     * @param File $files El archivo a ser actualizado.
     * @return void
     * @throws ValidationException Si la extensión del archivo no es válida o el tamaño del archivo excede el límite.
     */
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
            // reglas solo para el xml
            $rules = [
                'files'     => ['required','mimes:xml','max:1048', new XmlVersionFour],
            ];
        }else {
            // reglas para cualquier archivo excepto xml
            $rules = [
                'files'     => ['required','mimes:pdf,jpg,jpeg','max:1048'],
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

            $archivoFind = ArchivosSdps::where('uuid', '=',$this->uuid)->first();
            if ($archivoFind) {
                $this->existe_uuid = true;
                $this->sdp_asociado = $archivoFind->SolicitudPagoSdp;
                $this->dispatch('item-error', 'El archivo xml ya está asociado a la sdp folio:'. $this->sdp_asociado->folio);
                return;
            }
            $sdpFind = SolicitudPagoSdp::find($this->selected_id);
            error_log('Comprobado: ',$this->monto_comprobado, 'Capturado: '.$this->monto_capturado);
            if (($this->monto_comprobado + $this->monto_capturado) > $sdpFind->monto ) {
                $this->existe_uuid = true;
                $this->dispatch('item-error', 'El monto comprobado + capturado es mayor al total de la SDP.');
                return;
            }
            $this->dispatch('item-info-file','Archivo XML cargado correctamente');
            return;
        } else {

            if ($extension === 'jpg' || $extension === 'jpeg') {
                // NOTE: bajar la calidad a la imagen $this->files
            }
            $this->dispatch('item-info-file','Archivo PDF o JPG cargado correctamente');
            return;
        }
    }
    /**
     * Actualiza un registro de SolicitudPagoSdp con los datos proporcionados.
     *
     * Esta función maneja el proceso de subida de archivos, valida los datos, y actualiza el registro de SDP correspondientemente.
     * También crea registros relacionados de ArchivosSdps para archivos XML y no XML.
     *
     * @return void
     */
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

            error_log('processPdfOrJpgFile');
            if (($this->monto_comprobado + $this->monto_capturado) > $sdpFind->monto ) {
                $this->dispatch('item-error', 'El monto comprobado + capturado es mayor al total de la SDP.');
                return;
            }

            $ruta = $extension === 'pdf' ? 'archivos_sdps/PDF' : 'archivos_sdps/IMAGEN';
            // crear el archivo (pdf o imagen)
            $archivoFind = ArchivosSdps::create([
                'tipo'      => $extension === 'pdf' ? 'PDF' : 'IMAGEN',
                'monto'     => $this->monto_capturado,
                'ruta'      => $this->files->store($ruta, 'public'),
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
            ]);
        }
        // $this->resetUI();
        $this->dispatch('item-modal-updated','¡Registro Actualizado!');
        // $this->refreshChildTable();

    }

    #[On('destroyFile')]
    public function destroyFile($id)
    {
        error_log('destroyFile: '.$id);
        $archivoFind = ArchivosSdps::find($id);
        // Una vez encontrado el Archivo a eliminar
        Log::error('ArchivoFid:', $archivoFind->toArray());
        if ($archivoFind) {
            // Info de sdp
            $sdpFind = SolicitudPagoSdp::find($this->selected_id);
            // campo json monto_tipo_archivo
            $json = $sdpFind->monto_tipo_archivo ?? [];
            // Existe el monto_tipo_archivo [XML,PDF,IMAGEN]
            if (isset($json[$archivoFind->tipo])) {
                $monto_total_por_tipo_archivo = $json[$archivoFind->tipo] - $archivoFind->monto;
                // Si monto_total_por_tipo_archivo es menor o igual a 0, se elimina el tipo de archivo del campo json
                if ($monto_total_por_tipo_archivo <= 0) {
                    unset($json[$archivoFind->tipo]);
                }else{
                    $json[$archivoFind->tipo] =  $json[$archivoFind->tipo] - $archivoFind->monto;
                }

                if ($archivoFind->tipo === 'XML' && !isset($json[$archivoFind->tipo])) {
                    $sdpFind->update([
                       'monto_tipo_archivo' => $json,
                       'monto_comprobado'   => $sdpFind->monto_comprobado - $archivoFind->monto,
                       'xml_estatus'        => 0,
                    ]);
                }else {
                    $sdpFind->update([
                       'monto_tipo_archivo' => $json,
                       'monto_comprobado'   => $sdpFind->monto_comprobado - $archivoFind->monto,
                    ]);
                }
                // Si todo esta bien eliminar imagen y el registro
                $imageTemp = $archivoFind->ruta;
                $archivoFind->delete();

                if ($imageTemp != null) {
                    $path = public_path('/storage/' . $imageTemp);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                // Refrescar datos de cambios en la SDP
                $this->monto_comprobado = $this->monto_comprobado;
                // recargar los archivos de sdp
                $this->archivos_sdps_find = ArchivosSdps::where('sdp_id','=',$this->selected_id)->get();
            }else {
                $this->dispatch('item-error', 'El archivo no tiene un monto asociado.');
                return;
            }
            // Refrescar tabla principal
            $this->dispatch('item-deleted','¡Archivo Eliminado!');
            return;
        }else {
            $this->dispatch('item-error', 'El archivo no se encontró.');
            return;
        }
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
        $this->sdp_asociado         = '';

        $this->resetValidation();
    }
}
