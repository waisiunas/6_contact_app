@extends('layout.main')

@section('title', 'Add Contact')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Add Contact</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('contacts') }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="alert"></div>
                    <div id="response"></div>

                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
