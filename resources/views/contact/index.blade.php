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
                    @if (count($contacts) > 0)
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->first_name . $contact->last_name }}</td>
                                        <td>{{ $contact->mobile_number }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->category->name }}</td>
                                        <td>
                                            <a href="{{ route('contact.show', $contact) }}" class="btn btn-primary">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info mb-0">No record found!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
