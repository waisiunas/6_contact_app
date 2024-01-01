showCategories();

const addFormElement = document.querySelector("#add-form");
const addAlertElement = document.querySelector("#add-alert");

addFormElement.addEventListener("submit", async function (e) {
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

        const APIURL = addFormElement.action;

        const response = await fetch(APIURL, {
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
        } else if (result.failure) {
            addAlertElement.innerHTML = alert(result.failure);
        } else if (result.success) {
            addAlertElement.innerHTML = alert(result.success, "success");
            addNameElement.value = "";
        } else {
            addAlertElement.innerHTML = alert("Something went wrong!");
        }
    }
});

async function showCategories() {
    const responseElement = document.querySelector("#response");

    const response = await fetch(showAllAPIURL);
    const result = await response.json();

    if (result.categories.length > 0) {
        let rows = "";

        result.categories.forEach(function (category, index) {
            rows += `<tr>
            <td>${index + 1}</td>
            <td>${category.name}</td>
            <td>
                <button type="button" class="btn btn-primary" onclick="editCategory(${category.id})" data-bs-toggle="modal"
                    data-bs-target="#editModal">
                    Edit
                </button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    Delete
                </button>

            </td>
        </tr>`;
        });
        responseElement.innerHTML = `<table class="table table-bordered m-0">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            ${rows}
        </tbody>
    </table>`;
    } else {
        responseElement.innerHTML = `<div class="alert alert-info m-0">No record found!</div>`;
    }
}

async function editCategory(id) {
    const apiUrl = showSingleAPIURL.replace(':id', id);
    const response = await fetch(apiUrl);
    const result = await response.json();

    const editNameElement = document.querySelector("#edit-name");
    editNameElement.value = result.category.name;
}

const editFormElement = document.querySelector("#edit-form");
const editAlertElement = document.querySelector("#edit-alert");

editFormElement.addEventListener("submit", function (e) {
    e.preventDefault();
});

function alert(msg, cls = "danger") {
    return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
            ${msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
}
