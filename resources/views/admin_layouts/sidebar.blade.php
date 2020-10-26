<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
            <span class="fa-fw open-close">
                <i class="ti-close ti-menu"></i>
            </span>
            <span class="hide-menu">autobus.ge</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu" style="margin-top: 60px">
            <li>
                <a href="{{route('admin_home')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.dashboard')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.contact.edit',1)}}" class="waves-effect">
                    <i class="mdi mdi-language-html5 fa-fw"></i>
                    <span class="hide-menu"> {{ Lang::get('global.contact')}} </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.slider')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.slider')}}</span>
                </a>
<li>
                <a href="{{route('admin.categories')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.categories')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.service')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.service')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.blog')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.blog')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.additionalService')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.additionalService')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.whoweare')}}" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw"></i>
                    <span class="hide-menu">{{ Lang::get('global.whoweare')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.translations')}}" class="waves-effect">
                    <i class="mdi mdi-language-html5 fa-fw"></i>
                    <span class="hide-menu"> {{ Lang::get('global.translations')}} </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.meta')}}" class="waves-effect">
                    <i class="mdi mdi-language-html5 fa-fw"></i>
                    <span class="hide-menu"> {{ Lang::get('global.meta')}} </span>
                </a>
            </li>
        </ul>
    </div>
</div>
