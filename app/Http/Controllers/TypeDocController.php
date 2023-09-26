<?php

namespace App\Http\Controllers;

use App\Models\TypesDoc;
use App\Models\Notif;
use App\Repositories\Interfaces\ITypesDocRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Log;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Common\Utility;

class TypeDocController extends Controller
{
    use ApiResponser;
    private $newNotif;
    public function __construct( ITypesDocRepository $repository)
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
        return view('types_docs.index');
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
        Log::alert("TypesDocs store request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:types_docs,libelle',
        ]);
        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        TypesDoc::create([
            'libelle' => $request->libelle,
            'type_doc' => $request->type_doc,
        ]);
        return $this->notify('أنواع الوثائق', 'تم إضافة نوع وثيقة جديدة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        Log::info("TypesDoc edit id ===> " . $id);
        if ($request->ajax()) {
            $TypesDoc = TypesDoc::find($id);
            Log::info("TypesDoc edit details ===> " . $TypesDoc);
            return response()->json($TypesDoc);
        }
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
        \Log::alert("Update TypesDoc from view ".$request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:types_docs,libelle,' . $id,
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
        TypesDoc::find($id)->update([
            'libelle' => $request->libelle,
            'type_doc' => $request->type_doc,
        ]);
        return $this->notify('أنواع الوثائق ', 'تم تحيين نوع الوثيقة بنجاح');
    }
    /**
     * Update the specified resource in storage. : Valider TypesDoc
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function destroy($id)
    {
        $this->repository->destroy($id);
        if (session()->has('delete_error')) {
            return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف مادة لها تسجيلات مرتبطة','error');
        }
        return $this->notify('حذف المواد أو الطلبات ', 'تم حذف المادة بنجاح');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTypeDocsDatatable(Request $request)
    {
        Log::alert("TypesDocs Request from view");
        if ($request->ajax()) {
            return $this->repository->getAllTypesDoc();
        }

    }
}
