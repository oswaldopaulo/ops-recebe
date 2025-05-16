<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-secondary">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Primeiro bloco -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Segundo bloco -->
            <div class="p-4 bg-white shadow rounded mb-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Terceiro bloco -->
            <div class="p-4 bg-white shadow rounded">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
