<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\EducationProgramsDetail;
use Yajra\DataTables\EloquentDataTable;
use App\Models\EducationProgramsDetails;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class EducationProgramDetailsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'educationprogramdetails.action')
            ->addColumn('title', function ($row) {
                return $row->educationProgram->title ?? 'N/A';
            })
            ->rawColumns(['about','campus','additional_program','research','student_life','action']) // Add the columns to be rendered as raw HTML
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EducationProgramsDetails $model): QueryBuilder
    {
        return $model->newQuery()->with('educationProgram');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('educationprogramdetails-table')
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
            // Column::make('eduction_programs_id'),
            Column::make('title')->title('University'),
            Column::make('address'),
            Column::make('about'),
            Column::make('campus'),
            Column::make('faculties'),
            Column::make('additional_program'),
            Column::make('research'),
            Column::make('student_life'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
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
        return 'EducationProgramDetails_' . date('YmdHis');
    }
}
