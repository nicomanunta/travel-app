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
use Illuminate\Http\Request;


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
        
        $users = User::all();
        
        return view('admin.trips.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTripRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
        $trip = new Trip();
        $trip->user_id = auth()->id(); 
        $trip->title = $request->title;
        $trip->description = $request->description;
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
    
        
        if ($request->hasFile('cover_image')) {
            $trip->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }
    
        $trip->save();
    
        foreach ($request->day_title as $dayIndex => $dayTitle) {
            $day = new Day();
            $day->title = $dayTitle;
            $day->date = $request->day_date[$dayIndex];
            $trip->days()->save($day);
    
            if (isset($request->stop_title[$dayIndex])) {
                foreach ($request->stop_title[$dayIndex] as $stopIndex => $stopTitle) {
                    $stop = new Stop();
                    $stop->title = $stopTitle;
                    $stop->description = $request->stop_description[$dayIndex][$stopIndex] ?? null;
                    $stop->location = $request->stop_location[$dayIndex][$stopIndex] ?? null;
    
                    if ($request->hasFile("stop_image.$dayIndex.$stopIndex")) {
                        $stop->image = $request->file("stop_image.$dayIndex.$stopIndex")->store('stop_images', 'public');
                    } else {
                        $stop->image = null;
                    }
    
                    $stop->food = $request->stop_food[$dayIndex][$stopIndex] ?? null;
                    $stop->curiosities = $request->stop_curiosities[$dayIndex][$stopIndex] ?? null;
                    $day->stops()->save($stop);
    
                    if (!empty($request->stop_note[$dayIndex][$stopIndex])) {
                        $note = new Note();
                        $note->content = $request->stop_note[$dayIndex][$stopIndex];
                        $stop->notes()->save($note);
                    }
    
                    if (isset($request->rating[$dayIndex][$stopIndex])) {
                        $rating = new Rating();
                        $rating->user_id = auth()->id(); 
                        $rating->stop_id = $stop->id;
                        $rating->value = $request->rating[$dayIndex][$stopIndex];
                        $rating->save();
                    }
                }
            }
        }
    
        return redirect()->route('admin.trips.index');
    }
    







    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::with('days.stops')->findOrFail($id);
        return response()->json($trip);
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
        
        $validatedData = $request->validated();

        
        $trip->title = $validatedData['title'];
        $trip->description = $validatedData['description'];
        $trip->start_date = $validatedData['start_date'];
        $trip->end_date = $validatedData['end_date'];

        
        if ($request->hasFile('cover_image')) {
            
            if ($trip->cover_image) {
                Storage::disk('public')->delete($trip->cover_image);
            }
            
            $trip->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }

        $trip->save();

        
        $trip->days()->delete(); 

        foreach ($validatedData['days'] as $dayData) {
            $day = new Day();
            $day->title = $dayData['title'];
            $day->date = $dayData['date'];
            $trip->days()->save($day);

            if (isset($dayData['stops'])) {
                foreach ($dayData['stops'] as $stopData) {
                    $stop = new Stop();
                    $stop->title = $stopData['title'];
                    $stop->description = $stopData['description'];
                    $stop->location = $stopData['location'];

                    
                    if ($request->hasFile("stop_image.{$dayData['id']}.{$stopData['id']}")) {
                    
                        if ($stop->image) {
                            Storage::disk('public')->delete($stop->image);
                        }
                        
                        $stop->image = $request->file("stop_image.{$dayData['id']}.{$stopData['id']}")->store('stop_images', 'public');
                    } else {
                        $stop->image = $stopData['image'] ?? null;
                    }

                    $stop->food = $stopData['food'] ?? null;
                    $stop->curiosities = $stopData['curiosities'] ?? null;
                    $day->stops()->save($stop);

                    if (isset($stopData['notes'])) {
                        foreach ($stopData['notes'] as $noteData) {
                            $note = new Note();
                            $note->content = $noteData['content'];
                            $stop->notes()->save($note);
                        }
                    }

                    if (isset($stopData['ratings'])) {
                        foreach ($stopData['ratings'] as $userId => $ratingValue) {
                            $rating = Rating::updateOrCreate(
                                ['stop_id' => $stop->id, 'user_id' => $userId],
                                ['value' => $ratingValue]
                            );
                        }
                    }
                }
            }
        }

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
        
        if ($trip->cover_image) {
            Storage::disk('public')->delete($trip->cover_image);
        }

        
        foreach ($trip->days as $day) {
            foreach ($day->stops as $stop) {
                if ($stop->image) {
                    Storage::disk('public')->delete($stop->image);
                }
                $stop->notes()->delete();
                $stop->ratings()->delete();
                $stop->delete();
            }
            $day->delete();
        }

        
        $trip->delete();

        return redirect()->route('admin.trips.index')->with('success', 'Viaggio eliminato con successo!');
    }
}