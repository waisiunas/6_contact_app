const addFormElement = document.querySelector("#add-form");

        addFormElement.addEventListener("submit", function(e) {
            e.preventDefault();

            const addNameElement = document.querySelector("#add-name");

            let addNameValue = addNameElement.value;

            if (addNameValue == "") {
                addNameElement.classList.add('is-invalid');
            }
        })
