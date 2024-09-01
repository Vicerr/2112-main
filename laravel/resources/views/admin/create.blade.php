<html lang="en">

<!DOCTYPE html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Dashboard</title>
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
              <form class="card" id="upload-form" method="post" action="/product/create" enctype="multipart/form-data">
                <div class="card-header">
                  <div class="card-title">Create Item</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" name="name" required value="{{ old('name') }}" placeholder="Product Name" />
                        @error('name')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="product-price">Product Price</label>
                        <input pattern="\d+" title="must be a positive number" type="number" min="1" class="form-control" name="price" required value="{{ old('price') }}" placeholder="Product Price" />
                        @error('price')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="product-price">Product Description</label>
                        <textarea type="textarea" class="form-control" name="desc" value="{{ old('desc') }}" required placeholder="Product Description"></textarea>
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
                            <input type="text" required class="form-control" id="text" name="tag" value="{{ old('tag') }}" placeholder="Tag" />
                            @error('tag')
                              <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" required name="color" class="form-control" value="{{ old('color') }}" placeholder="Enter Valid Color Name" />
                            @error('color')
                              <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="password">Upload 5 Images</label>
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
                  <button type="submit" class="btn btn-success submit-add-item">Submit</button>
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

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on("change", function() {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function() {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
    let uploadForm = document.getElementById("upload-form")
    let uploadImages = document.getElementById("image-upload")
    let errMessage = document.getElementById("img-err-text")

    function validateFiles() {
      let files = uploadImages.files
      errMessage.textContent = ''
      let isValid = true
      if (files.length !== 5) {
        errMessage.textContent = "Upload exactly 5 images"
        uploadImages.value = ""
        isValid = false
      }
      Array.from(files).forEach(file => {
        if (file.size > 1 * 1024 * 1024) {
          errMessage.textContent = `${file.name} is bigger than 1mb`
          isValid = false
        }

      })

      return isValid
    }
    uploadImages.addEventListener("change", validateFiles)
    uploadForm.addEventListener("submit", function(e) {
      let valid = validateFiles()
      if (!valid) {
        e.preventDefault()
      }
    })
    console.log(isValid)
  </script>

</body>

</html>