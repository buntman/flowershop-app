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

$(document).ready(function() {
    let table = new DataTable('#inventory_table', {
        info: false,
        ordering: true,
        paging: false,
        dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rtip',
        columnDefs: [
                {
                    targets: '_all',
                    className: 'text-start'
                    }
        ],
        buttons: [
            {
                text: 'Add Product',
                className: 'btn btn-success',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#add_form'
                },
                action: function ( e, dt, node, config ) {
                }
            },
        ]
    });
});
