
<div class="modal fade mt-5" id="deleteModal{{ $trip->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="min-width: 40vw !important">
      <div class="modal-content border-0 bg-modal">
        <div class="modal-header bg-color-purple border-0">
          <h3 class="modal-title  font-archivo color-grey shadow-grey" id="deleteModalLabel">Eliminazione viaggio </h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-color-purple border-0">
            <h3 id="costum-message" class="font-archivo color-yellow shadow-yellow">Sei sicuro di voler eliminare il viaggio "{{$trip->title}}"?</h3>   
        </div>
        
        <div class="modal-footer bg-color-purple border-0">
            <button type="button" class="btn btn-chiudi font-archivo" data-bs-dismiss="modal">Chiudi</button>
                <form action="{{route('admin.trips.destroy', ['trip'=> $trip->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn font-archivo btn-elimina">Elimina</button>
            </form>
        </div>
      </div>
    </div>
  </div>