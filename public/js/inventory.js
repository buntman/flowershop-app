token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); //retrieve csrf token in meta

function fetchProductToEdit(id) {
    fetch('/inventory/products', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({id})
    })
    .then(response=>response.json())
    .then(data=> {
            document.getElementById("edit-name").value = data.name;
            document.getElementById("edit-quantity").value = data.quantity;
            document.getElementById("edit-price").value = data.price;
        })
    .catch(error=> console.error('Error', error));
}
