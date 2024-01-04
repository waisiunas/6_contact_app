@extends('layout.main')

@section('title', 'Contact')

@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Contact</h1>
    </div>

    <div class="card">
        <div class="card-body h-100">
            <div class="text-center">
                <div id="picture-section">
                    @if ($contact->picture)
                        <img src="{{ asset('template/img/contacts/') . $contact->picture }}" alt="Placeholder picture"
                            class="img-fluid rounded-circle mb-2" width="200" height="200" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $contact->first_name }}+{{ $contact->last_name }}"
                            alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                    @endif
                </div>
                <div id="name-section">
                    <h3>{{ $contact->first_name . ' ' . $contact->last_name }}</h3>
                </div>
                <div id="links-section">
                    @if ($contact->facebook)
                        <a href="{{ $contact->facebook }}" class="btn btn-white" target="_blank">
                            <i class="align-middle me-1" data-feather="facebook" style="height: 25px; width:25px"></i>
                        </a>
                    @endif

                    @if ($contact->instagram)
                        <a href="{{ $contact->instagram }}" class="btn btn-white" target="_blank">
                            <i class="align-middle me-1" data-feather="instagram" style="height: 25px; width:25px"></i>
                            {{-- <img width="50" height="50"
                                src="https://img.icons8.com/ios-filled/50/instagram-new--v1.png" alt="instagram-new--v1" /> --}}
                        </a>
                    @endif

                    @if ($contact->youtube)
                        <a href="{{ $contact->youtube }}" class="btn btn-white" target="_blank">
                            <i class="align-middle me-1" data-feather="youtube" style="height: 25px; width:25px"></i>
                            {{-- <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/youtube-play.png"
                                alt="youtube-play" /> --}}
                        </a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Mobile Number:
                        </div>
                        <div class="col-8">
                            {{ $contact->mobile_number }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Email:
                        </div>
                        <div class="col-8">
                            {{ $contact->email }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            DoB:
                        </div>
                        <div class="col-8">
                            {!! $contact->dob ?? '<em>N/A</em>' !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Address:
                        </div>
                        <div class="col-8">
                            {!! $contact->address ?? '<em>N/A</em>' !!}
                        </div>
                    </div>
                    <hr>
                    <div>
                        <a href="{{ route('contact.edit', $contact) }}" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
