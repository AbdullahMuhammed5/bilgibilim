<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>bilgibilim | Dashboard </title>

    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    @stack('datatable-css')
    @stack('icheck-css')
    <link href="{{ asset('css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/toggleButton.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/custom.css')}}" rel="stylesheet">

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            @if(auth()->user()->getRoleNames()[0] == "admin")
                            <img alt="image" class="img-circle"
                                 src="{{ auth()->user()->staff->image ? Storage::url(auth()->user()->staff->image->path) : asset('img/avatardefault.png') }}"
                            style="width: 40px"/>
                            @else
                            <img alt="image" class="img-circle"
                                 src="{{ asset('img/avatardefault.png') }}"
                                 style="width: 40px; border-radius: 50%"/>
                            @endif
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        {{ ucfirst(auth()->user()->first_name) . ' ' . ucfirst(auth()->user()->last_name)}}
                                    </strong>
                             </span>
                                <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ asset('profile.html') }}">Profile</a></li>
                            <li><a href="{{ asset('contacts.html') }}">Contacts</a></li>
                            <li><a href="{{ asset('mailbox.html') }}">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a class="fa fa-sign-out dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                @can('role-list')
                <li class="{{ Request::is('roles', 'roles/*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Roles</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('roles.index') }}">All</a></li>
                        @can('role-create')
                        <li><a href="{{ route('roles.create') }}">Add Role</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('city-list')
                <li class="{{ Request::is('cities', 'cities/*') ? 'active' : '' }}">
                    <a href="{{ route('cities.index') }}"><i class="fa fa-building"></i> <span class="nav-label">Cities</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('cities.index') }}">All</a></li>
                        @can('city-create')
                            <li><a href="{{ route('cities.create') }}">Add City</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('job-list')
                <li class="{{ Request::is('jobs', 'jobs/*') ? 'active' : '' }}">
                    <a href="{{ route('jobs.index') }}"><i class="fa fa-briefcase"></i> <span class="nav-label">Jobs</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('jobs.index') }}">All</a></li>
                        @can('job-create')
                            <li><a href="{{ route('jobs.create') }}">Add Job</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('staff-list')
                <li class="{{ Request::is('staffs', 'staffs/*') ? 'active' : '' }}">
                    <a href="{{ route('staffs.index') }}"><i class="fa fa-users"></i><span class="nav-label">Staff</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('staffs.index') }}">All</a></li>
                        @can('job-create')
                            <li><a href="{{ route('staffs.create') }}">Add Staff</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('news-list')
                    <li class="{{ Request::is('news', 'news/*') ? 'active' : '' }}">
                        <a href="{{ route('news.index') }}"><i class="fa fa-code"></i><span class="nav-label">News</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('news.index') }}">All</a></li>
                            @can('news-create')
                                <li><a href="{{ route('news.create') }}">Add news</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('category-list')
                    <li class="{{ Request::is('categories', 'categories/*') ? 'active' : '' }}">
                        <a href="{{ route('jobs.index') }}"><i class="fa fa-briefcase"></i> <span class="nav-label">Categories</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('categories.index') }}">All</a></li>
                            @can('category-create')
                                <li><a href="{{ route('categories.create') }}">Add Category</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                    <li><a class="fa fa-sign-out dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

            </nav>
        </div>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Data Tables</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    <?php
                        use Illuminate\Support\Facades\DB;
                        $segments = '';
                        ?>
                        @foreach(Request::segments() as $segment)
                            @if (!Request::is('staffs/*') && !Request::is('categories/*')
                                && !Request::is('news/*')))
                            <?php $segments .= '/'.$segment;?>
                            <li>
                                @if(is_numeric($segment))
                                    <?php $name = DB::table(Request::segments()[0])->select('name')->whereId($segment)->first()->name?>
                                    <a href="{{ $segments }}" class="active">{{ucfirst($name)}}</a>
                                @else
                                    <a href="{{ $segments }}" class="active">{{ucfirst($segment)}}</a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            @yield('content')
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2017
    </div>
</div>


<!-- Mainly scripts -->
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Jvectormap -->
<script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- iCheck -->
<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

<script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>

<!-- Data picker -->
{{--<script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>--}}

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('js/plugins/fullcalendar/moment.min.js') }}"></script>

<!-- Date time picker -->
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- DROPZONE -->
<script src="{{ asset('js/plugins/dropzone/dropzone.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Page-Level Scripts -->
@stack('datatable')
@stack('ckeditor')
@stack('JSValidatorScript')
</body>
</html>
