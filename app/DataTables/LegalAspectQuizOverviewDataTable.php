<?php

namespace App\DataTables;

use App\Models\LegalAspectQuizOverview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LegalAspectQuizOverviewDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row) {
            return view('quebec.legal-aspects.quiz.overview.action', ['row' => $row]);
        })
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
    public function query(LegalAspectQuizOverview $model): QueryBuilder
    {
        return $model->newQuery()->where('legal_aspect_quiz_categories_id', $this->overview);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('legalaspectquizoverview-table')
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
            Column::make('id'),
            Column::computed('featured_image')
            ->title('Image')
            ->orderable(false)
            ->searchable(false)
            ->width(100)
            ->addClass('text-center'),
            Column::make('title_question'),
            Column::make('description'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LegalAspectQuizOverview_' . date('YmdHis');
    }
}
