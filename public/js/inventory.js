function displayProductDetails(id) {
    fetch(`/inventory/products/${id}`)
    .then(response=> {
        if(!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data=> {
            document.getElementById("edit-productId").value = id;
            document.getElementById("edit-name").value = data.name;
            document.getElementById("edit-quantity").value = data.quantity;
            document.getElementById("edit-price").value = data.price;
        })
    .catch(error=> console.error('Error', error));
}
