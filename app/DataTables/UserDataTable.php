<?php

namespace App\DataTables;

use App\Models\User;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($u) {
                $acoes = link_to(route('usuarios.edit',$u), 'Editar', ['class' => 'btn btn-sm btn-primary mr-1']);
                $acoes .= FormFacade::button('Excluir', ['class' => 'btn btn-sm btn-danger', 'onclick' => "excluir('" . route('usuarios.destroy', $u) . "')"]);

                return $acoes;
            })
            ->editColumn('created_at', function($f){
                return $f->created_at->format('d/m/Y');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Usuario $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->title('Ações'),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at')->title('Data de Criação'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Usuario_' . date('YmdHis');
    }
}
