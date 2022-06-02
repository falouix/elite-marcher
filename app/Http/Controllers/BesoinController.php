<?php

namespace App\Http\Controllers;

use App\Models\Besoin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IBesoinRepository;
use Log;

class BesoinController extends Controller
{
    public function __construct(IBesoinRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('besoins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('besoins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->createOrUpdate($request->all());
        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $notification = $this->notifyArr('Success [create new Client]', 'Client created successfully!', 'success', false);
        } else {
            $notification = $this->notifyArr('إضافة الحاجيات', '!تم إضافة الحاجيات بنجاح', 'success', true);
        }

        return redirect()->route('clients.index')
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

         return  $this->repository->delete($id);
    }
     //return besoin selected
     public function getBesoinSelected(Request $request)
     {
         $data = Besoin::find($request->id);
         return Response()->json($data);
     }
     //create or update besoin
     public function createOrUpdate(Request $request)
     {
         return $this->repository->createOrUpdate($request);
     }
      /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function getAllBesoinDatatable(Request $request)
     {
        Log::info($request);
         if ($request->ajax())
         {
             return $this->repository->getAllBesoin();
         }
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

}
