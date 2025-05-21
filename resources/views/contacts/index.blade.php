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
                                <h1 class="fs-5 fw-medium text-dark">
                                    {{ __('Contact List') }}
                                </h1>
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

                        <livewire:contacts-table theme="bootstrap-5" />
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
