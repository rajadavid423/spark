<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Role');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($data) {
                    return '<a href="' . route('role.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
                })
                ->addColumn('edit', function ($data) {
                    if ($data->name == 'Admin') {
                        return '-';
                    }
                    return '<a href="' . route('role.edit', $data->id) . '"><img src="' . url('images/edit.png') . '"></a>';
                })
                ->addColumn('delete', function ($data) {
                    if ($data->name == 'Admin' || $data->name == 'Employee') {
                        return '-';
                    }
                    return '<a onclick="commonDelete(\'' . route('role.destroy', $data->id) . '\')"><img src="' . url('images/delete.png') . '"></a>';
                })
                ->rawColumns(['view', 'edit', 'delete'])
                ->make(true);
        }

        return view('role.index');
    }

    public function create()
    {
        $role = '';
        $permissions = Permission::all()->groupBy('model');
        return view('role.create', compact('permissions', 'role'));
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request['name']]);
            $role->givePermissionTo([$request['permissions']]);
            DB::commit();

            return redirect()->route("role.index")->with("success", "Role Created Successfully.");

        } catch (\Exception $exception) {
            DB::rollBack();
            info('Error::Place@RoleController@store - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('model');

        return view('role.create', compact('role', 'permissions'));
    }

    public function show(Role $role)
    {
        $permissions = Permission::all()->groupBy('model');

        return view('role.show', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['name']);
            $role->update($input);
            $role->syncPermissions($request['permissions']);
            DB::commit();

            return redirect()->route("role.index")->with("success", "Role Updated Successfully.");

        } catch (\Exception $exception) {
            DB::rollBack();
            info('Place@RoleController@update - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response(['status' => 'warning', 'message' => 'Role Deleted Successfully!']);
        } catch (\Exception $exception) {
            info('Error::Place@RoleController@delete - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }
}
