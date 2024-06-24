<?php

namespace App\Livewire\PaymentRequests;

use App\Models\SolicitudPagoSpd;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PaymentRequestsSpdTableController extends DataTableComponent
{
    protected $model = SolicitudPagoSpd::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        // Agregar el filtro en la configuración
        // $this->setFilter('user_id', auth()->id());

        $this->setQueryStringStatus(false); // Desactivar la cadena de consulta si no es necesaria
    }
    public function builder(): Builder
    {
        error_log('builder');
        // Retornar solo los registros del usuario autenticado
        $userId = auth()->user()->id;
        Log::info('User ID: ' . $userId); // Esto registrará el ID del usuario en el archivo de logs de Laravel
        return SolicitudPagoSpd::query()->where('user_id', $userId);

        // Si el usuario no está autenticado, retorna una consulta vacía
        return SolicitudPagoSpd::query()->where('user_id', 0);
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Folio", "folio")
                ->sortable(),
            Column::make("Centro costo", "centro_costo")
                ->sortable(),
            Column::make("Fecha hr sdp", "fecha_hr_sdp")
                ->sortable(),
            Column::make("Solicitante", "solicitante")
                ->sortable(),
            Column::make("Sub conceptos", "sub_conceptos")
                ->sortable(),
            Column::make("Cargo", "cargo")
                ->sortable(),
            Column::make("Dirigido a", "dirigido_a")
                ->sortable(),
            Column::make("Factura", "factura")
                ->sortable(),
            Column::make("Monto", "monto")
                ->sortable(),
            Column::make("Estatus", "estatus")
                ->sortable(),
            Column::make("Archivos", "archivos")
                ->sortable(),
            Column::make("Xml estatus", "xml_estatus")
                ->sortable(),
            Column::make("user_id", "user_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
