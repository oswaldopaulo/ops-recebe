<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-secondary">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <!-- Contact Information -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="w-100">
                    <section>
                        <header>
                            <h2 class="fs-5 fw-medium text-dark">
                                {{ __('Contact Information') }}
                            </h2>

                            <p class="mt-1 small text-muted">
                                {{ __('Update contact details.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('contacts.update', $contact) }}" class="mt-4">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $contact->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="document" :value="__('Document')" />
                                <x-text-input id="document" name="document" type="text" class="form-control" :value="old('document', $contact->document)" />
                                <x-input-error class="mt-2" :messages="$errors->get('document')" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="form-select">
                                    <option value="0" {{ old('type', $contact->type) == 0 ? 'selected' : '' }}>{{ __('Individual') }}</option>
                                    <option value="1" {{ old('type', $contact->type) == 1 ? 'selected' : '' }}>{{ __('Company') }}</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $contact->active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('active')" />
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'contact-updated')
                                    <div
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="alert alert-success p-1 px-2 m-0" role="alert" style="height: 2rem;"
                                    ><i class="fa-regular fa-circle-check text-success me-1"></i>{{ __('Saved.') }}</div>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Addresses -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="w-100">
                    <section>
                        <header class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fs-5 fw-medium text-dark">
                                    {{ __('Addresses') }}
                                </h2>
                                <p class="mt-1 small text-muted">
                                    {{ __('Manage contact addresses.') }}
                                </p>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="fas fa-plus"></i> {{ __('Add Address') }}
                            </button>
                        </header>

                        @if (session('status') === 'address-created' || session('status') === 'address-updated' || session('status') === 'address-deleted')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @if (session('status') === 'address-created')
                                    {{ __('Address added successfully.') }}
                                @elseif (session('status') === 'address-updated')
                                    {{ __('Address updated successfully.') }}
                                @elseif (session('status') === 'address-deleted')
                                    {{ __('Address deleted successfully.') }}
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('City/State') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact->addresses as $address)
                                        <tr>
                                            <td>{{ $address->descricao }}</td>
                                            <td>{{ $address->endereco }}, {{ $address->numero }} - {{ $address->bairro }}</td>
                                            <td>{{ $address->cidade }}/{{ $address->uf }} - {{ $address->cep }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editAddressModal{{ $address->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault();
                                                        if(confirm('{{ __('Are you sure you want to delete this address?') }}')) {
                                                            document.getElementById('delete-address-{{ $address->id }}').submit();
                                                        }">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-address-{{ $address->id }}" action="{{ route('contacts.addresses.destroy', $address) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>

                                                <!-- Edit Address Modal -->
                                                <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">{{ __('Edit Address') }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('contacts.addresses.update', $address) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="descricao{{ $address->id }}" class="form-label">{{ __('Description') }}</label>
                                                                        <input type="text" class="form-control" id="descricao{{ $address->id }}" name="descricao" value="{{ $address->descricao }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="cep{{ $address->id }}" class="form-label">{{ __('Postal Code') }}</label>
                                                                        <input type="text" class="form-control" id="cep{{ $address->id }}" name="cep" value="{{ $address->cep }}" required>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 mb-3">
                                                                            <label for="endereco{{ $address->id }}" class="form-label">{{ __('Address') }}</label>
                                                                            <input type="text" class="form-control" id="endereco{{ $address->id }}" name="endereco" value="{{ $address->endereco }}" required>
                                                                        </div>
                                                                        <div class="col-md-4 mb-3">
                                                                            <label for="numero{{ $address->id }}" class="form-label">{{ __('Number') }}</label>
                                                                            <input type="text" class="form-control" id="numero{{ $address->id }}" name="numero" value="{{ $address->numero }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="bairro{{ $address->id }}" class="form-label">{{ __('Neighborhood') }}</label>
                                                                        <input type="text" class="form-control" id="bairro{{ $address->id }}" name="bairro" value="{{ $address->bairro }}" required>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 mb-3">
                                                                            <label for="cidade{{ $address->id }}" class="form-label">{{ __('City') }}</label>
                                                                            <input type="text" class="form-control" id="cidade{{ $address->id }}" name="cidade" value="{{ $address->cidade }}" required>
                                                                        </div>
                                                                        <div class="col-md-4 mb-3">
                                                                            <label for="uf{{ $address->id }}" class="form-label">{{ __('State') }}</label>
                                                                            <input type="text" class="form-control" id="uf{{ $address->id }}" name="uf" value="{{ $address->uf }}" required maxlength="2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="complemento{{ $address->id }}" class="form-label">{{ __('Complement') }}</label>
                                                                        <input type="text" class="form-control" id="complemento{{ $address->id }}" name="complemento" value="{{ $address->complemento }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="referencia{{ $address->id }}" class="form-label">{{ __('Reference') }}</label>
                                                                        <input type="text" class="form-control" id="referencia{{ $address->id }}" name="referencia" value="{{ $address->referencia }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('No addresses found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Contact Methods -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="w-100">
                    <section>
                        <header class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fs-5 fw-medium text-dark">
                                    {{ __('Contact Methods') }}
                                </h2>
                                <p class="mt-1 small text-muted">
                                    {{ __('Manage contact methods (phone, email, etc).') }}
                                </p>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContactMethodModal">
                                <i class="fas fa-plus"></i> {{ __('Add Contact Method') }}
                            </button>
                        </header>

                        @if (session('status') === 'contact-method-created' || session('status') === 'contact-method-updated' || session('status') === 'contact-method-deleted')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @if (session('status') === 'contact-method-created')
                                    {{ __('Contact method added successfully.') }}
                                @elseif (session('status') === 'contact-method-updated')
                                    {{ __('Contact method updated successfully.') }}
                                @elseif (session('status') === 'contact-method-deleted')
                                    {{ __('Contact method deleted successfully.') }}
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Value') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact->contactMethods as $contactMethod)
                                        <tr>
                                            <td>{{ $contactMethod->descricao }}</td>
                                            <td>{{ $contactMethod->type_name }}</td>
                                            <td>{{ $contactMethod->valor }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editContactMethodModal{{ $contactMethod->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault();
                                                        if(confirm('{{ __('Are you sure you want to delete this contact method?') }}')) {
                                                            document.getElementById('delete-contact-method-{{ $contactMethod->id }}').submit();
                                                        }">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-contact-method-{{ $contactMethod->id }}" action="{{ route('contacts.contact-methods.destroy', $contactMethod) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>

                                                <!-- Edit Contact Method Modal -->
                                                <div class="modal fade" id="editContactMethodModal{{ $contactMethod->id }}" tabindex="-1" aria-labelledby="editContactMethodModalLabel{{ $contactMethod->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editContactMethodModalLabel{{ $contactMethod->id }}">{{ __('Edit Contact Method') }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('contacts.contact-methods.update', $contactMethod) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="descricao{{ $contactMethod->id }}" class="form-label">{{ __('Description') }}</label>
                                                                        <input type="text" class="form-control" id="descricao{{ $contactMethod->id }}" name="descricao" value="{{ $contactMethod->descricao }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="tipo{{ $contactMethod->id }}" class="form-label">{{ __('Type') }}</label>
                                                                        <select class="form-select" id="tipo{{ $contactMethod->id }}" name="tipo" required>
                                                                            <option value="0" {{ $contactMethod->tipo == 0 ? 'selected' : '' }}>{{ __('Phone') }}</option>
                                                                            <option value="1" {{ $contactMethod->tipo == 1 ? 'selected' : '' }}>{{ __('Email') }}</option>
                                                                            <option value="2" {{ $contactMethod->tipo == 2 ? 'selected' : '' }}>{{ __('Mobile') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="valor{{ $contactMethod->id }}" class="form-label">{{ __('Value') }}</label>
                                                                        <input type="text" class="form-control" id="valor{{ $contactMethod->id }}" name="valor" value="{{ $contactMethod->valor }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('No contact methods found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Delete Contact -->
            <div class="p-4 bg-white shadow rounded">
                <div class="w-100">
                    <section>
                        <header>
                            <h2 class="fs-5 fw-medium text-dark">
                                {{ __('Delete Contact') }}
                            </h2>

                            <p class="mt-1 small text-muted">
                                {{ __('Once a contact is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>
                        </header>

                        <button type="button" class="btn btn-danger"
                            onclick="event.preventDefault();
                            if(confirm('{{ __('Are you sure you want to delete this contact?') }}')) {
                                document.getElementById('delete-contact-form').submit();
                            }">
                            {{ __('Delete Contact') }}
                        </button>
                        <form id="delete-contact-form" action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">{{ __('Add New Address') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contacts.addresses.store', $contact) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descricao" class="form-label">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                        <div class="mb-3">
                            <label for="cep" class="form-label">{{ __('Postal Code') }}</label>
                            <input type="text" class="form-control" id="cep" name="cep" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="endereco" class="form-label">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="numero" class="form-label">{{ __('Number') }}</label>
                                <input type="text" class="form-control" id="numero" name="numero">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bairro" class="form-label">{{ __('Neighborhood') }}</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="cidade" class="form-label">{{ __('City') }}</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="uf" class="form-label">{{ __('State') }}</label>
                                <input type="text" class="form-control" id="uf" name="uf" required maxlength="2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="complemento" class="form-label">{{ __('Complement') }}</label>
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                        <div class="mb-3">
                            <label for="referencia" class="form-label">{{ __('Reference') }}</label>
                            <input type="text" class="form-control" id="referencia" name="referencia">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Contact Method Modal -->
    <div class="modal fade" id="addContactMethodModal" tabindex="-1" aria-labelledby="addContactMethodModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactMethodModalLabel">{{ __('Add New Contact Method') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contacts.contact-methods.store', $contact) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descricao" class="form-label">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">{{ __('Type') }}</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="0">{{ __('Phone') }}</option>
                                <option value="1">{{ __('Email') }}</option>
                                <option value="2">{{ __('Mobile') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">{{ __('Value') }}</label>
                            <input type="text" class="form-control" id="valor" name="valor" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
