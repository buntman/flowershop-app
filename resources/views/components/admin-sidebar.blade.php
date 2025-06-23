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
