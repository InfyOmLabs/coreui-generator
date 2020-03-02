<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'roles.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Role  $model
     * @return Builder
     */
    public function query(Role $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'description',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'rolesdatatable_'.time();
    }
}
