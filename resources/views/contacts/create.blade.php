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
                        <header>
                            <h2 class="fs-5 fw-medium text-dark">
                                {{ __('Create New Contact') }}
                            </h2>

                            <p class="mt-1 small text-muted">
                                {{ __('Add a new contact to your list.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('contacts.store') }}" class="mt-4">
                            @csrf

                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="document" :value="__('Document')" />
                                <x-text-input id="document" name="document" type="text" class="form-control" :value="old('document')" />
                                <x-input-error class="mt-2" :messages="$errors->get('document')" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="form-select">
                                    <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>{{ __('Individual') }}</option>
                                    <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>{{ __('Company') }}</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('active')" />
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
