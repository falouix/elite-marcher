<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poa;
use App\Repositories\IPoaRepository;
use App\Traits\ApiResponser;
use Auth;
use Log;
use Validator;
use PDF;
use File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Services\DataTable;

class PoaController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IPoaRepository $repository)
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
        //dd(File::delete("app/documents/poa_docuements/6/poa_doc_1636649827.png"));
        return view('poas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'poa_file_name' => 'required',
            'poa_expiry_date' => 'required',
            'poa_title' => 'required',
            'clients_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        $this->repository->create( $request);

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('Success [create new consultation]', 'Poa created successfully!', 'success', false);
        }
        return $this->notify('إضافة توكيل', '!تم إضافة توكيل جديد بنجاح', 'success', true);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poa  $Poa
     * @return \Illuminate\Http\Response
     */
    public function show(Poa $Poa)
    {
        $Poa = Poa::find($Poa->id);
        return view('Poas.show', compact('Poa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poa  $Poa
     * @return \Illuminate\Http\Response
     */
    public function print(Poa $Poa)
    {
        $Poa = Poa::find($Poa->id);
        $pdf = PDF::loadView('pdf.consultation', $Poa)->setPaper('a4');
       // return view('pdf.consultation');
        return $pdf->stream('consultation_'.$Poa->conslt_date);

        //return view('Poas.show', compact('Poa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poa  $Poa
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, Poa $Poa)
    {
        if ($request->ajax()) {
        $Poa = Poa::find($Poa->id);
       // $Poa->conslt_date->format('yyyy-MM-dd');

        return response()->json($Poa);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poa  $Poa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info($request);
        if($request->file == 'undefined'){
            $validator = Validator::make($request->all(), [
                'poa_expiry_date' => 'required|date',
                'poa_title' => 'required',
                'clients_id' => 'sometimes|required',
            ]);
        } else{
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                'poa_file_name' => 'required',
                'poa_expiry_date' => 'required|date',
                'poa_title' => 'required',
                'clients_id' => 'sometimes|required',
            ]);
        }

        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
      //  $input = $request->all();

      //  $Poa = Poa::find($id);
        $poa = $this->repository->update($request, $id);
       // $Poa->update($input);
        $locale = LaravelLocalization::getCurrentLocale();
       if ($locale == 'en') {
           return $this->notify('Notification','Power of Attorney updated successfully!', 'success', false);
       }
       return $this->notify('إشعار','تم تعديل بيانات التوكيل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poa  $Poa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
       $locale = LaravelLocalization::getCurrentLocale();
       if ($locale == 'en') {
           return $this->notify('Notification', 'Poa deleted successfully', 'success', false);
       }
       return $this->notify('إشعار', 'تم حذف نوع القضية بنجاح');
    }

    public function multidestroy(Request $request)
    {
        $ids = $request->ids;
       // Log::info(count($request->ids));
        Poa::whereIn('id', $request->ids)->delete();

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('Poa delete', ' Poa deleted successfully!', 'success', false);
        }
        return $this->notify('!حذف توكيل', 'تم حذف توكيل  بنجاح');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPoaDataTable()
    {
        return $this->repository->getAllPoa();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPoaSelect()
    {
        return ['results' =>Poa::select('id','libelle as text')->orderBy('libelle')->get()];
    }

}
