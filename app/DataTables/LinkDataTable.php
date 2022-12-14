<?php

namespace App\DataTables;

use App\Models\SocialLink;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LinkDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('image', '<img class="img-thumbnail" src="{{$image}}" style="height: 75px; width: 75px;">')
            ->addColumn('action', 'admin.link.parts.action')
            ->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SocialLink $model)
    {
        return $model->newQuery()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('links-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    ['10 صـفوف', '25 صـف', '50 صـف', 'كل الصـفوف']
                ])
            ->parameters([
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json']
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
            Column::make('image')->class('text-center')->title('الصورة'),
            Column::make('link')->class('text-center')->title('الرابط'),
            Column::make('action')->class('text-center')->title('الاجرائات'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Links_' . date('YmdHis');
    }
}
