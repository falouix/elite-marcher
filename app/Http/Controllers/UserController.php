<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\IUserRepository;
use App\Traits\ApiResponser;
use Auth;
use DB;
use Hash;
use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use App\Models\Service;
use App\Common\Utility;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($this->repository->getAllUser());
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $services = Service::select('id','libelle')->get();
        return view('users.create', compact('roles', 'services'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,{$this->user->id},id,deleted_at,NULL',
           // 'qin' => 'unique:users,qin',
           // 'passport' => 'unique:users,passport',
           // 'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $user = $this->repository->create($request->all());
        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
           $notification = $this->notifyArr('Success [create new user]', 'User created successfully!', 'success', false);
        } else {
            $notification =  $this->notifyArr('إضافة مستعمل', '!تم إضافة مستعمل جديد بنجاح', 'success', true);
        }

        return redirect()->route('users.index')
            ->with('notification', $notification);
    }



      /**
     * Process edit ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {

         $user = $this->repository->getUserByParam('id', $id);
        $roles = Role::all();
        $services = Service::select('id','libelle')->get();
        $userRole = $user->roles->pluck('name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $id)
    {
        // Prevent XSS Attack
        Utility::stripXSS($request);

        $this->validate($request, [
            'name' => 'required',
            'user_type' => 'required',
           // 'qin' => 'unique:users,qin,' . $id,
           // 'passport' => 'unique:users,passport,' . $id,
           'email' => "required|email|unique:users,email,{$id},id,deleted_at,NULL"
        ]);
       $user = $this->repository->update($request, $id);
       DB::table('model_has_roles')->where('model_id', $id)->delete();

       $user->assignRole($request->input('roles'));

       $locale = LaravelLocalization::getCurrentLocale();
       if ($locale == 'en') {
          $notification = $this->notifyArr('Success [update user]', 'User updated successfully!', 'success', false);
       } else {
           $notification =  $this->notifyArr('!تعديل بينات المستعمل', '!تم تحيين بيانات المستعمل بنجاح', 'success', true);
       }
       // gestion notifs
       /*
        * Delete all notifs from_table : projet , from_table_id : projet_id
        * Generate new notifs for all future dates
        */

       return redirect()->route('users.index')
           ->with('notification', $notification);
    }

    public function destroy($id)
    {
        // cheeck if user has activities ==> can't delete
        $this->repository->destroy($id);
        $locale = LaravelLocalization::getCurrentLocale();
        if (session()->has('delete_error')) {
            if ($locale == 'en') {
                return $this->notify('Error', 'ِِOnly Users without relations can be deleted', 'error', false);
            } else {
                return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف مستخدم له تسجيلات مرتبطة');
            }
        }
        if ($locale == 'en') {
            return $this->notify('User delete', 'User(s) deleted successfully!', 'success', false);
        }
        return $this->notify('!حذف مستعمل', 'تم حذف المستعمل(ين) بنجاح');
    }
    public function multidestroy(Request $request)
    {
        Log::info($request->ids);
        $this->repository->multiDestroy($request->ids);

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('User delete', ' User(s) deleted successfully!', 'success', false);
        }
        return $this->notify('!حذف مستعمل', 'تم حذف المستعمل(ين) بنجاح');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUserDataTable()
    {
        return $this->repository->getAllUser(Auth()->user());
    }

     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllClientToSelect(Request $request)
    {

        if ($request->ajax()) {
        return ['results' => $this->repository->getAllClientToSelect($request->search)];
        }
    }
     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllLawyerToSelect(Request $request)
    {

        if ($request->ajax()) {
        return ['results' => $this->repository->getAllLawyerToSelect($request->search)];
        }
    }
     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUserByTypeToSelect(Request $request)
    {
        //Log::info($request);
        if ($request->ajax()) {
        return ['results' => $this->repository->getAllUserByTypeToSelect($request->search, $request->type)];
        }
    }

     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserById(Request $request)
    {

       return User::find($request->users_id);
    }


}
