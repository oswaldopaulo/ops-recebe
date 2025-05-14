<x-guest-layout>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">        {{ __('Recover password') }}
                            </h3>
                        <small class="text-center">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </small>
                        </div>
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
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
                                           placeholder="{{__('Email')}}" />
                                    <label for="email">{{__('Email')}}</label>


                                </div>


                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                    <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
