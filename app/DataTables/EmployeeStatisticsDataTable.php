<?php

namespace App\DataTables;

use App\Models\EmployeeStatistic;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\EmployeeStatistics;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class EmployeeStatisticsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'employeeStatistics.action')
            ->editColumn('media_url',function($row){
                $imagePath = asset($row->media_url);
                return '<img src="' . $imagePath . '" width="50" height="50" alt="Image">';

            })
            ->rawColumns(['media_url','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EmployeeStatistics $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employeestatistics-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('state'),
            Column::make('label'),
            Column::make('media_url'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'EmployeeStatistics_' . date('YmdHis');
    }
}
