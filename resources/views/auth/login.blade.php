@extends('layouts.app')

@section('content')
<v-container id="g-login" class="py-12 d-flex flex-column align-center">
    <v-col cols="12" sm="6" md="4" class="d-flex flex-column align-center">
        <a href="/" style="text-decoration:none;">
            <v-img max-width="100%" src="https://gallega.com/wp-content/uploads/2019/08/gallega-logo-190x95-v1.png"></v-img>
        </a>
    </v-col>
    <v-col cols="12" sm="6" md="4">
        <v-card id="loginform">
            <v-card-title class="px-5 pt-5 pb-0">Login</v-card-title>
            <v-card-text class="py-5 px-5">
                <v-form
                method="POST"
                action="{{ route('login') }}"
                ref="form"
                v-model="loginValid"
                lazy-validation>
                    @csrf
                    <v-text-field
                        outlined
                        required
                        autocomplete="email"
                        id="email"
                        type="email"
                        name="email"
                        label="{{ __('Email') }}"
                        v-model="loginEmail"
                        :rules="loginEmailrules"
                        autofocus
                        @error('email')
                            value="{{ old('email') }}"
                            autofocus
                            error
                            error-messages="{{ old('email')}} do not match in our records"
                        @enderror>
                    </v-text-field>
                    <v-text-field
                        outlined
                        required
                        autocomplete="password"
                        id="password"
                        label="{{ __('Password') }}"
                        type="password"
                        name="password"
                        v-model="loginPassword"
                        :rules="loginPasswordrules"
                        @error('password')
                            error
                            error-messages="{{ $message }}"
                            autofocus
                        @enderror>
                    </v-text-field>
                    <v-checkbox
                        type="checkbox"
                        name="remember"
                        id="remember"
                        {{ old('remember') ? 'checked' : '' }}
                        label="Remember me"
                        color="primary"
                        class="mt-0">
                    </v-checkbox>
                    <v-btn
                        width="100%"
                        height="55"
                        large
                        color="primary"
                        class="mb-5"
                        type="submit"
                        :disabled="!loginValid"
                        @click="validate"
                    >{{ __('LOGIN') }}</v-btn>
                    {{-- <v-card-actions class="justify-center flex-column py-0">
                        <a href="{{ route('password.request') }}" class="pb-2">{{ __('Forgot your password?') }}</a>
                        <a href="{{ route('register') }}">{{ __('Create account') }}</a>
                    </v-card-actions> --}}
                </v-form>
            </v-card-text>
        </v-card>
        <div class="mt-5 text-center">
            <small color="grey">Powered by Gallega Global Logistics</small>
        </div>
    </v-col>
</v-container>

@endsection

@section('scripts')
    {{-- <script src="{{ asset('js/login.js') }}"></script> --}}
@endsection
