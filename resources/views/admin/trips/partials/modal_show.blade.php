
<div class="modal fade mt-5" id="showModal{{ $trip->id }}" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 bg-modal">
            <div class="modal-header bg-color-purple border-0">
                <h3 class="modal-title font-archivo color-grey shadow-grey" id="showModalLabel">{{ $trip->title }} </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="map-{{ $trip->id }}" class="map" style="height: 400px; width: 100%;"></div> 

            <div class="modal-body bg-color-purple border-0">
                <div class="container">
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Descrizione:</strong> {{ $trip->description }}</p>
                            <p><strong>Data Inizio:</strong> {{ \Carbon\Carbon::parse($trip->start_date)->format('d-m-Y') }}</p>
                            <p><strong>Data Fine:</strong> {{ \Carbon\Carbon::parse($trip->end_date)->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-12">
                            @if($trip->cover_image)
                                <img src="{{ asset('storage/' . $trip->cover_image) }}" alt="Immagine di Copertina" class="img-fluid">
                            @endif
                        </div>
                    </div>

                    
                    @foreach ($trip->days as $day)
                        <div class="day-details mb-3">
                            <h5><strong>Giornata:</strong> {{ $day->title }}</h5>
                            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($day->date)->format('d-m-Y') }}</p>
                            
                            
                            @foreach ($day->stops as $stop)
                                <div class="stop-details mb-2">
                                    <h5><strong>Tappa:</strong> {{ $stop->title }}</h5>
                                    <p><strong>Descrizione:</strong> {{ $stop->description }}</p>
                                    @if($stop->image)
                                        <img src="{{ asset('storage/' . $stop->image) }}" alt="Immagine della Tappa" class="img-fluid mb-2">
                                    @endif
                                    <p><strong>Cibo:</strong> {{ $stop->food }}</p>
                                    <p><strong>Curiosità:</strong> {{ $stop->curiosities }}</p>
                                    <p><strong>Località:</strong> {{ $stop->location }}</p>
                                </div>
                                @foreach ($stop->notes as $note)
                                <p><strong>Note:</strong> {{ $note->content }}</p>
                                @endforeach
                                @foreach ($stop->ratings as $rating)
                                <p><strong>Valutazione:</strong> {{ $rating->value }}/5</p>
                                @endforeach
                            @endforeach
                            
                        </div>
                    @endforeach
                </div>   
            </div>
            <div class="modal-footer bg-color-purple border-0">
                <a class="btn-edit-show text-green me-1" href="{{route('admin.trips.edit', ['trip' => $trip->id])}}">MODIFICA</a>
                <button type="button" class="btn btn-chiudi font-archivo" data-bs-dismiss="modal">Chiudi</button>
                <button class=" btn-delete col-6 text-center" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trip->id }}">Elimina</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.addEventListener('shown.bs.modal', function (event) {
                var modalId = event.target.id; 
                var tripId = modalId.replace('showModal', ''); 

                // richiesta AJAX per dati del viaggio
                fetch(`/admin/trips/${tripId}`)
                    .then(response => response.json())
                    .then(data => {
                        
                        initializeMap(modalId, data.days.flatMap(day => day.stops.map(stop => ({
                            title: stop.title,
                            description: stop.description,
                            address: stop.location
                        }))));
                    });
            });
        });
    });

    function initializeMap(modalId, locations) {
        var mapElement = document.querySelector('#' + modalId + ' .map');
        var map = L.map(mapElement).setView([51.505, -0.09], 2); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var geocoder = L.Control.Geocoder.nominatim();

        // Aggiungi marker per ogni tappa
        locations.forEach(function(location) {
            geocoder.geocode(location.address, function(results) {
                if (results.length > 0) {
                    var latLng = results[0].center;
                    L.marker([latLng.lat, latLng.lng])
                        .addTo(map)
                        .bindPopup("<b>" + location.title + "</b><br>" + location.description);
                }
            });
        });
    }
</script>
