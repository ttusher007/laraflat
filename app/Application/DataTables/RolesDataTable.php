<?php

namespace App\Application\DataTables;

use App\Application\Model\Role;
use Yajra\Datatables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
             ->eloquent($this->query())
             ->addColumn('edit', 'admin.role.buttons.edit')
             ->addColumn('delete', 'admin.role.buttons.delete')
             ->addColumn('view', 'admin.role.buttons.view')
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Role::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'print', 'reset', 'reload'],
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
            [
                'name' => "id",
                'data' => 'id',
                'title' => adminTrans('curd' , 'id'),
            ],
            [
                'name' => "name",
                'data' => 'name',
                'title' => adminTrans('role' , 'name'),
            ],
            [
                'name' => "slug",
                'data' => 'slug',
                'title' => adminTrans('role' , 'slug'),
            ],
            [
                'name' => "view",
                'data' => 'view',
                'title' => adminTrans('curd' , 'view'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => adminTrans('curd' , 'edit'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => adminTrans('curd' , 'delete'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Roledatatables_' . time();
    }
}