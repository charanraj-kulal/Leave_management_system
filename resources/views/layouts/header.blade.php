<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </ul>
<!-- for financial year -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <span class="d-none d-md-inline">Financial year</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           
            <li class= "dropdown-item">
                <p>
                    <strong>April 2022 - March 2023</strong>
                </p>

            </li>    
        </ul>
    </li>
    <!-- for User and logout -->
      <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary">
                  <p>
                      {{ Auth::user()->name }}                      
                      <small>Created On {{ Auth::user()->created_at->format('M, Y') }}</small>
                      <?php if (auth()->user()->user_group_id == '5') { print_r('Department : Sales'); } ?>
                  </p>

              </li> 
              <!-- Menu Footer-->
              <li class="user-footer">
                 
                  <a href="#" class="btn btn-default btn-flat float-center"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Sign out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </li>
          </ul>
      </li>
  </ul>
</nav>
<div class="mt-3" style="margin-left: 2rem">
<div class="col-md-8 mx-auto">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success!!</strong>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Unsuccess!!</strong>
        <span>{{ session('danger') }}</span>
    </div>
    @endif
</div>
</div>
