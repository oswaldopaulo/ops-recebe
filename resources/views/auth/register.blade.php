<x-guest-layout>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">{{__('Create Account')}}</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 mb-md-0">

                                                <input  class="form-control" id="name"  name="name" type="text" value="{{ old('name') }}"  required placeholder="{{__('Enter your name')}}" />
                                                <label for="name">{{ __('Name') }}</label>
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-floating">--}}
{{--                                                <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" />--}}
{{--                                                <label for="inputLastName">Last name</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="name@example.com" />
                                        <label for="email">{{__('Email')}}</label>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="username" name="username" type="text" value="{{ old('username') }}" required placeholder="{{__('Username')}}" />
                                                <label for="username">{{__('Username')}}</label>
                                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="document" name="document" required type="text" value="{{ old('document') }}" placeholder="{{__('Document')}}" />
                                                <label for="document">{{__('Document')}}</label>
                                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="password" name="password" required type="password" placeholder="{{__('Create a password')}}" />
                                                <label for="password">{{__('Password')}}</label>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required placeholder="{{__('Confirm Password')}}" />
                                                <label for="password_confirmation">{{__('Confirm Password')}}</label>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">
                                            {{__('Create Account')}}</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{ route('login') }}">{{__('Have an account? Go to login')}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</x-guest-layout>
