<?php

namespace App\Livewire\ReportPermissions;

use App\Models\Permissions;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
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
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable()
            ->html(),
            Column::make("Descripcion", "description")
                ->sortable(),
            Column::make('Usuarios y roles')
                ->label((
                    fn($item) => view('livewire.report-permissions.table-four.list-users',['item' => $item,])
                ))
                ->excludeFromColumnSelect()
            ->html(),
        ];
    }
}
