<div class="btn-group" role="group">
    <a href="{{ url('contacts/show', ['contact' => $contact->id]) }}" class="btn btn-link">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ url('contacts/edit/') .  $contact->id }}" class="btn btn-link">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger"
        onclick="event.preventDefault();
        if(confirm('{{ __('Are you sure you want to delete this contact?') }}')) {
            document.getElementById('delete-contact-{{ $contact->id }}').submit();
        }">
        <i class="fas fa-trash"></i>
    </button>
    <form id="delete-contact-{{ $contact->id }}" action="{{ url('contacts/destroy/', ['contact' => $contact->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
