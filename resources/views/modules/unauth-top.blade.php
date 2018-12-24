<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ route('home') }}" class="navbar-brand"><b>Gốm Sứ</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <form action="{{ route('home.product.search') }}" class="navbar-form navbar-left" role="search"
                      method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="content" id="navbar-search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login
                        </a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>

            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>