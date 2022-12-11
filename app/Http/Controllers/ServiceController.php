<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Interfaces\IServiceRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Log;
use Validator;

class ServiceController extends Controller
{
    use ApiResponser;
    public function __construct(IServiceRepository $repository)
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
        return view('services.index');
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
        Log::alert("Service store request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:services,libelle',
            'contact' => 'required',
            'responsable' => 'required',
        ]);

        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        $this->repository->create($request->all());
        return $this->notify('المصالح/الداوئر أو المؤسسات', 'تم إضافة مصلحة/دائرة أو مؤسسة جديدة بنجاح');
    }

    public function edit(Request $request, $id)
    {
        Log::info("Service edit id ===> " . $id);
        if ($request->ajax()) {
            $service = Service::find($id);
            return response()->json($service);
        }
    }

    public function update(Request $request, $id)
    {
         // Prevent XSS Attack
         Utility::stripXSS($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:services,libelle,' . $id,
            'contact' => 'required',
            'responsable' => 'required',
        ]);
        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        $this->repository->update($request, $id);
        return $this->notify('المصالح/الداوئر أو المؤسسات', 'تم تحيين مصلحة/دائرة أو مؤسسة  بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        if (session()->has('delete_error')) {

            return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف  مصلحة/دائرة أو مؤسسة لها تسجيلات مرتبطة', 'error');
        }
        return $this->notify('حذف  مصلحة/دائرة أو مؤسسة', 'تم حذف  مصلحة/دائرة أو مؤسسة بنجاح');
    }

    public function getAllServicesDatatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllServices();
        }
    }
}
