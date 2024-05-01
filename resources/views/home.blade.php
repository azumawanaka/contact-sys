@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <p>{{ __('Thank you for registering') }}</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary btn-sm">Continue</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
