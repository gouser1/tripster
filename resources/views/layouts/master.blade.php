
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Tripster | Home</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="/css/app.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    

    
  </nav>
  <!-- /.navbar -->




  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo Display -->
    <a href="index3.html" class="brand-link">
      <img src="./img/logo.png" alt="Tripster logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tripster</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <!-- Display user name !-->
              {{Auth::user()->name}}
               <!-- Display user type !-->
              <p>{{Auth::user()->type}}</p>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <!-- Route to Component !-->
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                Dashboard      
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/map" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                Map     
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user orange"></i>
              <p>
                Profile              
              </p>
            </router-link>
          </li>

          

          <li class="nav-item has-treeview" v-if="$gate.isAdminOrDriver()">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog green"></i>
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon teal"></i>
                  <p>Users</p>
                </router-link>
              
            </ul>
          </li>

          <li class="nav-item">
            <router-link to="/developer" class="nav-link" v-if="$gate.isAdmin()">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Developer              
              </p>
            </router-link>
          </li>
         

          <li class="nav-item">
           
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                   <i class="nav-icon fas fa-power-off red"></i>
                   <p>
                   {{ __('Logout') }}
                   </p>
                 
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <!-- Components from routes displayed in router-view !-->
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
    <!-- Default to the left -->
     All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<script>
@auth
window.user = @json(auth()->user())
@endauth
</script>
<!-- Import App.js Script !-->
<script src="/js/app.js"></script>
</body>
</html>
