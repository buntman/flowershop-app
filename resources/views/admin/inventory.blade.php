@extends('components.admin-layout')

<link href="{{asset('/css/inventory-style.css')}}" rel="stylesheet">
@section('title', 'Inventory')

@section('content')
        <div class="d-flex justify-content-end">
        <button id="add_button" type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#add_form">Add Product
                    </button>
                    </div>
            <div class="container">
            <table class="table table-hover m-5">
                <tbody>
                <tr>
                    <th></th>
                    <th  class="text-center">Product Name</th>
                    <th  class="text-center">Quantity</th>
                    <th  class="text-center">Price</th>
                    <th  class="text-center">Actions</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                <td>
                    <img src="{{ route('products.image',$product->image_name) }}" width="90" height="90" class="rounded">
                </td>
                <td class="text-center align-middle">{{ $product->name }}</td>
                <td class="text-center align-middle">{{ $product->quantity }}</td>
                <td class="text-center align-middle">{{ $product->price }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                    <form action = "{{route('products.details', $product->id)}}" method="GET">
                        @csrf
                    <button id="edit_button" type="button" rel="tooltip" class="btn btn-primary custom" data-bs-toggle="modal" data-bs-target="#edit_form">
                                        Edit
                    </button>
                    </form>
                    <form action = "{{route('products.destroy', $product->id)}}" method="POST" onsubmit="return confirm('Remove product?')">
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
                    <input id="name" type="text" class="form-control" placeholder="Enter product name" name="name" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="quantity" class="form-label">Stock Quantity</label>
                    <input id="quantity" type="number" class="form-control" placeholder="Enter quantity" min="1" name="quantity" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" type="number" class="form-control" placeholder="Enter price" name="price" min="100" step="0.01" value="" required>
                </div>
            </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Select Image</label>
                    <input type="file" class="form-control" name="image"required>
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
            <form class="form" action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input id="name" type="text" class="form-control" placeholder="Enter product name" name="name" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="quantity" class="form-label">Stock Quantity</label>
                    <input id="quantity" type="number" class="form-control" placeholder="Enter quantity" min="1" name="quantity" value="" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" type="number" class="form-control" placeholder="Enter price" name="price" min="100" step="0.01" value="" required>
                </div>
            </div>
                <div class="button-container text-center">
                    <button id="submit" type="submit" class="btn btn-primary btn-md" name="submit" value="submit">Submit</button>
                </div>
            </form>
            </div>
            {{-- End of edit product modal form --}}
    </div>
@endsection
