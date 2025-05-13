<x-guest-layout>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input class="form-control"
                                               id="email"
                                               name="email"
                                               value="{{old('email')}}"
                                               type="email"
                                               required
                                               autofocus
                                               autocomplete="username"
                                               placeholder="{{__('Email')}} / {{__('Username')}} / {{__('CPF')}}" />
                                        <label for="email">{{__('Email')}} / {{__('Username')}} / {{__('CPF')}}</label>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="{{__('Password')}}" />
                                        <label for="password">{{__('Password')}}</label>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-check mb-3">
                                        <input
                                            class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember"  />
                                        <label class="form-check-label" for="inputRememberPassword">{{ __('Remember me') }}</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a>
                                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{  route('register') }}">{{__('Need an account?')}} {{ __('Register') }}!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</x-guest-layout>
