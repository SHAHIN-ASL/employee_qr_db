<?php

namespace App\DataTables;

use App\Models\Attendence;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AttendenceDataTable extends DataTable
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
            ->addColumn('action', 'attendence.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Attendence $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Attendence $model)
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
                    ->setTableId('attendence-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
                    
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
           'Employee id',
           'Name',
           'Date',
           'On_Duty',
           'Off_duty',
           'Clock_In',
           'Clock_Out',
           'Work_Time',
           'ATT_Time',
           'Time',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Attendence_' . date('YmdHis');
    }
}
