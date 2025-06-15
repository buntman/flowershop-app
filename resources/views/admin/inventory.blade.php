<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="{{asset('css/sidebar-style.css')}}" rel="stylesheet">
  <link href="{{asset('/css/global-style.css')}}" rel="stylesheet">
  <link href="{{asset('/css/inventory-style.css')}}" rel="stylesheet">
</head>
    <body>

  <nav class="sb-topnav navbar navbar-expand ">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="d-sm-flex align-self-center align-items-center justify-content-between inventory w-100">
      <h2 class="page-title">Inventory</h2>
      <div class="inventory d-flex justify-content-center align-content-center mb-auto">
        <p class="mt-3">Admin</p>
        <img class="mx-5" src="{{asset('/images/icons/person.svg')}}" alt="">
      </div>
    </div>
  </nav>

<div id="layoutSidenav">
    <div class="d-flex flex-column sidebar" id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <h2 class="navbar-brand ps-4 pe-4 pb-0">Menu</h2>
        <div class="sb-sidenav-menu">
          <div class="nav">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
              <!-- INVENTORY -->
              <li class="my-2">
                <a href="/admin/inventory" class="nav-link border_bottom" title="Dashboard" data-bs-toggle="tooltip"
                  data-bs-placement="right">
                  <div class="border_box">
                  <i class="bi bi-database nav-icons"></i>
                  <p>Inventory</p>
                  </div>
                </a>
              </li>
              <!-- REPORTS -->
              <li class="my-2">
                <a href="/admin/reports" class="nav-link py-3 border_bottom" title="Orders" data-bs-toggle="tooltip"
                  data-bs-placement="right">
                  <div class="">
                    <i class="bi bi-clipboard-data"></i>
                    <p>Reports</p>
                  </div>
                </a>
              </li>
              <!-- MANAGE -->
              <li class="my-2">
                <a href="/admin/manage-account" class="nav-link" title="Products" data-bs-toggle="tooltip"
                  data-bs-placement="right">
                    <i class="bi bi-person-circle"></i>
                    <p>Manage</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- SIGN OUT -->
        <div class="sb-sidenav-footer">
          <form action="{{ route('logout') }}" method="POST"
            class="d-flex flex-column align-items-center justify-content-center link-dark text-decoration-none"
            style="cursor: pointer; border: none; background: none; padding: 0;">
            @csrf
            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
              <i class="bi bi-escape"></i>
              <p class="d-block p-exit">Sign Out</p>
            </button>
          </form>
        </div>
      </nav>
    </div>
    <!-- END OF NAVBAR -->

    <div id="layoutSidenav_content">
      <main>
                    <div class="d-flex justify-content-end">
        <button id="add_button" type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#add_form">Add Product
                    </button>
                    </div>
            <table class="table table-hover m-5">
                <tbody>
                @foreach ($products as $product)
                <tr>
                <td>
                    <img src="{{ route('products.image',$product->image_name) }}" width="90" height="90" class="rounded">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <button id="edit-button" type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm">
                    <i class="fas fa-pen"></i>
                    </button>
                    <button id="delete-button" type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm">
                    <i class="fas fa-trash"></i>
                    </button>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
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
      </main>
    </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/sidebar.js"></script>
</body>
</html>
