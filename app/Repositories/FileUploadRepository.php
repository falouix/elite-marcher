<?php

namespace App\Repositories;

use App\Models\LignesBesoin;
use App\Models\BesoinsDoc;
use App\Models\UserDocuement;
use Auth;
use Config;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Log;

// Import Facade Hash to Encrypt password

class FileUploadRepository implements IFileUploadRepository
{

    public function fileUploadPost($request)
    {

        /* Store $fileName name in DATABASE from HERE */
        switch ($request->path) {
            case 'user_documents':

                $fileName = 'user_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.user_documents') . '/' . $request->user_id . '/';
                $request->file->move(storage_path($path), $fileName);
                return UserDocuement::create([
                    'file_name' => $request->file_name,
                    'user_id' => $request->user_id,
                    'path' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);

                break;
            case 'besoin_documents':
                Log::info($request);
                $fileName = 'besoin_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.besoin_documents') . '/' . $request->besoins_id . '/';
                $request->file->move(storage_path($path), $fileName);
                // Storage::move($request->file, $fileName);
                $besoinsDoc =  BesoinsDoc::create([
                    'file_name' => $request->file_name,
                    'besoins_id' => $request->besoins_id,
                    'path' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);
                if($besoinsDoc){
                    LignesBesoin::find( $besoinsDoc->besoins_id)->update([
                        'docs_id'=>$besoinsDoc->id
                    ]);
                }
                return $besoinsDoc;

                break;
        }
    }
    public function fileUploadDelete($path)
    {
        //storage_path('case_documents').'/1/case_doc_1635976339.pdf'
        return File::delete(storage_path($path));
    }
    public function deleteRecordByFileType($id, $param)
    {
        /* Return Docuements DataTable */
        switch ($param) {
            case 'user_documents':
                return UserDocuement::where('id', $id)->delete();

                break;
            case 'besoin_documents':
                // dd(CaseDocuement::select('*')->where('id', $id)->first());

                 $besoisdoc = BesoinsDoc::where('id', $id)->delete();
                 LignesBesoin::where('docs_id', $id)->update([
                    'docs_id'=>NULL
                ]);
                return $besoisdoc;

                break;
            case 'session_docuements':
                return SessionDocuement::where('id', $id)->delete();

                break;
            case 'prosecution_docuements':
                return ProsecutionDocuement::where('id', $id)->delete();

                break;
            case 'event_docuements':
                return EventDocuement::where('id', $id)->delete();

                break;
            case 'poa_docuements':
                return Poa::where('id', $id)->delete();
                break;
            case 'legal_links':
                return LegalLink::where('id', $id)->delete();
                break;
        }
    }

    // return datatable by Type docs (user_docs, case_docs...)
    public function getAllFilesByType($id, $param = "user_documents", $permission ="all")
    {
        /* Return Docuements DataTable */
        switch ($param) {
            case 'user_documents':
                $query = UserDocuement::select('*')->where('user_id', $id);
                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })

                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', 'files.user-doc-upload.datatable-actions')

                    ->rawColumns(['id', 'action'])

                    ->make(true);
                break;
            case 'case_documents':
                $file_permission = "files.user-docs";
                if($permission == "customer" ){
                    $file_permission = "files.customer-docs";
                }
                $query = CaseDocuement::select('*')->where('cases_id', $id);

                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })

                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', $file_permission)

                    ->rawColumns(['id', 'action'])

                    ->make(true);

                break;
            case 'session_docuements':
                $query = SessionDocuement::select('*')->where('case_sessions_id', $id);
                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })

                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', 'files.session-docs')

                    ->rawColumns(['id', 'action'])

                    ->make(true);

                break;
            case 'prosecution_docuements':
                $query = ProsecutionDocuement::select('*')->where('prosecutions_id', $id);
                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })

                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', 'files.user-doc-upload.datatable-actions')

                    ->rawColumns(['id', 'action'])

                    ->make(true);

                break;
            case 'event_docuements':
                $query = EventDocuement::select('*')->where('event_id', $id);
                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })

                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', 'files.user-doc-upload.datatable-actions')

                    ->rawColumns(['id', 'action'])

                    ->make(true);

                break;

            case 'poa_docuements':
                return null;
                break;
            case 'legal_links':
                $query = LegaLink::select('*')->where('event_id', $id);
                return datatables()
                    ->of($query)
                    ->editColumn('created_at', function ($consultation) {
                        return $consultation->created_at->format('Y-m-d');
                    })
                    ->addColumn('select', static function () {
                        return null;
                    })
                    ->addColumn('action', 'files.legal-doc-upload.datatable-actions')
                    ->rawColumns(['id', 'action'])
                    ->make(true);

                break;
        }
    }

    // return datatable by Type docs (user_docs, case_docs...)
    public function getFileByPath($file)
    {
        //This method will look for the file and get it from drive
        $path = storage_path('app/documents/' . $file);
        try {
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;

        } catch (FileNotFoundException $exception) {
            abort(404);
        }
    }
    public function getfileById($id, $param)
    { //dd($param);

        /* Return Docuements DataTable */
        switch ($param) {
            case 'user_documents':
                return UserDocuement::select('*')->where('id', $id)->first();

                break;
            case 'besoin_documents':
                // dd(CaseDocuement::select('*')->where('id', $id)->first());
                return BesoinsDoc::select('*')->where('id', $id)->first();

                break;
            case 'session_docuements':

                return SessionDocuement::select('*')->where('id', $id)->first();

                break;
            case 'prosecution_docuements':
                return ProsecutionDocuement::select('*')->where('id', $id)->first();

                break;
            case 'event_docuements':
                return EventDocuement::select('*')->where('id', $id)->first();

                break;
            case 'poa_docuements':
                return Poa::select('*')->where('id', $id)->first();
                break;
                break;
            case 'legal_links':
                return LegalLink::select('*')->where('id', $id)->first();
                break;
        }
    }
}
