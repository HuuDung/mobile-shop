<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ route('home') }}" class="navbar-brand"><b>Shop Mobile</b></a>
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
                        <input type="text" class="form-control" style="min-width: 100%" name="content"
                               id="navbar-search-input" placeholder="Search...">
                    </div>
                </form>

            </div>

            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu col-md-4">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="{{ route('cart.index') }}">
                            <i class="fa fa-cart-plus"></i>
                            <span class="label label-success">{{ $cart }}</span>
                        </a>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tool<span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    {{--Member--}}
                                    <li><a href="{{ route('admin.member.index') }}"><i class="fa fa-users"></i>
                                            Members</a>
                                    </li>
                                    {{--Category--}}
                                    <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-database"></i>
                                            Categories</a>
                                    </li>
                                    <li><a href="{{ route('admin.category.create') }}"><i class="fa fa-pencil"></i>
                                            Create Category</a></li>
                                    {{--Product--}}
                                    <li><a href="{{ route('admin.product-administration.index') }}"><i
                                                    class="fa fa-database"></i>
                                            Products</a>
                                    </li>
                                    <li><a href="{{ route('admin.product-administration.create') }}"><i class="fa fa-pencil"></i>
                                            Create Product</a></li>
                                    {{--Rams--}}
                                    <li><a href="{{ route('admin.specificate.ram.index') }}"><i class="fa fa-database"></i>
                                            Rams</a>
                                    </li>
                                    <li><a href="{{ route('admin.specificate.ram.create') }}"><i
                                                    class="fa fa-pencil"></i>
                                            Create Ram</a></li>
                                    {{--CPU--}}
                                    <li><a href="{{ route('admin.specificate.cpu.index') }}"><i class="fa fa-database"></i>
                                            CPUs</a>
                                    </li>
                                    <li><a href="{{ route('admin.specificate.cpu.create') }}"><i class="fa fa-pencil"></i>
                                            Create CPU</a></li>
                                    {{--System--}}
                                    <li><a href="{{ route('admin.specificate.system.index') }}"><i class="fa fa-database"></i>
                                            Systems</a>
                                    </li>
                                    <li><a href="{{ route('admin.specificate.system.create') }}"><i class="fa fa-pencil"></i>
                                            Create System</a></li>
                                    {{--Storage--}}
                                    <li><a href="{{ route('admin.specificate.storage.index') }}"><i class="fa fa-database"></i>
                                            Storages</a>
                                    </li>
                                    <li><a href="{{ route('admin.specificate.storage.create') }}"><i class="fa fa-pencil"></i>
                                            Create Storage</a></li>
                                </ul>
                            </li>
                        </ul>
                @endif
                    <!-- User Account Menu -->

                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{ Storage::url(auth()->user()->avatar) }}" class="user-image"
                                         alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('add.balance') }}"><i class="fa fa-money"></i>
                                            Add Balance</a>
                                    </li>
                                    <li><a href="{{ route('history.index') }}"><i class="fa fa-history"></i>
                                            History</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.index') }}"><i class="fa fa-file-text"></i>Profile</a>

                                    </li>
                                    <li class="">
                                        <a href="{{ route('changepassword') }}" class=""><i class="fa fa-pencil"></i>Password</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>

                            </li>
                        </ul>


                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>