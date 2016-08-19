<!-- Header -->
<div id="top-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-toggle"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('overview') }}">
                @if(Auth::check())
                SCS
                @else
                SQL Contribution System
                @endif
            </a>
        </div>
        @if(Auth::check())
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li{{ HTML::menu_active('entry_create') }}><a href="{{ URL::route('entry_create') }}"><i class="glyphicon glyphicon-plus"></i> New Entry</a></li>
            </ul>
            <div class="pull-right">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->username }} <span class="caret"></span></a>
                        <ul id="g-account-menu" class="dropdown-menu" role="menu">
                            <!-- <li><a href="#">My Profile</a></li> -->
                            @if(Auth::user()->can('administration'))
                                <li><a href="{{ URL::route('admin') }}">Administration</a></li>
                            @endif
                            <li><a href="{{ URL::route('doLogout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <form class="navbar-form navbar-right" role="search" action="{{ URL::route('search') }}">
                    <div class="form-group">
                      <input type="text" name="q" class="form-control page-search" placeholder="Search for anything...">
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div><!-- /container -->
</div>
<!-- /Header -->
