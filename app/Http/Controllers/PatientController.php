<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Patient;
use App\User;

class PatientController extends Controller
{
    private $action = 'management/patient/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::all();
        return view('patient.tableManage')
        ->with([
            'patients' => $patient
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.form')->with([
            'method' => 'POST',
            'action' => $this->action
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'hn' => 'required|string',
            'dob' => 'required', 'date',
            'gender' => 'required|max:1',
            'card_id' => 'required|string|unique:patients|max:13|min:13',
            'email' => 'required|string|email|max:255|exists:users',
        ]);   

        //user
        $user = User::where('email', $request->input('email'))->first();
        
        // complace age 
        $currentYear = Carbon::now()->format('Y');
        $dobYear = Carbon::parse($request->input('dob'))->format('Y');
        $age = $currentYear - $dobYear;

        $patient = new Patient;
        $patient->firstname = $request->input('firstname');
        $patient->lastname = $request->input('lastname');
        $patient->hn = $request->input('hn');
        $patient->dob = $request->input('dob');
        $patient->age = $age;
        $patient->gender = $request->input('gender');
        $patient->card_id = $request->input('card_id');
        $patient->user_id = $user->user_id;
        $patient->save();

        return redirect($this->action);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            return view('patient.form')->with([
                'method' => 'PUT',
                'action' => $this->action . $id,
                'patient' => $patient
            ]);
        }
        return redirect($this->action);
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
        $patient = Patient::find($id);

        if ($patient) {
            $validator = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'hn' => 'required|string',
                'dob' => 'required', 'date',
                'gender' => 'required|max:1',
                'card_id' => 'required|string|max:13|min:13|unique:patients,card_id,' . $patient->patient_id . ',patient_id',
                'email' => 'required|string|email|max:255|exists:users',
            ]);
            
            //user
            $user = User::where('email', $request->input('email'))->first();
            
            $patient->firstname = $request->input('firstname');
            $patient->lastname = $request->input('lastname');
            $patient->hn = $request->input('hn');
            $patient->dob = $request->input('dob');
            $patient->gender = $request->input('gender');
            $patient->card_id = $request->input('card_id');
            $patient->user_id = $user->user_id;
            $patient->save();
        }

        return redirect($this->action);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return response()->json(['errors' => null]);
        }

        return response()->json(['errors' => 'The selected id is invalid.']);
    }
}
