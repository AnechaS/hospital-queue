<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Station;
use App\Models\Visit;
use App\Models\Patient;

class VisitController extends Controller
{
    private $action = '/management/visit/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visit = Visit::orderBy('date', 'desc')->orderBy('visit_order', 'desc')->get();
        return view('visit.tableManage')->with([
            'visits' => $visit
        ]);
    }

    public function dashboard()
    {
        // station
        $station = Station::all();
        // patient
        $patient = Patient::all();

        return view('visit.dashboard')->with([
            'stations' => $station,
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
        return view('visit.form')->with([
            'method' => 'POST',
            'action' => 'visit',
            'stations' => Station::all(),
        ]);
    }

    public function validCreate($parame)
    {   
        $query = DB::table('visits')
        ->join('patients', 'visits.user_id', '=', 'patients.user_id')
        ->where([
            'patients.card_id' => $parame['card_id'],
            'visits.finish' => 0
        ])
        ->whereDate('visits.date', $parame['date'])
        ->count();

        if ($query) {
            return true;
        }

        return false;
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
            'card_id' => 'required|string|max:13|exists:patients',
            'station_id' => 'required|exists:stations',
            'date' => [
                'required', 
                'date', 
                function ($attribute, $value, $fail) {
                    if ($value < Carbon::today()->toDateString()) {
                        $fail($attribute.' is invalid.');
                    }
                },
            ]
        ]);        
        
        // valid create visit
        $errors = new MessageBag();
        $validCreate = $this->validCreate([
            'card_id' => $request->input('card_id'),
            'date' => $request->input('date')
        ]);

        if ($validCreate) {
            $errors->add('card_id', 'this card_id exist');
            return back()->withErrors($errors)->withInput();
        }

        // user
        $patient = Patient::where([
            'card_id' => $request->input('card_id')
        ])
        ->first();
        // station
        $station = Station::find($request->input('station_id'));
        
        $visitOrder = Visit::where([
            'station_id'=> $request->input('station_id'),
        ])
        ->whereDate('date', $request->input('date'))
        ->orderBy('visit_order', 'desc')
        ->first();
        
        // generator visit order
        $order = 1;

        if ($visitOrder !== null) {
            $order += $visitOrder->visit_order;
        }    

        // check reservetion
        $reser = 0;
        if ($request->input('date') > Carbon::today()->toDateString()) {
            $reser = 1;
        }

        $visit = new Visit;
        $visit->visit_order =  $order;
        $visit->user_id = $patient->user->user_id;
        $visit->station_id = $station->station_id;
        $visit->finish = 0;
        $visit->reser = $reser;
        $visit->date = $request->input('date');
        $visit->save();

        return redirect('visit/history/' . $patient->user->user_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // station
    }
    
    public function show_queue($sid, $date = null)
    {
        if (!$date) {
            $date = Carbon::today()->toDateString();
        }
        // station
        $station = Station::find($sid);        
        if ($station) {
            // visit
            $visit = Visit::where([
                'station_id' => $sid,
                'finish' => 0
            ])
            ->whereDate('date', $date)
            ->orderBy('visit_order', 'asc');

            $is_today = $date == Carbon::today()->toDateString();

            return view('visit.queue')->with([
                'station' => $station,
                'visitCount' => $visit->count(),
                'visits' => $visit->get(),
                'today' => $is_today,
                'date' => $date,
                'url' => url('queue/'.$sid)
            ]);
        }
        return redirect('/');
    }


    public function history($id)
    {
        $visits = Visit::where([
            'user_id' => $id,
        ])
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        if ($visits) {
            $patient = Patient::where('user_id', $id)->first();
            return view('visit.history')
            ->with([
                'visits' => $visits,
                'patient' => $patient
            ]);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::find($id);
        if ($visit) {
            return view('visit.formEdit')->with([
                'method' => 'PUT',
                'action' => $this->action . $id,
                'visit' => $visit,
                'stations' => Station::all(),
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
        $visit = Visit::find($id);
        if ($visit) {
            $validator = $request->validate([
                'station_id' => 'required|exists:stations',
                'date' => [
                    'required', 
                    'date', 
                    function ($attribute, $value, $fail) {
                        if ($value < Carbon::today()->toDateString()) {
                            $fail($attribute.' is invalid.');
                        }
                    },
                ]
            ]);

            // check reservetion
            $reser = 0;
            if ($request->input('date') > Carbon::today()->toDateString()) {
                $reser = 1;
            }

            $visit->station_id = $request->input('station_id');
            $visit->date = $request->input('date');
            $visit->reser = $reser;
            $visit->save();
        }
        return redirect($this->action);
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:visits,visit_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $visit = Visit::find($request->input('id'));
        $visit->finish = 1;
        $visit->save();

        return response()->json(['errors' => null]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visit = Visit::find($id);
        if ($visit) {
            $visit->delete();
            return response()->json(['errors' => null]);
        }


        return response()->json(['errors' => 'The selected id is invalid.']);
    }
}
