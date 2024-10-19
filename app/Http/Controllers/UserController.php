<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = User::orderByDesc('created_at')->get();
//            return DataTables::of($data)
//                ->addIndexColumn()
//                ->editColumn('employee_code', function ($data) {
//                    return $data->employee_code ?? '-';
//                })->editColumn('name', function ($data) {
//                    return $data->name ?? '-';
//                })->editColumn('phone', function ($data) {
//                    return $data->phone ?? '-';
//                })->editColumn('dob', function ($data) {
//                    return $data->dob ? Carbon::parse($data->dob)->format('d-m-Y') : '-';
//                })->editColumn('date_of_joining', function ($data) {
//                    return $data->date_of_joining ? Carbon::parse($data->date_of_joining)->format('d-m-Y') : '-';
//                })->addColumn('role', function ($data) {
//                    return ($data->roles && isset($data->roles[0])) ? $data->roles[0]->name : '-';
//                })
//                ->addColumn('action', function ($data) {
//                    if ($data->email == 'admin@gmail.com') {
//                        return '-';
//                    }
//                    $button = '<div class="d-flex justify-content-center">';
//                    $button .= '<a href="' . route('employee.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
//                    $button .= '<a href="' . route('employee.edit', $data->id) . '"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
//                    $button .= '<a onclick = "commonDelete(\'' . route('employee.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';
//                    $button .= '</div>';
//                    return $button;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//        return view('user.index');
//    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index-service');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
