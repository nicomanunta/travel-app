@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Pianifica un Nuovo Viaggio</h1>

    <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Dettagli del Viaggio -->
        <div class="form-group">
            <label for="trip_title">Nome del Viaggio</label>
            <input type="text" class="form-control" id="trip_title" name="trip_title" required>
        </div>

        <div class="form-group">
            <label for="trip_description">Descrizione</label>
            <textarea class="form-control" id="trip_description" name="trip_description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="start_date">Data Inizio</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">Data Fine</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="cover_image">Immagine di Copertina</label>
            <input type="file" class="form-control-file" id="cover_image" name="cover_image" accept="image/*">
        </div>

        <!-- Giornate del Viaggio -->
        <h3>Giornate del Viaggio</h3>
        <div id="days-container">
            <div class="day-entry">
                <div class="form-group">
                    <label for="day_title_1">Titolo della Giornata</label>
                    <input type="text" class="form-control" name="day_title[]" required>
                </div>

                <div class="form-group">
                    <label for="day_date_1">Data</label>
                    <input type="date" class="form-control" name="day_date[]" required>
                </div>

                <!-- Tappe -->
                <h4>Tappe della Giornata</h4>
                <div class="stops-container">
                    <div class="stop-entry">
                        <div class="form-group">
                            <label for="stop_title_1">Titolo della Tappa</label>
                            <input type="text" class="form-control" name="stop_title[]" required>
                        </div>

                        <div class="form-group">
                            <label for="stop_description_1">Descrizione</label>
                            <textarea class="form-control" name="stop_description[]" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="stop_image_1">Immagine della Tappa</label>
                            <input type="file" class="form-control-file" name="stop_image[]" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="food_1">Cibo</label>
                            <input type="text" class="form-control" name="food[]">
                        </div>

                        <div class="form-group">
                            <label for="curiosities_1">Curiosità</label>
                            <input type="text" class="form-control" name="curiosities[]">
                        </div>

                        <!-- Note -->
                        <div class="form-group">
                            <label for="note_1">Note</label>
                            <textarea class="form-control" name="note[]" rows="2"></textarea>
                        </div>

                        <!-- Valutazione -->
                        <div class="form-group">
                            <label for="rating_1">Valutazione (1-5)</label>
                            <select class="form-control" name="rating[]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-stop-btn">Aggiungi Tappa</button>
            </div>
        </div>
        <button type="button" class="btn btn-secondary add-day-btn">Aggiungi Giornata</button>

        <button type="submit" class="btn btn-primary mt-3">Crea Viaggio</button>
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