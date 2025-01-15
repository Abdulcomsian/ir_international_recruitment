<?php

namespace App\DataTables;

use App\Models\QuebecLegalAspectAid;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuebecLegalAspectAidDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('city', function($row) {
                return $row->city->name ?? '';
            })
            ->addColumn('image', function($row) {
                return '<img src="' . asset($row->image_path) . '" width="50" height="50" />';
            })
            ->addColumn('action', function($row) {
                return view('quebec.legal-aspects.legal-aids.action', ['row' => $row]);
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(QuebecLegalAspectAid $model): QueryBuilder
    {
        return $model->newQuery()->with('city');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('QuebecLegalAspectAid-table')
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
            Column::make('email'),
            Column::make('city')
            ->title('City')
            ->searchable(true)
            ->orderable(true),
            Column::make('latitude'),
            Column::make('longitude'),
            Column::computed('action')
            ->width(180)
            ->addClass('text-center')
        ];
    }
}
