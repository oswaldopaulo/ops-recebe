<x-guest-layout>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4"> {{ __('Reset Password') }}</h3></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Token de redefinição de senha -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Endereço de Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input
                                        id="email"
                                        class="form-control"
                                        type="email"
                                        name="email"
                                        value="{{ old('email', $request->email) }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />
                                    @if ($errors->has('email'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Senha -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input
                                        id="password"
                                        class="form-control"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                    />
                                    @if ($errors->has('password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Confirmação de Senha -->
                                <div class="mb-3">
                                    <label for="password_confirmation"
                                           class="form-label">{{ __('Confirm Password') }}</label>
                                    <input
                                        id="password_confirmation"
                                        class="form-control"
                                        type="password"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                                    @if ($errors->has('password_confirmation'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('password_confirmation') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a
                                    href="{{  route('register') }}">{{__('Need an account?')}} {{ __('Register') }}!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
