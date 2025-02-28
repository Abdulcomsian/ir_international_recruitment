<?php

namespace App\DataTables;

use App\Models\CultureOverview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CultureOverviewDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'quebec.culture.quiz.overview.action')
            ->addColumn('cultureQuiz',function($row){
                return $row->quiz->title ?? 'N/A';
            })
            ->rawColumns(['action','description'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CultureOverview $model): QueryBuilder
    {
        // return $model->newQuery();
        return $model->newQuery()->where('culture_quiz_id', $this->quizId);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cultureoverview-table')
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
         
            Column::make('id')
                ->width(20),
            Column::make('cultureQuiz')->title('CultureQuiz'),
            Column::make('title_question'),
            // Column::make('description'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(170)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CultureOverview_' . date('YmdHis');
    }
}
