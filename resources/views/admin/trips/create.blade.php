@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Pianifica un Nuovo Viaggio</h1>

    <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Dettagli del Viaggio -->
        <div class="form-group mb-3">
            <label for="title">Nome del Viaggio</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Data Inizio</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="end_date">Data Fine</label>
            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover_image">Immagine di Copertina</label>
            <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Giornate del Viaggio -->
        <h3 class="my-4">Giornate del Viaggio</h3>
        <div id="days-container">
            <div class="day-entry">
                <div class="form-group mb-3">
                    <label for="day_title_1">Titolo della Giornata</label>
                    <input type="text" class="form-control @error('day_title.*') is-invalid @enderror" name="day_title[]" value="{{ old('day_title.0') }}" required>
                    @error('day_title.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="day_date_1">Data</label>
                    <input type="date" class="form-control @error('day_date.*') is-invalid @enderror" name="day_date[]" value="{{ old('day_date.0') }}" required>
                    @error('day_date.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tappe -->
                <h3 class="my-4">Tappe della Giornata</h3>
                <div class="stops-container">
                    <div class="stop-entry">
                        <div class="form-group mb-3">
                            <label for="stop_title_1">Titolo della Tappa</label>
                            <input type="text" class="form-control @error('stop_title.*') is-invalid @enderror" name="stop_title[]" value="{{ old('stop_title.0') }}" required>
                            @error('stop_title.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stop_description_1">Descrizione</label>
                            <textarea class="form-control @error('stop_description.*') is-invalid @enderror" name="stop_description[]" rows="2">{{ old('stop_description.0') }}</textarea>
                            @error('stop_description.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stop_image_1">Immagine della Tappa</label>
                            <input type="file" class="form-control-file @error('stop_image.*') is-invalid @enderror" name="stop_image[]" accept="image/*">
                            @error('stop_image.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="food_1">Cibo</label>
                            <input type="text" class="form-control @error('food.*') is-invalid @enderror" name="food[]" value="{{ old('food.0') }}">
                            @error('food.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="curiosities_1">Curiosità</label>
                            <input type="text" class="form-control @error('curiosities.*') is-invalid @enderror" name="curiosities[]" value="{{ old('curiosities.0') }}">
                            @error('curiosities.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="latitude_1">Latitudine</label>
                            <input type="text" class="form-control @error('latitude.*') is-invalid @enderror" name="latitude[]" value="{{ old('latitude.0') }}">
                            @error('latitude.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="longitude_1">Longitudine</label>
                            <input type="text" class="form-control @error('longitude.*') is-invalid @enderror" name="longitude[]" value="{{ old('longitude.0') }}">
                            @error('longitude.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Note -->
                        <div class="form-group mb-3">
                            <label for="note_1">Note</label>
                            <textarea class="form-control @error('note.*') is-invalid @enderror" name="note[]" rows="2">{{ old('note.0') }}</textarea>
                            @error('note.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Valutazione -->
                        <div class="form-group mb-3">
                            <label for="rating_1">Valutazione (1-5)</label>
                            <select class="form-control @error('rating.*') is-invalid @enderror" name="rating[]">
                                <option value="1" {{ old('rating.0') == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('rating.0') == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('rating.0') == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('rating.0') == 4 ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('rating.0') == 5 ? 'selected' : '' }}>5</option>
                            </select>
                            @error('rating.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-3 btn btn-blue add-stop-btn">Aggiungi Tappa</button>
            </div>
        </div>
        <div class="d-flex justify-content-between my-2">
            <button type="button" class="btn btn-blue add-day-btn">Aggiungi Giornata</button>
            <button type="submit" class="btn btn-green">Crea Viaggio</button>
        </div>
    </form>
</div>

<!-- JavaScript per aggiungere dinamicamente giornate e tappe -->
<script>
    document.querySelector('.add-day-btn').addEventListener('click', function() {
        let dayContainer = document.getElementById('days-container');
        let newDay = document.querySelector('.day-entry').cloneNode(true);
        newDay.querySelectorAll('input, textarea').forEach(input => input.value = '');
        dayContainer.appendChild(newDay);
    });

    document.querySelectorAll('.add-stop-btn').forEach(button => {
        button.addEventListener('click', function() {
            let stopContainer = this.previousElementSibling;
            let newStop = stopContainer.querySelector('.stop-entry').cloneNode(true);
            newStop.querySelectorAll('input, textarea').forEach(input => input.value = '');
            stopContainer.appendChild(newStop);
        });
    });
</script>
@endsection
