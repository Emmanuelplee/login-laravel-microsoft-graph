<?php

namespace App\Livewire\Permissions;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Permissions;

class PermissionsTable extends DataTableComponent
{
    protected $model = Permissions::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        // ======= Busqueda global============================================================
        $this->setSearchEnabled();
        $this->setEmptyMessage('No se encontraron registros');
        // $this->setSearchDisabled();
        $this->setSearchPlaceholder('Buscar en la tabla ...');
        $this->setSearchDebounce(1000); // esperará 1 segundo antes de enviar la solicitud.
        // $this->setSearchBlur(); // Búsqueda una vez que cambie el foco

        //========= Pagination ===============================================================
        $this->setPageName('permisoPage');
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
        $this->setDefaultSortingLabels('Asc', 'Desc'); // Default A-Z y Z-A

        // ======= Tabla ====================================================================
        $this->setTheadAttributes([
            'default' => true,
            'class' => 'bg-info bg-opacity-25 border border-info',
        ]);
        $this->setOfflineIndicatorEnabled();
        // $this->setOfflineIndicatorDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Descripcion", "description")
                ->sortable(),
            // Column::make("Guard name", "guard_name")
            //     ->sortable(),
            Column::make("Creado", "created_at"),
            Column::make("Actualizado", "updated_at"),
        ];
    }
}
