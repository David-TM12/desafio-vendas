<?php

namespace App\DataTables;

use App\Models\Fabricante;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FabricanteDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($f) {
                return link_to(route('fabricantes.edit', $f),'Editar', ['class' => 'btn btn-sm btn-primary']);
            })
            ->editColumn('created_at', function ($f) {
                return $f->created_at->format('d/m/Y');
            });
    }

    public function query(Fabricante $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('fabricante-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                        ->addClass('btn bg-primary')
                        ->text('<i class="fas fa-plus mr-1"></i>Cadastrar Novo'),

                        Button::make('export')
                        ->addClass('btn bg-primary')
                        ->text('<i class="fas fa-download mr-1"></i>Exportar'),


                        Button::make('print')
                        ->addClass('btn bg-primary')
                        ->text('<i class="fas fa-print mr-1"></i>Imprimir'),
                    );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Ações'),
            Column::make('nome'),
            Column::make('site'),
            Column::make('created_at')->title('Data de Criação'),
        ];
    }

    protected function filename()
    {
        return 'Fabricante_' . date('YmdHis');
    }
}