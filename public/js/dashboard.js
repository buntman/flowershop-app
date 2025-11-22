function displayOrderDetails(id) {
    fetch(`/dashboard/orders/${id}`)
    .then(response=> {
        if(!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data=> {
        modalBody = document.getElementById('modal_body');
        modalBody.innerHTML = "";
        data.forEach(item => {
                modalBody.innerHTML += `
            <div class="row mb-2 align-items-center">
            <div class="col-6">
                ${item.product_name}
            </div>
            <div class="col-3 text-center">
                ${item.quantity}
            </div>
            <div class="col-3 text-end">
                 ₱${item.price}
            </div>
            </div>
            `;
        });
        })
    .catch(error=> console.error('Error', error));
}
