<?php

namespace App\DataTables;

use App\Models\CityCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CityCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'categories.action')
            ->addColumn('featured_image',function($raw){
                $imagePath = asset($raw->featured_image);
                return '<img src="' . $imagePath . '" width="50" height="50" alt="Image">';
            })
            ->rawColumns(['action','featured_image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CityCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('citycategory-table')
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
            
            Column::make('id')
                ->width(30),
            // Column::make('featured_image'),
            Column::computed('featured_image')
            ->title('Image') 
            ->orderable(false)
            ->searchable(false)
            ->width(190)
            ->addClass('text-center'),
            Column::make('title'),
            Column::make('url'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(80)
                  ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CityCategory_' . date('YmdHis');
    }
}
