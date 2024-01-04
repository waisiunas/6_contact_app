@extends('layout.main')

@section('title', 'Edit Contact')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Edit Contact</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('contact.show', $contact) }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')
                    <div class="text-center">
                        <div id="picture-section">
                            @if ($contact->picture)
                                <img src="{{ asset('template/img/contacts/' . $contact->picture) }}"
                                    alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="200"
                                    height="200" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $contact->first_name }}+{{ $contact->last_name }}"
                                    alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="200"
                                    height="200" />
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <form action="{{ route('contact.picture', $contact) }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                    <div class="col-8">
                                        @csrf
                                        @method('PATCH')
                                        <input type="file" id="picture" name="picture"
                                            class="form-control @error('picture') is-invalid @enderror">
                                        @error('picture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <form action="{{ route('contact.edit', $contact) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name') ?? $contact->first_name }}" placeholder="First name!">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle name</label>
                                    <input type="text" id="middle_name" name="middle_name"
                                        class="form-control @error('middle_name') is-invalid @enderror"
                                        value="{{ old('middle_name') ?? $contact->middle_name }}"
                                        placeholder="Middle name!">
                                    @error('middle_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name') ?? $contact->last_name }}" placeholder="Last name!">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select a category!</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category_id') ? old('category_id') == $category->id : $contact->category_id == $category->id)>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') ?? $contact->email }}" placeholder="Email!">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" id="mobile" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile') ?? $contact->mobile_number }}" placeholder="Mobile!">
                                    @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" id="facebook" name="facebook"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        value="{{ old('facebook') ?? $contact->facebook }}" placeholder="Facebook!">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" id="instagram" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        value="{{ old('instagram') ?? $contact->instagram }}" placeholder="Instagram!">
                                    @error('instagram')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="text" id="youtube" name="youtube"
                                        class="form-control @error('youtube') is-invalid @enderror"
                                        value="{{ old('youtube') ?? $contact->youtube }}" placeholder="Youtube!">
                                    @error('youtube')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" name="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob') ?? $contact->dob }}" placeholder="Date of Birth!">
                                    @error('dob')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Address</label>
                                    <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Address!">{{ old('address') ?? $contact->address }}</textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
