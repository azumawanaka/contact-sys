@extends('layouts.app')

@section('content')
<div class="container">
    
   @include('includes.header')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Edit Contact') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contact.update', ['contact' => $contact]) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end required">{{ __('Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $contact->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company" class="col-md-3 col-form-label text-md-end">{{ __('Company') }}</label>

                            <div class="col-md-9">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $contact->company }}" autocomplete="company" autofocus>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-3 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-9">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $contact->phone }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-9">
                                <input id="text" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $contact->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label for="" class="col-md-3 col-form-label text-md-end"></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary float-end">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
