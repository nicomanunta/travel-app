<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use App\Models\Day;
use App\Models\Stop;
use App\Models\Note;
use App\Models\Rating;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // Recupera solo i viaggi dell'utente autenticato
        $trips = Trip::where('user_id', auth()->id())->get();

        // Passa la variabile $trips alla vista
        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ottieni l'utente autenticato per associarlo al viaggio
        $users = User::all();
        
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
    $trip->title = $form_data['title'];
    $trip->description = $form_data['description'];
    $trip->start_date = $form_data['start_date'];
    $trip->end_date = $form_data['end_date'];
    $trip->user_id = auth()->user()->id; // Associa il viaggio all'utente autenticato

    // Gestione dell'immagine di copertura (se presente)
    if ($request->hasFile('cover_image')) {
        $coverImagePath = $request->file('cover_image')->store('cover_images', 'public');
        $trip->cover_image = $coverImagePath;
    }

    // Salva il viaggio nel database
    $trip->save();

    // Salva le giornate del viaggio
    foreach ($form_data['day_title'] as $dayIndex => $dayTitle) {
        $day = new Day();
        $day->title = $dayTitle;
        $day->date = $form_data['day_date'][$dayIndex];
        $trip->days()->save($day); // Collega la giornata al viaggio

        // Salva le tappe della giornata
        foreach ($form_data['stop_day_index'][0] as $stopIndex => $stopDayIndex) {
            if ($stopDayIndex == $dayIndex) {
                $stop = new Stop();
                $stop->title = $form_data['stop_title'][0][$stopIndex] ?? null;
                $stop->description = $form_data['stop_description'][0][$stopIndex] ?? null;
                $stop->location = $form_data['location'][0][$stopIndex] ?? null;
                $stop->food = $form_data['food'][0][$stopIndex] ?? null;
                $stop->curiosities = $form_data['curiosities'][0][$stopIndex] ?? null;

                // Gestione dell'immagine della tappa (se presente)
                if (isset($form_data['stop_image'][0][$stopIndex])) {
                    $stopImagePath = $form_data['stop_image'][0][$stopIndex]->store('stop_images', 'public');
                    $stop->image = $stopImagePath;
                }

                $day->stops()->save($stop); // Collega la tappa alla giornata

                // Salva la nota e la valutazione se presenti
                if (!empty($form_data['note'][0][$stopIndex])) {
                    $note = new Note();
                    $note->content = $form_data['note'][0][$stopIndex];
                    $stop->notes()->save($note); // Collega la nota alla tappa
                }

                if (!empty($form_data['rating'][0][$stopIndex])) {
                    $rating = new Rating();
                    $rating->value = $form_data['rating'][0][$stopIndex];
                    $rating->user_id = auth()->user()->id; // Aggiungi l'ID dell'utente
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
        return view('admin.trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $users= User::all();

        
        $trips = Trip::where('user_id', auth()->id())->get(); 
        
        return view('admin.trips.edit', compact('trip'));
        
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
        $form_data = $request->all();

        // Aggiorna i dettagli del viaggio
        $trip->title = $form_data['title'];
        $trip->description = $form_data['description'];
        $trip->start_date = $form_data['start_date'];
        $trip->end_date = $form_data['end_date'];

        // Gestione dell'immagine di copertina (se presente)
        if ($request->hasFile('cover_image')) {
            // Rimuovi l'immagine esistente se ce n'è una
            if ($trip->cover_image) {
                Storage::disk('public')->delete($trip->cover_image);
            }
            $coverImagePath = $request->file('cover_image')->store('cover_images', 'public');
            $trip->cover_image = $coverImagePath;
        }

        $trip->save();

        // Aggiorna le giornate e le tappe (logica non inclusa, dipende dalla struttura del modulo di modifica)

        return redirect()->route('admin.trips.index')->with('success', 'Viaggio aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        // Rimuovi tutte le immagini associate
        if ($trip->cover_image) {
            Storage::disk('public')->delete($trip->cover_image);
        }

        // Rimuovi le giornate, le tappe, le note e le valutazioni
        foreach ($trip->days as $day) {
            foreach ($day->stops as $stop) {
                // Rimuovi le immagini delle tappe
                if ($stop->image) {
                    Storage::disk('public')->delete($stop->image);
                }
                // Rimuovi note e valutazioni
                $stop->notes()->delete();
                $stop->ratings()->delete();
                $stop->delete();
            }
            $day->delete();
        }

        // Rimuovi il viaggio
        $trip->delete();

        return redirect()->route('admin.trips.index')->with('success', 'Viaggio eliminato con successo!');
    }
}
