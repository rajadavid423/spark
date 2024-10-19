<?php

namespace App\Http\Controllers;

use App\DataTables\SaleDataTable;
use App\DataTables\EmployeeDataTable;
use Illuminate\Http\Response;

class YajraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function saleYajra(SaleDataTable $dataTable)
    {
        return $dataTable->render('sale.index-yajra-service');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function employeeYajra(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('employee.index-yajra-service');
    }
}
