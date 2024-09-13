<html lang="en">

<!DOCTYPE html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Product Editor</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="{{ asset('images/kaiadmin/favicon.ico') }}" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/image-uploader.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
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
            <div class="col-md-12">
              <x-flash-message />
              <x-error-message /> 
              <form class="card" id="upload-form" method="post" action="/product/edit" enctype="multipart/form-data">
                @csrf
                  <div class="card-header">
                  <div class="card-title">Create Item</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                      </div>
                      <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" name="name" required value="{{ $product->name }}" placeholder="Product Name" />
                        @error('name')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="product-price">Product Price (&#x20a6) </label>
                        <input pattern="\d+" title="must be a positive number" type="number" min="1" class="form-control" name="price" required value="{{ $product->price }}" placeholder="Product Price" />
                        @error('price')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="product-price">Product Description</label>
                        <textarea type="textarea" class="form-control" name="desc" required placeholder="Product Description">{{ $product->desc }}</textarea>
                        @error('desc')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row ">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="tag">Tag</label>
                            <input type="text" required class="form-control" id="text" name="tag" value="{{ $product->tag }}" placeholder="Tag" />
                            @error('tag')
                              <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" required name="color" class="form-control" value="{{ $product->color }}" placeholder="Enter Valid Color Name" />
                            @error('color')
                              <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="password">Re-upload 5 Images</label>
                            <div id="app"></div>
                            <input type="file" id="fileInput" multiple name="file[]" hidden value="{{ old('file') }}" />
                            @error('file')
                              <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                            @enderror
                            <div class="uploader" id="fileSelect">
                              <div id="content" class="content">
                                <p id="content-action">
                                </p>
                              </div>
                            </div>
                            <div id="oit" class="other-image-thumbnails"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-action">
                  <button type="submit" class="btn btn-success submit-add-item">Edit</button>
                  <button type="reset" class="btn btn-danger">Cancel</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Custom template | don't include it in your project! -->

  <!-- End Custom template -->
  <!--   Core JS Files   -->
  <script language="JavaScript" type="text/javascript" src="http://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/f71a44a4e4.js" crossorigin="anonymous"></script>

  <!-- JAVASCRIPT FILES -->
  <script language="JavaScript" type="text/javascript" src="{{asset('js/main.js')}}"></script>
  <script type="module" src="{{ asset('js/imageUploader.js')}}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
</body>

</html>