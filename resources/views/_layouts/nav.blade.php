<div class="am-collapse am-topbar-collapse" id="collapse-head">
  @if (Auth::check())
    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> {{{ Auth::user()->nickname }}} <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="{{ URL::to('logout') }}"><span class="am-icon-power-off"></span> Exit</a></li>
        </ul>
      </li>
    </ul>
  @else
    <div class="am-topbar-right">
      <a href="{{ URL::to('login') }}" class="am-btn am-btn-primary am-topbar-btn am-btn-sm topbar-link-btn"><span class="am-icon-user"></span> Login</a>
    </div>
  @endif
</div>
