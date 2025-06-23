@foreach ($knowledges as $item)
<div class="modal fade" id="modalUpdateKnowledge{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpdateKnowledgeLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalUpdateKnowledgeLabel{{ $item->id }}">Update Knowledge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('knowledge/'.$item->id ) }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="content{{ $item->id }}">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content{{ $item->id }}" name="content" rows="4">{{ old('content', $item->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach