<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal{{ $trip->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content border-0 bg-modal">
        <div class="modal-header bg-color-purple border-0">
          <h3 class="modal-title  font-archivo color-grey shadow-grey" id="exampleModalLabel">{{ $trip->title }} </h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-color-purple border-0">
            <div class="container">
                <!-- Dettagli del Viaggio -->
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

                <!-- Giornate del Viaggio -->
                @foreach ($trip->days as $day)
                    <div class="day-details mb-3">
                        <h5><strong>Giornata:</strong> {{ $day->title }}</h5>
                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($day->date)->format('d-m-Y') }}</p>
                        
                        <!-- Tappe della Giornata -->
                        @foreach ($day->stops as $stop)
                            <div class="stop-details mb-2">
                                <h5><strong>Tappa:</strong> {{ $stop->title }}</h5>
                                <p><strong>Descrizione:</strong> {{ $stop->description }}</p>
                                @if($stop->image)
                                    <img src="{{ asset('storage/' . $stop->image) }}" alt="Immagine della Tappa" class="img-fluid mb-2">
                                @endif
                                <p><strong>Cibo:</strong> {{ $stop->food }}</p>
                                <p><strong>Curiosità:</strong> {{ $stop->curiosities }}</p>
                                <p><strong>Latitudine:</strong> {{ $stop->latitude }}</p>
                                <p><strong>Longitudine:</strong> {{ $stop->longitude }}</p>
                            </div>
                        @endforeach
                        @foreach ($stop->notes as $note)
                            <p><strong>Note:</strong> {{ $note->content }}</p>
                        @endforeach
                        @foreach ($stop->ratings as $rating)
                            <p><strong>Valutazione:</strong> {{ $rating->value}}/5</p>
                        @endforeach
                        
                    </div>
                @endforeach
            </div>   
        </div>
        
        <div class="modal-footer bg-color-purple border-0">
            <button type="button" class="btn btn-chiudi font-archivo" data-bs-dismiss="modal">Chiudi</button>
                {{-- <form action="{{route('admin.trips.destroy', ['trip'=> $trip->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn font-archivo btn-elimina">Elimina</button> --}}
            </form>
        </div>
      </div>
    </div>
  </div>