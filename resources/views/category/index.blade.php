@extends('layout.main')

@section('title', 'Categories')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Categories</h1>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Category
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Friends</td>
                                <td>Date</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        Edit
                                    </button>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="alert alert-info m-0">No record found!</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="add-alert"></div>
                    <form method="post" id="add-form">
                        @csrf
                        <div class="mb-3">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" name="add-name" id="add-name" class="form-control"
                                placeholder="Enter category name!">
                        </div>

                        <div>
                            <input type="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        const addFormElement = document.querySelector("#add-form");
        const addAlertElement = document.querySelector("#add-alert");

        addFormElement.addEventListener("submit", async function(e) {
            e.preventDefault();

            const addNameElement = document.querySelector("#add-name");

            let addNameValue = addNameElement.value;

            if (addNameValue == "") {
                addNameElement.classList.add('is-invalid');
                addAlertElement.innerHTML = alert("Provide the category name!");
            } else {
                addNameElement.classList.remove('is-invalid');
                addAlertElement.innerHTML = "";

                const token = document.querySelector("input[name='_token']").value;

                const data = {
                    name: addNameValue,
                    _token: token,
                };

                const response = await fetch("{{ route('api.category.create') }}", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const result = await response.json();

                const errors = result.errors;
                if (errors) {
                    if (errors.name) {
                        addNameElement.classList.add('is-invalid');
                        addAlertElement.innerHTML = alert(errors.name);
                    }
                }

                console.log(result);
            }
        });

        function alert(msg, cls = "danger") {
            return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
            ${msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
    </script>
@endsection
