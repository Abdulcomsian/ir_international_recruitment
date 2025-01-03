<?php

namespace App\DataTables;

use App\Models\EductionProgram;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EductionProgramDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'EductionalPrograms.action')
            ->addColumn('university_type_name', function($raw){
                return ucfirst($raw->university_type) ?? '';
            })
            ->filterColumn('university_type_name', function ($query, $keyword) {
                $query->where('university_type', 'like', "%{$keyword}%");
            })
            ->addColumn('city_name', function($raw){
                return $raw->city->name ?? '';
            })
            ->addColumn('image',function($raw){
                $imagePath = asset($raw->featured_image);
                return '<img src="' . $imagePath . '" width="50" height="50" alt="Image">';

            })
            ->rawColumns(['action','image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EductionProgram $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('eductionprogram-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('id')->width(20),
            Column::computed('image')
            ->title('Image')
            ->orderable(false)
            ->searchable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('title')->title('Name'),
            Column::computed('university_type_name', 'university_type')
            ->title('University Type')
            ->orderable(true)
            ->searchable(true)
            ->width(160),
            Column::computed('city_name','city.name')
            ->title('City')
            ->orderable(true)
            ->searchable(true)
            ->width(170)
            ->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(110)
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
        return 'EductionProgram_' . date('YmdHis');
    }
}
