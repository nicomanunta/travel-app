@extends('layouts.style')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 ">
            <h1 class="text-uppercase font-archivo h1-title color-purple text-center mt-3">Crea un nuovo Viaggio</h1>
        </div>
        <div class="col-12">
            <form action="{{route('admin.trips.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- campi tabella Trips -->
                <div class="form-group my-3">
                    <label for="title" class="label-trip text-first mb-1">Titolo del Viaggio</label>
                    <input class="form-control input-trip" type="text" name="title" id="title" placeholder="Titolo" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group my-3">
                    <label for="description" class="label-trip text-first mb-1">Descrizione</label>
                    <textarea class="form-control input-trip" name="description" id="description" placeholder="Descrizione">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="start_date" class="label-trip text-first mb-1">Data Inizio</label>
                        <input type="date" name="start_date" class="form-control input-trip" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="end_date" class="label-trip text-first mb-1">Data Fine</label>
                        <input type="date" name="end_date" class="form-control input-trip" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group my-3">
                    <label for="cover_image" class="label-trip text-first mb-1">Immagine di Copertina</label>
                    <input type="file" name="cover_image" class="form-control-file">
                    @error('cover_image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-- container  giornate  -->
                <h3 class="mt-4">Giornata del Viaggio</h3>
                <div id="days-container">
                    
                    <div class="day-entry">
                        <div class="form-group my-3">
                            <label for="day_title[0]" class="label-trip text-first mb-1">Titolo Giornata</label>
                            <input type="text" name="day_title[0]" class="form-control" placeholder="Titolo Giornata">
                        </div>
                        <div class="form-group my-3">
                            <label for="day_date[0]" class="label-trip text-first mb-1">Data Giornata</label>
                            <input type="date" name="day_date[0]" class="form-control">
                        </div>
                        <!-- container tappe di questa giornata -->
                        <h3 class="mt-4">Tappa della Giornata</h3>
                        <div class="stops-container">
                    
                            <div class="stop-entry">
                                <div class="form-group my-3">
                                    <label for="stop_title[0][0]" class="label-trip text-first mb-1">Titolo Tappa</label>
                                    <input type="text" name="stop_title[0][0]" class="form-control" placeholder="Titolo Tappa">
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_description[0][0]" class="label-trip text-first mb-1">Descrizione</label>
                                    <textarea name="stop_description[0][0]" class="form-control" placeholder="Descrizione"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_location[0][0]" class="label-trip text-first mb-1">Luogo</label>
                                    <input type="text" name="stop_location[0][0]" class="form-control" placeholder="Luogo">
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_image[0][0]" class="label-trip text-first mb-1">Immagine</label>
                                    <input type="file" name="stop_image[0][0]" class="form-control-file">
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_food[0][0]" class="label-trip text-first mb-1">Cibo</label>
                                    <textarea name="stop_food[0][0]" class="form-control" placeholder="Cibo"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_curiosities[0][0]" class="label-trip text-first mb-1">Curiosità</label>
                                    <textarea name="stop_curiosities[0][0]" class="form-control" placeholder="Curiosità"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <label for="stop_note[0][0]" class="label-trip text-first mb-1">Note</label>
                                    <textarea name="stop_note[0][0]" class="form-control" placeholder="Note"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="rating[0][0]" class="label-trip text-first mb-1">Valutazione (1-5)</label>
                                    <select class="form-control @error('rating.*') is-invalid @enderror" name="rating[0][0]">
                                        <option value="1" {{ old('rating.0.0') == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('rating.0.0') == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('rating.0.0') == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('rating.0.0') == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('rating.0.0') == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                    @error('rating.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="add-stop-btn btn btn-blue my-2">Aggiungi Tappa</button>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-2 mb-4">
                    <button type="button" id="add-day-button" class="btn btn-blue ">Aggiungi Giornata</button>
                    <button type="submit" class="btn btn-green">Salva Viaggio</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let dayIndex = 0;
        let stopIndex = {0: 0}; 
    
        document.getElementById('add-day-button').addEventListener('click', function() {
            dayIndex++;
            stopIndex[dayIndex] = 0;
            let newDay = document.createElement('div');
            newDay.classList.add('day-entry');
            newDay.innerHTML = `
            <h3 class="mt-4">Giornata del Viaggio</h3>
                <div class="form-group my-3">
                    <label for="day_title[${dayIndex}]" class="label-trip text-first mb-1">Titolo Giornata</label>
                    <input type="text" name="day_title[${dayIndex}]" class="form-control" placeholder="Titolo Giornata">
                </div>
                <div class="form-group my-3">
                    <label for="day_date[${dayIndex}]" class="label-trip text-first mb-1">Data Giornata</label>
                    <input type="date" name="day_date[${dayIndex}]" class="form-control">
                </div>
                <div class="stops-container"></div>
                <button type="button" class="add-stop-btn btn btn-secondary my-2">Aggiungi Tappa</button>
            `;
            document.getElementById('days-container').appendChild(newDay);
    
            newDay.querySelector('.add-stop-btn').addEventListener('click', function() {
                addStop(dayIndex);
            });
        });
    
        function addStop(dayIndex) {
            stopIndex[dayIndex]++;
            let stopsContainer = document.querySelector(`.day-entry:nth-of-type(${dayIndex + 1}) .stops-container`);
            let newStop = document.createElement('div');
            newStop.classList.add('stop-entry');
            newStop.innerHTML = `
            <h3 class="mt-4">Tappa della Giornata</h3>
                <div class="form-group my-3">
                    <label for="stop_title[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Titolo Tappa</label>
                    <input type="text" name="stop_title[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Titolo Tappa">
                </div>
                <div class="form-group my-3">
                    <label for="stop_description[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Descrizione</label>
                    <textarea name="stop_description[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Descrizione"></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="stop_location[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Luogo</label>
                    <input type="text" name="stop_location[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Luogo">
                </div>
                <div class="form-group my-3">
                    <label for="stop_image[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Immagine</label>
                    <input type="file" name="stop_image[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control-file">
                </div>
                <div class="form-group my-3">
                    <label for="stop_food[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Cibo</label>
                    <textarea name="stop_food[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Cibo"></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="stop_curiosities[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Curiosità</label>
                    <textarea name="stop_curiosities[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Curiosità"></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="stop_note[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Note</label>
                    <textarea name="stop_note[${dayIndex}][${stopIndex[dayIndex]}]" class="form-control" placeholder="Note"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="rating[${dayIndex}][${stopIndex[dayIndex]}]" class="label-trip text-first mb-1">Valutazione (1-5)</label>
                    <select class="form-control @error('rating.*') is-invalid @enderror" name="rating[${dayIndex}][${stopIndex[dayIndex]}]">
                        <option value="1" {{ old('rating.${dayIndex}.${stopIndex[dayIndex]}') == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ old('rating.${dayIndex}.${stopIndex[dayIndex]}') == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ old('rating.${dayIndex}.${stopIndex[dayIndex]}') == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ old('rating.${dayIndex}.${stopIndex[dayIndex]}') == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ old('rating.${dayIndex}.${stopIndex[dayIndex]}') == 5 ? 'selected' : '' }}>5</option>
                    </select>
                    @error('rating.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            `;
            stopsContainer.appendChild(newStop);
        }
    
        // bottone aggiungi tappa statico
        document.querySelector('.add-stop-btn').addEventListener('click', function() {
            addStop(0); 
        });
    });
</script>
@endsection
