<?php

namespace App\Repositories;

use App\Models\CaseDocuement;
use App\Models\EventDocuement;
use App\Models\LegalLink;
use App\Models\Poa;
use App\Models\ProsecutionDocuement;
use App\Models\SessionDocuement;
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
            case 'case_documents':
                Log::info($request);
                $fileName = 'case_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.case_documents') . '/' . $request->cases_id . '/';
                $request->file->move(storage_path($path), $fileName);
                // Storage::move($request->file, $fileName);
                return CaseDocuement::create([
                    'file_name' => $request->file_name,
                    'cases_id' => $request->cases_id,
                    'path' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);
                break;

            case 'session_docuements':
                $fileName = 'session_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.case_documents') . '/' . $request->cases_id . '/' .
                $request->case_sessions_id . '/';
                //$path = storage_path('app/documents/' . $file->path);
                $request->file->move(storage_path($path), $fileName);
                return SessionDocuement::create([
                    'file_name' => $request->file_name,
                    'case_sessions_id' => $request->case_sessions_id,
                    'path' => $path . $fileName,
                    'provided_other_party' => $request->provided_other_party,
                    'case_sessions_id' => $request->case_sessions_id,
                    'created_by' => Auth::user()->id,
                ]);
                break;

            case 'prosecution_docuements':
                $fileName = 'prosecution_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.prosecution_docuements') . '/' . $request->prosecutions_id . '/';
                $request->file->move(storage_path($path), $fileName);
                return ProsecutionDocuement::create([
                    'file_name' => $request->file_name,
                    'prosecutions_id' => $request->prosecutions_id,
                    'path' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);
                break;

            case 'event_docuements':
                $fileName = 'event_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.event_docuements') . '/' . $request->event_id . '/';
                $request->file->move(storage_path($path), $fileName);
                return EventDocuement::create([
                    'file_name' => $request->file_name,
                    'event_id' => $request->event_id,
                    'path' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);
                break;
            case 'legal_links':
                $fileName = 'contract_doc_' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.legal_docuements') . '/' . $request->legalLink_id . '/';
                $request->file->move(storage_path($path), $fileName);
                return LegalLink::create([
                    'libelle' => $request->file_name,
                    'description' => $request->description,
                    'url' => $path . $fileName,
                    'created_by' => Auth::user()->id,
                ]);
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
            case 'case_documents':
                // dd(CaseDocuement::select('*')->where('id', $id)->first());
                return CaseDocuement::where('id', $id)->delete();

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
            case 'case_documents':
                // dd(CaseDocuement::select('*')->where('id', $id)->first());
                return CaseDocuement::select('*')->where('id', $id)->first();

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
