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
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="{{asset('css/sidebar-style.css')}}" rel="stylesheet">
</head>
    <body>

  <nav class="sb-topnav navbar navbar-expand ">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="d-sm-flex align-self-center align-items-center justify-content-between inventory w-100">
      <h2 class="page-title">Inventory</h2>
      <div class="inventory d-flex justify-content-center align-content-center mb-auto">
        <p class="mt-3">Admin</p>
        <img class="mx-5" src="/images/icons/person.svg" alt="">
      </div> </div>
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
          <form action="/employee/logout" method="POST"
            class="d-flex flex-column align-items-center justify-content-center link-dark text-decoration-none"
            style="cursor: pointer; border: none; background: none; padding: 0;">
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
        <div class="container-fluid mt-5 px-5 ">
          <div class="container-fluid px-0 mt-4 main-table">
            <div class="card px-4 py-3">
              <table id="datatablesSimple" class="table table-hover" >
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date Completed</th>
                    <th>Phone Number</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>fad</td>
                    <td>fasfdas</td>
                    <td>fdasfsa</td>
                    <td>fdasfsa</td>
                    <td>fdafasf</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END OF TABLE -->
        </div>
      </main>
    </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/sidebar.js"></script>
</body>
</html>
