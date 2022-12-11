<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use DB;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Common\Utility;

class RoleController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);

        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // Prevent XSS Attack
         Utility::stripXSS($request);
        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $permission = Permission::get()->groupBy('table_name_en');
        } else {
            $permission = Permission::get()->groupBy('table_name_ar');
        }
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Prevent XSS Attack
        Utility::stripXSS($request);

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
           // 'name_ar' => 'required|unique:roles,name_ar',
            'permission' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'name_ar' => $request->input('name'),
        ]);
        $role->syncPermissions($request->input('permission'));

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $notification = $this->notifyArr('Success [ِCreate Permissions]', 'ٌPermissions Added successfully!', 'success', false);
        } else {
            $notification = $this->notifyArr('إضافة صلاحيات', '!تم إضافة الصلاحيات بنجاح', 'success', true);
        }
        return redirect()->route('roles.index')
            ->with('notification', $notification);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $locale = LaravelLocalization::getCurrentLocale();
        $role = Role::find($id);
        if ($locale == 'en') {
            $permission = Permission::get()->groupBy('table_name_en');
        } else {
            $permission = Permission::get()->groupBy('table_name_ar');
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        // ->groupBy('account_id')
            ->all();
        //dd($permission);

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
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
        // Prevent XSS Attack
        Utility::stripXSS($request);

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->name_ar = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $notification = $this->notifyArr('Success [Update Permissions]', 'ٌPermissions updated successfully!', 'success', false);
        } else {
            $notification = $this->notifyArr('إضافة مستعمل', '!تم تعديل الصلاحيات بنجاح', 'success', true);
        }
        return redirect()->route('roles.index')
            ->with('notification', $notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
