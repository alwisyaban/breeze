@extends('layouts.master', ['title' => 'Register'])
@section('content')
    <div class="card w-50">
        <h5 class="card-header">Register</h5>
        <div class="card-body">
            {{-- <x-guest-layout> --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                        autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="input-group">
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="input-group">
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                @if (Auth::user()->name == 'admin')
                    <div class="flex items-center justify-end mt-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-regular fa-floppy-disk"></i> Save
                        </button>
                    </div>
                @endif
            </form>
            {{-- </x-guest-layout> --}}
        </div>
    </div>
@endsection
