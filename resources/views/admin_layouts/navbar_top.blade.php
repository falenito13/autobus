<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">

        <ul class="nav navbar-top-links navbar-left">
            <li class="ms-hover"><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="in">
            @foreach($supportedLocales as $key => $locale)
                <li class="{{ localization()->getCurrentLocale() == $key ? 'active' : '' }}">
                    <a href="{{ localization()->getLocalizedURL($key) }}" rel="alternate" hreflang="{{ $key }}">
                        {{ $locale->native() }}
                    </a>
                </li>
            @endforeach
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs">Admin</b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-text">
                                <h4>Admin</h4>
{{--                                <p class="text-muted">{{ Auth::user()->username }}</p>--}}
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-power-off"></i> {{ Lang::get('global.logout')}}</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
