<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $builder; // for server side implementation not in use

    public function __construct()
    {
        $this->middleware('is_super_admin');
    }

    /*
     * Not is use
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users')->make(true);
    }

    /*
     * Not in use
     */
    public function usingBuilder(UserDataTable $dataTable)
    {
        return $dataTable->render('users')->make(true);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getDataTable()
    {
        return view('datatables.users');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUserData()
    {
        $users = User::query()->with('roles')->where('is_deleted', 0)->where('role_id', '!=', Role::SUPER_ADMIN);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
<a href="javascript:void(0)" class="btn btn-xs btn-danger btn-delete" data-remote="' . route('users.destroy', $user->id) . '" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->addColumn('roles', function (User $user) {
                return $user->roles->role_name;
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = User::where('is_deleted', 0)->where('id', $id)->first();
            if (empty($user)) {
                throw new \Exception('User does not exist.');
            }
            $user->updated_at = date('Y-m-d H:i:s');
            $user->is_deleted = 1;
            if ($user->save()) {
                Session::flash('message', 'User deleted successfully');
            }
            return redirect()->route('users.listing');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $data = User::where('id', $id)->where('is_deleted', 0)->first();
        }
        return view('auth.register')->with('data', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        if (!$request->password) {
            unset($rule['password']);
        }
        $request->validate($rule);
        try {
            $user = User::where('is_deleted', 0)->find($id);
            if (empty($user)) {
                throw new \Exception('User does not exist.');
            }
            $user->updated_at = date('Y-m-d H:i:s');
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->role_id = $request->role_id;
            if ($user->save()) {
                Session::flash('message', 'User Updated Successfully');
            }
            return redirect()->route('users.listing');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::CSV);
    }

}
