<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Employee');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderByDesc('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('employee_code', function ($data) {
                    return $data->employee_code ?? '-';
                })->editColumn('name', function ($data) {
                    return $data->name ?? '-';
                })->editColumn('phone', function ($data) {
                    return $data->phone ?? '-';
                })->editColumn('dob', function ($data) {
                    return $data->dob ? Carbon::parse($data->dob)->format('d-m-Y') : '-';
                })->editColumn('date_of_joining', function ($data) {
                    return $data->date_of_joining ? Carbon::parse($data->date_of_joining)->format('d-m-Y') : '-';
                })->addColumn('role', function ($data) {
                    return ($data->roles && isset($data->roles[0])) ? $data->roles[0]->name : '-';
                })
                ->addColumn('action', function ($data) {
                    if ($data->email == 'admin@gmail.com') {
                        return '-';
                    }
                    $button = '<div class="d-flex justify-content-center">';
                    $button .= '<a href="' . route('employee.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
                    $button .= '<a href="' . route('employee.edit', $data->id) . '"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
                    $button .= '<a onclick = "commonDelete(\'' . route('employee.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.index');
    }


    public function create()
    {
        $employee = NULL;
        $roles = Role::select('id', 'name')->where('name', '!=', 'Admin')->get();
        $sequenceNo = DB::select('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "users"');
        $sequenceNo = collect($sequenceNo)->pluck('AUTO_INCREMENT')[0];

        if (strlen((string)$sequenceNo) < 2) {
            $sequenceNo = 'EMP00' . $sequenceNo;
        } elseif (strlen((string)$sequenceNo) < 3) {
            $sequenceNo = 'EMP0' . $sequenceNo;
        } else {
            $sequenceNo = 'EMP' . $sequenceNo;
        }

        return view('employee.create', compact('employee', 'roles', 'sequenceNo'));
    }


    public function store(EmployeeRequest $request)
    {
        try {
            $input = $request->all();
            $input['password'] = Hash::make($request['password']);
            $user = User::create($input);
            if ($request->role_id) {
                $user->assignRole($request->role_id);
            }

            return redirect()->route("employee.index")->with("success", "Employee Created Successfully.");
        } catch (Exception $exception) {
            info('Error::Place@EmployeeController@store - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function show(User $employee)
    {
        return view('employee.show', compact('employee'));
    }


    public function edit(User $employee)
    {
        $roles = Role::select('id', 'name')->where('name', '!=', 'Admin')->get();

        return view('employee.create', compact('employee', 'roles'));
    }


    public function update(EmployeeRequest $request, User $employee)
    {
        try {
            $input = $request->except('password');
            if ($request->password) {
                $input['password'] = Hash::make($request->password);
            }
            $employee->update($input);
            if ($request->role_id) {
                DB::table('model_has_roles')->where('model_id', $employee->id)->delete();
                $employee->assignRole($request->role_id);
            }

            return redirect()->route("employee.index")->with("success", "Employee Updated Successfully.");

        } catch (Exception $exception) {
            info('Place@EmployeeController@update - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function destroy(User $employee)
    {
        try {
            $employee->delete();
            return response(['status' => 'warning', 'message' => 'Employee Deleted Successfully.']);
        } catch (Exception $exception) {
            info('Error::Place@EmployeeController@destroy - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }

    public function changePassword()
    {
        return view('employee.change_password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function passwordUpdate(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            DB::commit();
            return redirect()->route('home')->with('success', 'Your Password has changed Successfully...');
        } catch (Exception $exception) {
            DB::rollBack();
            info('Error::Place@EmployeeController@passwordUpdate - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }
}
