@foreach ($knowledges as $item)
<div class="modal fade" id="modalDeleteKnowledge{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteKnowledgeLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDeleteKnowledgeLabel{{ $item->id }}">Delete Knowledge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('knowledge/'.$item->id ) }}" method="post">
            @method('DELETE')
            @csrf
            <div class="mb-3">
               <p>
                Are you sure you want to delete this knowledge?<br>
                <em>{{ $item->content }}</em>
               </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach