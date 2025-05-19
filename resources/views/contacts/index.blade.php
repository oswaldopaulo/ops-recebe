<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-secondary">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="w-100">
                    <section>
                        <header class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fs-5 fw-medium text-dark">
                                    {{ __('Contact List') }}
                                </h2>
                                <p class="mt-1 small text-muted">
                                    {{ __('Manage your contacts.') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('New Contact') }}
                                </a>
                            </div>
                        </header>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @if (session('status') === 'contact-created')
                                    {{ __('Contact created successfully.') }}
                                @elseif (session('status') === 'contact-updated')
                                    {{ __('Contact updated successfully.') }}
                                @elseif (session('status') === 'contact-deleted')
                                    {{ __('Contact deleted successfully.') }}
                                @else
                                    {{ session('status') }}
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Document') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->document }}</td>
                                            <td>{{ $contact->type == 0 ? __('Individual') : __('Company') }}</td>
                                            <td>
                                                @if ($contact->active)
                                                    <span class="badge bg-success">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault();
                                                        if(confirm('{{ __('Are you sure you want to delete this contact?') }}')) {
                                                            document.getElementById('delete-contact-{{ $contact->id }}').submit();
                                                        }">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-contact-{{ $contact->id }}" action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('No contacts found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $contacts->links() }}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
