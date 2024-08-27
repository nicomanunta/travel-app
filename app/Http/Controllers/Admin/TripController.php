<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::where('user_id', auth()->id())->get();
       
        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= User::all();
        
        return view('admin.trips.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTripRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripRequest $request)
    {
        // Raccogli tutti i dati dal form
    $form_data = $request->all();

    // Crea un nuovo oggetto Trip e assegna i dati
    $trip = new Trip();
    $trip->title = $form_data['trip_title'];
    $trip->description = $form_data['trip_description'];
    $trip->start_date = $form_data['start_date'];
    $trip->end_date = $form_data['end_date'];
    $trip->user_id = auth()->user()->id; // Associa il viaggio all'utente autenticato

    // Gestione dell'immagine di copertina (se presente)
    if ($request->hasFile('cover_image')) {
        $coverImagePath = $request->file('cover_image')->store('cover_images', 'public');
        $trip->cover_image = $coverImagePath;
    }

    // Salva il viaggio nel database
    $trip->save();

    // Salva le giornate del viaggio
    foreach ($form_data['day_title'] as $index => $dayTitle) {
        $day = new Day();
        $day->title = $dayTitle;
        $day->date = $form_data['day_date'][$index];
        $trip->days()->save($day); // Collega la giornata al viaggio

        // Salva le tappe della giornata
        foreach ($form_data['stop_title'] as $stopIndex => $stopTitle) {
            // Esegui solo per le tappe relative alla giornata corrente
            if ($stopIndex == $index) {
                $stop = new Stop();
                $stop->title = $stopTitle;
                $stop->description = $form_data['stop_description'][$stopIndex];
                $stop->food = $form_data['food'][$stopIndex];
                $stop->curiosities = $form_data['curiosities'][$stopIndex];

                // Gestione dell'immagine della tappa (se presente)
                if (isset($form_data['stop_image'][$stopIndex]) && $request->hasFile('stop_image.' . $stopIndex)) {
                    $stopImagePath = $request->file('stop_image.' . $stopIndex)->store('stop_images', 'public');
                    $stop->image = $stopImagePath;
                }

                $day->stops()->save($stop); // Collega la tappa alla giornata

                // Salva la nota e la valutazione se presenti
                if (!empty($form_data['note'][$stopIndex])) {
                    $note = new Note();
                    $note->content = $form_data['note'][$stopIndex];
                    $stop->notes()->save($note); // Collega la nota alla tappa
                }

                if (!empty($form_data['rating'][$stopIndex])) {
                    $rating = new Rating();
                    $rating->value = $form_data['rating'][$stopIndex];
                    $stop->ratings()->save($rating); // Collega la valutazione alla tappa
                }
            }
        }
    }

    // Reindirizza con un messaggio di successo
    return redirect()->route('admin.trips.index')->with('success', 'Viaggio creato con successo!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTripRequest  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
