<?php

namespace App\Livewire\PaymentRequests;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SolicitudPagoSpd;

class PaymentRequestsSpdTableController extends DataTableComponent
{
    protected $model = SolicitudPagoSpd::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make("User id", "user_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
