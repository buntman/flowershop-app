@extends('components.admin-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link href="{{asset('/css/inventory-style.css')}}" rel="stylesheet">
@section('title', 'Inventory')
@section('content')
            <div class="container">
            @include('shared.session-success-message')
            @include('shared.session-error-message')
            @include('shared.validation-error-message')
            <table id="inventory_table"class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
                <tbody>
                @foreach ($products as $product)
                <tr>
                <td>
                    <img src="{{ route('products.image',$product->image_name) }}" width="70" height="70" class="rounded">
                </td>
                <td class="align-middle">{{ $product->name }}</td>
                <td class="align-middle">{{ $product->quantity }}</td>
                <td class="align-middle">{{ $product->price }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center">
                    <div>
                    <button id="edit_button" type="button" rel="tooltip" class="btn btn-primary custom" data-bs-toggle="modal" data-bs-target="#edit_form" onclick="displayProductDetails({{ $product->id }})">
                                        Edit
                    </button>
                    </div>
                    <form class="m-0" action = "{{route('products.destroy', $product)}}" method="POST" onsubmit="return confirm('Remove product?')">
                        @csrf
                        @method('DELETE')
                    <button id="delete-button" type="submit" class="btn btn-danger custom ms-4">
                                        Delete
                    </button>
                    </form>
                    </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                    </div>
            {{-- Start of add product modal form --}}
            <div class="modal fade mt-5" id="add_form" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="form" action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input id="name" type="text" class="form-control" placeholder="Enter product name" name="name" value="{{old('name')}}" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="quantity" class="form-label">Stock Quantity</label>
                    <input id="quantity" type="number" class="form-control" placeholder="Enter quantity" min="1" name="quantity" value="{{old('quantity')}}" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" type="number" class="form-control" placeholder="Enter price" name="price" min="100" step="0.01" value="{{old('price')}}" required>
                </div>
            </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Select Image</label>
                    <input type="file" class="form-control" name="image"required value="">
                </div>
                <div class="button-container text-center">
                    <button id="submit" type="submit" class="btn btn-primary btn-md" name="submit" value="submit">Submit</button>
                </div>
            </form>
            </div>
            {{-- End of add product modal form --}}
      </main>
    </div>
            {{-- Start of edit product modal form --}}
            <div class="modal fade mt-5" id="edit_form" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Edit Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="form" action="{{route('products.edit')}}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" id="edit-productId" name="productId" value="" />
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="edit-name" class="form-label">Product Name</label>
                    <input id="edit-name" type="text" class="form-control" placeholder="Enter product name" name="name" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="edit-quantity" class="form-label">Stock Quantity</label>
                    <input id="edit-quantity" type="number" class="form-control" placeholder="Enter quantity" min="1" name="quantity" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="edit-price" class="form-label">Price</label>
                    <input id="edit-price" type="number" class="form-control" placeholder="Enter price" name="price" min="100" step="0.01" value="" required>
                </div>
            </div>
                <div class="button-container text-center">
                    <button id="submit" type="submit" class="btn btn-primary btn-md" name="submit" value="submit">Submit</button>
                </div>
            </form>
            </div>
            {{-- End of edit product modal form --}}
    </div>
<script>
$(document).ready(function() {
    $('#inventory_table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
    });
});
</script>
<script src="{{ asset('/js/inventory.js') }}"></script>
@endsection
