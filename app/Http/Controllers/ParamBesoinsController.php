<?php

namespace App\Http\Controllers;

use App\Models\BesoinsParam;
use App\Repositories\Interfaces\IParamBesoinsRepository;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Log;
use Auth;
use Validator;
use App\Common\Utility;

class ParamBesoinsController extends Controller
{
     use ApiResponser;
        public function __construct(IParamBesoinsRepository $repository)
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
            return view('param_besoins.index');
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
            Log::alert("ParamBesoins store request");
            Log::info($request);
            $validator = Validator::make($request->all(), [
                'annee_gestion' => 'required|unique:besoins_params,annee_gestion',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ]);
            if ($validator->fails()) {
                Log::critical($validator->errors());
                return $this->error($validator->errors(), 403);
            }
            $this->repository->create($request);
            return $this->notify('إعدادات ضبط الحاجيات', 'تم تحديد آجال ضبط الحاجيات بنجاح ');
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function edit(Request $request, $id)
        {
            Log::info("BesoinsParam edit id ===> " . $id);
            if ($request->ajax()) {
                $param = BesoinsParam::find($id);
                Log::info("BesoinsParam edit details ===> " . $param);
                return response()->json($param);
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
            \Log::alert("Update BesoinsParam from view ".$request);
            $validator = Validator::make($request->all(), [
                'annee_gestion' => 'required|unique:besoins_params,annee_gestion,' . $id,
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ]);
            if ($validator->fails()) {
                return $this->error($validator->errors(), 403);
            }
            $this->repository-> update($request, $id);

            return $this->notify('إعدادات ضبط الحاجيات', 'تم تحيين آجال ضبط الحاجيات بنجاح ');
        }
        public function destroy($id)
        {
            $this->repository->destroy($id);
            if (session()->has('delete_error')) {
                return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف مادة لها تسجيلات مرتبطة','error');
            }
            return $this->notify('حذف ', 'تم حذف المادة بنجاح');
        }
        /**
         * Process datatables ajax request.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function getAllParamBesoinsDatatable(Request $request)
        {
            Log::alert("ParamBesoins Request from view");
            Log::info($request);
            if ($request->ajax()) {
                return $this->repository->getAllBesoinsParam();
            }

        }
}
