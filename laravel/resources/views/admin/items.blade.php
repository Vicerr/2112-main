<html lang="en">

<!DOCTYPE html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>21/12 | Products</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="{{ asset('images/kaiadmin/favicon.ico') }}" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
  
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a style="color: white; font-weight: bold;
            text-decoration: none;" href="{{ route('dashboard') }}" class="logo">
            <!-- <img src="../assets-dashboard/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" /> -->
            <p style="margin-bottom: 0;">DASHBOARD</p>
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Overview</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('create') }}">
                <i class="fas fa-th-list"></i>
                <p>Create Products</p>
              </a>

            </li>
            <li class="nav-item">
              <a href="{{ route('orders') }}">
                <i class="fas fa-pen-square"></i>
                <p>Manage Orders</p>

              </a>
            <li class="nav-item">
              <a href="{{ route('items') }}">
                <i class="fas fa-pen-square"></i>
                <p>Manage Products</p>

              </a>
              <!-- <li class="nav-item">
              <a href="/dashboard/orders">
                <i class="fas fa-pen-square"></i>
                <p>Orders</p>

              </a>
            </li> -->


          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->
    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="{{ asset('images/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <!-- <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
              </div> -->
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <!-- <div class="avatar-sm">
                    <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                  </div> -->
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ auth()->user()->first_name }}</span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
      <div class="container">
        <div class="page-inner">
          <div class="row">
              <x-flash-message />
              <x-error-message /> 
              <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; ">
                  <h4 class="card-title">Products List</h4>
                  <div class="d-flex">
                      <div class="dropdown">
                        <button class="btn btn-label-info btn-round me-2 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort By
                        </button>
                        @php
                          $array = [];
                          if (count(request()->query()) > 0 && empty(request()->input('sort'))) {
                            $array = request()->query();
                            unset($array['sort']);
                            $message = "&".http_build_query($array);
                          } elseif (count(request()->query()) > 1 && !empty(request()->input('sort'))) {
                            $array = request()->query();
                            unset($array['sort']);
                            $message = "&".http_build_query($array);
                          } elseif (count(request()->query()) == 1 && !empty(request()->input('sort'))) {
                            unset($array['sort']);
                            $message = "";
                          } else {
                            $message = "";
                          }
                        @endphp
                        <ul class="dropdown-menu dropdown-menu-lg" aria-labelledby="dropdownMenuButton1">
                            <li class="border-bottom px-2">
                              <a class="dropdown-item" href="/items?sort=date-asc{{ $message }}">Newest product first</a>
                            </li>
                            <li class="border-bottom p-2">
                              <a class="dropdown-item" href="/items?sort=date-desc{{ $message }}">Oldest product first</a>
                            </li>
                            <li class="border-bottom pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=name-asc{{ $message }}">Name A &RightArrow; Z </a>
                            </li>
                            <li class="border-bottom pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=name-desc{{ $message }}">Name Z &RightArrow; A</a>
                            </li>
                            <li class="border-bottom pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=price-asc{{ $message }}">Lowest price first</a>
                            </li>
                            <li class="pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=price-desc{{ $message }}">Highest price first</a>
                            </li>
                            <li class="pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=unavailable{{ $message }}">Products not in stock</a>
                            </li>
                            <li class="pt-2 px-2">
                              <a class="dropdown-item" href="/items?sort=available{{ $message }}">Products in stock</a>
                            </li>
                        </ul>
                      </div>
                      <div>
                        <form action="{{ route('items') }}" method="get">
                          <div class="input-group">
                            <input name="search" type="text" class="flex-md-grow-1  form-control" placeholder="Search product name or tag" aria-label="Search">
                            <div class="input-group-append">
                              <button class="btn btn-label-info btn-outline-secondary" type="submit">Search</button>
                            </div>
                          </div> 
                        </form>
                      </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Date Created</th>
                          <!-- <th>ID</th> -->
                          <th>Product Name</th>
                          <th>Color</th>
                          <th>Price</th>
                          <th>Tag</th>
                          <th>Stock</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        <tr>
                          <td>
                            {{ $product->created_at->format('M d, Y') }}
                            <br>
                            {{ $product->created_at->format('h:i A') }}
                          </td>
                          <!-- <td><%= item._id %> </td> -->
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->color }}</td>
                          <td>&#x20a6 {{ number_format($product->price) }}</td>
                          <td>{{ $product->tag }}</td>
                          <td>{{ $product->stock }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-label-info btn-round dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <ul class="dropdown-menu dropdown-menu-lg" aria-labelledby="dropdownMenuButton1">
                                <li class="border-bottom pb-2 px-2">
                                  <a class="dropdown-item" href="/product/{{ $product->id }}"> View Product </a>
                                </li>
                                <li class="border-bottom p-2">
                                  <a class="dropdown-item" href="/product/edit/{{ $product->id }}">Edit Product</a>
                                </li>
                                <li class="pt-2 px-2">
                                  <form action="/product/cancel/{{ $product->id }}" method="DELETE" class="dropdown-item">
                                    @csrf
                                      <button type="submit" style="all:unset;">Delete Product</button>
                                  </form>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination__container">{{ $products->appends(request()->except('page'))->links('pagination::default') }}</div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <script>
        function triggerDeleteBtn() {
          let confirmDeletion = confirm("Are you sure you want to delete all products from database?")
          if (confirmDeletion) {
            document.getElementById('deleteAll').click()
          }
        }
      </script>
  <!-- Custom template | don't include it in your project! -->

  <!-- End Custom template -->
  <!--   Core JS Files   -->
  <script language="JavaScript" type="text/javascript" src="http://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/f71a44a4e4.js" crossorigin="anonymous"></script>
  
  <!-- JAVASCRIPT FILES -->
  <script language="JavaScript" type="text/javascript" src="{{asset('js/main.js')}}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

  <!-- Chart JS
  <script src="/assets-dashboard/js/plugin/chart.js/chart.min.js"></script> -->

  <!-- jQuery Sparkline
  <script src="/assets-dashboard/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script> -->

  <!-- Datatables -->
  <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>

  <!-- Bootstrap Notify
  <script src="/assets-dashboard/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

  <!-- jQuery Vector Maps
  <script src="/assets-dashboard/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="/assets-dashboard/js/plugin/jsvectormap/world.js"></script> -->

  <!-- Sweet Alert
  <script src="/assets-dashboard/js/plugin/sweetalert/sweetalert.min.js"></script> -->

  <!-- Kaiadmin JS -->
  <script src="{{ asset('js/kaiadmin.min.js') }}"></script>
</body>

</html>