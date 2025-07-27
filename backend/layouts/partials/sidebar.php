<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      
      <!-- #################### Admin Section #################### -->
      <li class="nav-item sidebar-heading">
        <span class="text-uppercase fw-bold small text-muted">Admin</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/demoshop/backend/pages/dashboard.php">
          Dashboard
        </a>
      </li>
      <hr style="border: 1px solid red; width: 80%;" />

      <!-- #################### Product Section #################### -->
      <li class="nav-item sidebar-heading mt-3">
        <span class="text-uppercase fw-bold small text-muted">Product</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Product
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/demoshop/backend/functions/product/index.php">Product List</a></li>
          <li><a class="dropdown-item" href="/demoshop/backend/functions/product/create.php">Create</a></li>
        </ul>
      </li>

      <!-- #################### User Section #################### -->
      <li class="nav-item sidebar-heading mt-3">
        <span class="text-uppercase fw-bold small text-muted">User</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          User
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/demoshop/backend/functions/user/index.php">User List</a></li>
          <li><a class="dropdown-item" href="/demoshop/backend/functions/user/create.php">Create</a></li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
