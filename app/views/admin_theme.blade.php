<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('assets/css/bootstrap.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('assets/css/admin.css')}}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    {{HTML::script('assets/js/jquery-1.11.0.min.js')}}
    {{HTML::script('assets/js/jquery-ui-1.10.4.custom.min.js')}}
    {{HTML::script('assets/js/bootstrap.min.js')}}
    {{HTML::script('assets/js/jquery-validate/jquery.validate.js')}}


  </head>

  <body>

    <!-- Fixed navbar -->

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SM Shop - Administrator</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Users<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{Asset('admin/manage-user')}}">Manage Users</a></li>
                <li class="hidden-xs"><a href="{{Asset('admin/create-user')}}">Create user</a></li>
              </ul>
            </li>

            <li class="dropdown hidden-xs">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Items<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{Asset('admin/create-item')}}">Create Item</a></li>
                <li><a href="{{Asset('admin/manage-items')}}">Manage Items</a></li>
              </ul>
            </li>
            
            <li class="dropdown hidden-xs">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Order<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{Asset('admin/order-report')}}">Order Report</a></li>
                <li><a href="{{Asset('admin/passenger-list')}}">Passenger List</a></li>
              </ul>
            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right hidden-xs">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{ucfirst(Session::get('user_admin'))}}</a></li>
              <li><a href="{{Asset('admin/logout')}}"><span class="glyphicon glyphicon-log-out"></span> Signout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Begin page content -->

    <div id="content">@yield('content')</div>

    <div id="footer" class="hidden-print">
      <div class="container">
        <span class="text-muted">Copyright &copy; 2014, SM - Shop</span><br/>
        <span class="text-muted">Design by Minh Giang</span><br/>
        <span class="text-muted">Mail to: <a href="mailto:minhgiang0801@outlook.com">minhgiang0801@outlook.com</a></span>
      </div>
    </div>


  </body>
</html>
