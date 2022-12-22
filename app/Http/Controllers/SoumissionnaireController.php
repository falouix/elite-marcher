<?php

namespace App\Http\Controllers;

use App\Models\Soumissionnaire;
use App\Notifications\CustomerNotification;
use App\Repositories\Interfaces\ISoumissionnaireRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Str;
use Validator;

class SoumissionnaireController extends Controller
{
    use ApiResponser;
    public function __construct(ISoumissionnaireRepository $repository)
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
        return view('soumissionnaires.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soumissionnaires.create');
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
            'libelle' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'gouvernorat' => 'required',
            'tel_fax' => 'required',
            'email' => 'required',
            'matricule_fiscale' => 'required',
        ]);
        $this->repository->create($request->all());
        return redirect()->route('soumissionnaires.index'); // ->with('notification', $notification)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soumissionnaire = $this->repository->getSoumissionnairetByParam('id', $id);
        return view('soumissionnaires.edit_soumissionnaire', compact('soumissionnaire'));
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
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'gouvernorat' => 'required',
            'tel_fax' => 'required',
            'email' => 'required',
            'matricule_fiscale' => 'required',
        ]);
        $this->repository->update($request, $id);
        return redirect()->route('soumissionnaires.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }

    public function getAllSoumissionnairesDatatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllSoumissionnaires();
        }
    }

    // Gestion du compte fournisseur
    /**
     * Process  ajax request. Create & Activate Customer Account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAccount(Request $request)
    {

        if ($request->ajax()) {
            $client = Soumissionnaire::find($request->clients_id);
            if ($client) {
                $pass = Str::random(8);
                $client->password = Hash::make($pass);
                $client->active = 1;
                $client->save();
                $event = [
                    'full_name' => $client->full_name,
                    'email' => $client->email,
                    'pass' => $pass,
                    'url' => url('/customer/login'),
                ];
                $client->notify(new CustomerNotification($event));
                return $this->notify('!حساب عميل', 'تم تفعيل حساب المزود بنجاح');
            }
            abort(404);
        }
        abort(404);
    }

    /**
     * Process  ajax request. Create & Activate Customer Account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function suspendAccount(Request $request)
    {

        if ($request->ajax()) {
            $client = Soumissionnaire::find($request->clients_id);
            if ($client) {
                $client->active = 0;
                $client->save();
                return $this->notify('!تجميد حساب عميل', 'تم تجميد حساب المزود بنجاح');
            }
            abort(404);
        }
        abort(404);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($client, $pass)
    {
        $url = url('/customer/login');

        return (new MailMessage)
            ->subject(Lang::get('Customer Account Notification'))
            ->line(Lang::get('You are receiving this email because we have created a customer account for you.'))
            ->action(Lang::get('Access to your account'), $url)
            ->line(Lang::get('Your account credentials :'))
            ->line(Lang::get('User') . ': ' . $client->email)
            ->line(Lang::get('Password') . ': ' . $pass);
    }

}
