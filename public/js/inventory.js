token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); //retrieve csrf token in meta
currentProductId = null;

function fetchProductToEdit(id) {
    currentProductId = id;
    fetch(`/inventory/products/${id}`)
    .then(response=> {
        if(!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data=> {
            document.getElementById("edit-name").value = data.name;
            document.getElementById("edit-quantity").value = data.quantity;
            document.getElementById("edit-price").value = data.price;
        })
    .catch(error=> console.error('Error', error));
}

function update(event) {
    event.preventDefault();
    const formData = new FormData(event.target); //collect all input fields that was submitted
    const body = Object.fromEntries(formData.entries()); //convert into object
    fetch(`/inventory/products/${currentProductId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(body)
    })
    .then(response=> {
        if(!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data=> {
            if(data.success) {
                alert(data.message);
            }
        })
    .catch(error=> console.error('Error', error));
}
