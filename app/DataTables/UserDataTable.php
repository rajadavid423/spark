<?php

namespace App\DataTables;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('customer', function ($data) {
                return $data->customer->name ?? '-';
            })->addColumn('action', '<button>Delete</button>')
            ->with([
                'total_sale_amount' => number_format(round($query->sum('total_amount'),2),2),
                'total_pending_amount' => number_format(round($query->sum('pending_amount'),2),2),
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Sale $model
     * @return Builder
     */
    public function query(Sale $model)
    {
        return $model->with('customer')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )->parameters([
                        'footerCallback' => "function () {
                    var api = this.api();
                    console.log(api)
                    var json = api.ajax.json();
                    console.log(json)

                    // converting to integer to find total
                    var intVal = function (i) {
                        return typeof i === 'string' ? (i.replace(/[\$,]/g, '') * 1) : (typeof i === 'number' ? i : 0);
                    };

                    // computing column Total of the complete result
                    var currentPageInvoiceAmount = api.column(3).data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var currentPagePendingAmount = api.column(4).data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $(api.column(2).footer()).html('Total');
                    $(api.column(3).footer()).html((currentPageInvoiceAmount).toFixed(2) + ' of ' + json.total_sale_amount);
                    $(api.column(4).footer()).html((currentPagePendingAmount).toFixed(2) + ' of ' + json.total_pending_amount);
                }"]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('invoice_number'),
            Column::make('customer'),
            Column::make('total_amount'),
            Column::make('pending_amount'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
