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
                        <header class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fs-5 fw-medium text-dark">
                                    {{ __('Contact Information') }}
                                </h2>
                                <p class="mt-1 small text-muted">
                                    {{ __('View contact details.') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                </a>
                            </div>
                        </header>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @if (session('status') === 'contact-created')
                                    {{ __('Contact created successfully.') }}
                                @elseif (session('status') === 'contact-updated')
                                    {{ __('Contact updated successfully.') }}
                                @else
                                    {{ session('status') }}
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{ __('Name') }}</label>
                                <p>{{ $contact->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{ __('Document') }}</label>
                                <p>{{ $contact->document ?? __('Not provided') }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{ __('Type') }}</label>
                                <p>{{ $contact->type == 0 ? __('Individual') : __('Company') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{ __('Status') }}</label>
                                <p>
                                    @if ($contact->active)
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Addresses -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="w-100">
                    <section>
                        <header>
                            <h2 class="fs-5 fw-medium text-dark">
                                {{ __('Addresses') }}
                            </h2>
                            <p class="mt-1 small text-muted">
                                {{ __('Contact addresses.') }}
                            </p>
                        </header>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('City/State') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact->addresses as $address)
                                        <tr>
                                            <td>{{ $address->descricao }}</td>
                                            <td>{{ $address->endereco }}, {{ $address->numero }} - {{ $address->bairro }}</td>
                                            <td>{{ $address->cidade }}/{{ $address->uf }} - {{ $address->cep }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">{{ __('No addresses found.') }}</td>
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
                        <header>
                            <h2 class="fs-5 fw-medium text-dark">
                                {{ __('Contact Methods') }}
                            </h2>
                            <p class="mt-1 small text-muted">
                                {{ __('Contact methods (phone, email, etc).') }}
                            </p>
                        </header>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Value') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact->contactMethods as $contactMethod)
                                        <tr>
                                            <td>{{ $contactMethod->descricao }}</td>
                                            <td>{{ $contactMethod->type_name }}</td>
                                            <td>{{ $contactMethod->valor }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">{{ __('No contact methods found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back to Contacts') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
