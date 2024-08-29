@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Modifica Viaggio</h1>

    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Dettagli del Viaggio -->
        <div class="form-group mb-3">
            <label for="title">Nome del Viaggio</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $trip->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $trip->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Data Inizio</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $trip->start_date) }}" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="end_date">Data Fine</label>
            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $trip->end_date) }}" required>
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover_image">Immagine di Copertina</label>
            <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @if ($trip->cover_image)
                <img src="{{ asset('storage/' . $trip->cover_image) }}" alt="Cover Image" class="img-thumbnail mt-2" width="200">
            @endif
            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Giornate del Viaggio -->
        <h3 class="my-4">Giornate del Viaggio</h3>
        <div id="days-container">
            @foreach ($trip->days as $index => $day)
                <div class="day-entry">
                    <input type="hidden" name="day_index[]" value="{{ $index }}">
                    <div class="form-group mb-3">
                        <label for="day_title_{{ $index }}">Titolo della Giornata</label>
                        <input type="text" class="form-control @error('day_title.*') is-invalid @enderror" name="day_title[]" value="{{ old('day_title.' . $index, $day->title) }}" required>
                        @error('day_title.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="day_date_{{ $index }}">Data</label>
                        <input type="date" class="form-control @error('day_date.*') is-invalid @enderror" name="day_date[]" value="{{ old('day_date.' . $index, $day->date) }}" required>
                        @error('day_date.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tappe -->
                    <h3 class="my-4">Tappe della Giornata</h3>
                    <div class="stops-container">
                        @foreach ($day->stops as $stopIndex => $stop)
                            <div class="stop-entry">
                                <input type="hidden" name="stop_day_index[{{ $index }}][]" value="{{ $stopIndex }}">
                                <div class="form-group mb-3">
                                    <label for="stop_title_{{ $index }}_{{ $stopIndex }}">Titolo della Tappa</label>
                                    <input type="text" class="form-control @error('stop_title.*') is-invalid @enderror" name="stop_title[{{ $index }}][]" value="{{ old('stop_title.' . $index . '.' . $stopIndex, $stop->title) }}" required>
                                    @error('stop_title.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="stop_description_{{ $index }}_{{ $stopIndex }}">Descrizione</label>
                                    <textarea class="form-control @error('stop_description.*') is-invalid @enderror" name="stop_description[{{ $index }}][]" rows="2">{{ old('stop_description.' . $index . '.' . $stopIndex, $stop->description) }}</textarea>
                                    @error('stop_description.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="stop_location_{{ $index }}_{{ $stopIndex }}">Località</label>
                                    <input type="text" class="form-control @error('stop_location.*') is-invalid @enderror" name="stop_location[{{ $index }}][]" value="{{ old('stop_location.' . $index . '.' . $stopIndex, $stop->location) }}">
                                    @error('stop_location.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="stop_image_{{ $index }}_{{ $stopIndex }}">Immagine della Tappa</label>
                                    <input type="file" class="form-control-file @error('stop_image.*') is-invalid @enderror" name="stop_image[{{ $index }}][]" accept="image/*">
                                    @if ($stop->image)
                                        <img src="{{ asset('storage/' . $stop->image) }}" alt="Stop Image" class="img-thumbnail mt-2" width="200">
                                    @endif
                                    @error('stop_image.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="food_{{ $index }}_{{ $stopIndex }}">Cibo</label>
                                    <input type="text" class="form-control @error('food.*') is-invalid @enderror" name="food[{{ $index }}][]" value="{{ old('food.' . $index . '.' . $stopIndex, $stop->food) }}">
                                    @error('food.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="curiosities_{{ $index }}_{{ $stopIndex }}">Curiosità</label>
                                    <input type="text" class="form-control @error('curiosities.*') is-invalid @enderror" name="curiosities[{{ $index }}][]" value="{{ old('curiosities.' . $index . '.' . $stopIndex, $stop->curiosities) }}">
                                    @error('curiosities.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="note_{{ $index }}_{{ $stopIndex }}">Note</label>  
                                    <textarea class="form-control @error('note.*') is-invalid @enderror" name="note[{{ $index }}][]" rows="2">{{ old('note.' . $index . '.' . $stopIndex) ?? $stop->notes->first()->content ?? '' }}</textarea>                                
                                    @error('note.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="rating_{{ $index }}_{{ $stopIndex }}">Valutazione (1-5)</label>
                                    <select class="form-control @error('rating.*') is-invalid @enderror" name="rating[{{ $index }}][]">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('rating.' . $index . '.' . $stopIndex, $stop->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('rating.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="mt-3 btn btn-blue add-stop-btn">Aggiungi Tappa</button>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-between my-2">
            <button type="button" class="btn btn-blue add-day-btn">Aggiungi Giornata</button>
            <button type="submit" class="btn btn-green">Aggiorna Viaggio</button>
        </div>
    </form>
</div>

<!-- JavaScript per aggiungere dinamicamente giornate e tappe -->
<script>
    document.querySelector('.add-day-btn').addEventListener('click', function() {
        let dayContainer = document.getElementById('days-container');
        let newDay = document.querySelector('.day-entry').cloneNode(true);

        // Azzera i valori degli input per la nuova giornata
        newDay.querySelectorAll('input, textarea').forEach(input => input.value = '');

        // Aggiungi un nuovo indice alla giornata
        let dayIndex = dayContainer.children.length;
        newDay.querySelectorAll('.stop-entry').forEach(stopEntry => {
            let stopDayIndexInput = stopEntry.querySelector('input[name="stop_day_index[]"]');
            if (stopDayIndexInput) {
                stopDayIndexInput.value = dayIndex;
            }
        });

        dayContainer.appendChild(newDay);
    });

    document.querySelectorAll('.add-stop-btn').forEach(button => {
        button.addEventListener('click', function() {
            let stopContainer = this.previousElementSibling;
            let newStop = stopContainer.querySelector('.stop-entry').cloneNode(true);

            // Azzera i valori degli input per la nuova tappa
            newStop.querySelectorAll('input, textarea').forEach(input => input.value = '');

            // Aggiorna l'indice della giornata per la nuova tappa
            let dayIndex = Array.from(document.getElementById('days-container').children).indexOf(stopContainer.closest('.day-entry'));
            let stopDayIndexInput = newStop.querySelector('input[name="stop_day_index[]"]');
            if (stopDayIndexInput) {
                stopDayIndexInput.value = dayIndex;
            }

            stopContainer.appendChild(newStop);
        });
    });
</script>
@endsection
