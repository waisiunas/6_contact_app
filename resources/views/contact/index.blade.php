@extends('layout.main')

@section('title', 'Contacts')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Contacts</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('contact.create') }}" class="btn btn-outline-primary">Add Contact</a>
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
