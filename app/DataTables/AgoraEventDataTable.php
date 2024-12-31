<?php

namespace App\DataTables;

use App\Models\AgoraEvent;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AgoraEventDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($row) {
                return '<img src="' . asset($row->image_path) . '" width="50" height="50" />';
            })
            ->addColumn('action', 'activities.agora-events.action')
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AgoraEvent $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('AgoraEvent-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('image')
            ->title('Image')
            ->orderable(false)
            ->searchable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('title'),
            Column::make('price'),
            Column::make('hosted_by'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->width(180)
            ->addClass('text-center')
        ];
    }
}
