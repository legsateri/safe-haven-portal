<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item nav_item_logo_cont">
        <a class="navbar-brand pl-3" href="{{ route('user.dashboard') }}">
            <img src="{{url('/')}}/img/SHN-side-logo-2-ce9fc412115910e6ac7df874d95a98c9.png" class="logo nav-link-text"/>
            <img src="{{url('/')}}/img/SHN-side-logo-3-small.png" class="logo logo_collapsed_visible"/>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right">
      <a class="nav-link" href="{{ route('user.dashboard') }}">
        <i class="fa fa-fw fa-dashboard" title="Dashboard"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseClients" data-parent="#exampleAccordion">
        <i class="fa fa-user" aria-hidden="true" title="Clients"></i>
        <span class="nav-link-text">Clients</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseClients">
        <li>
          <a href="/clients"><i class="fa fa-users" aria-hidden="true"></i> Current Clients</a>
        </li>
        <li>
          <a href="/clients/in-need"><i class="fa fa-heart" aria-hidden="true"></i>
            Clients in Need</a>
        </li>
        <li>
          <a href="/application/new"><i class="fa fa-file-text" aria-hidden="true"></i>
            New Client Application</a>
        </li>
      </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSettings" data-parent="#exampleAccordion">
        <i class="fa fa-sliders" aria-hidden="true" title="My Settings"></i>
        <span class="nav-link-text"> Settings</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseSettings">
        <li>
          <a href="/organization"><i class="fa fa-university" aria-hidden="true"></i>
             My Organization</a>
        </li>
        <li>
          <a href="/account"><i class="fa fa-address-card" aria-hidden="true"></i>
             My Account</a>
        </li>
      </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right">
        <a href="mailto:webmaster@example.com" class="nav-link" >
            <i class="fa fa-envelope" aria-hidden="true" title="Contact SHN"></i>
            <span class="nav-link-text"> Contact SHN</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right">
        <a class="nav-link" data-toggle="modal" data-target="#logOutModal">
            <i class="fa fa-fw fa-sign-out" title="Logout"></i><span class="nav-link-text">Logout</span></a>
    </li>
</ul>
<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
      <a class="nav-link text-center" id="sidenavToggler">
        <i class="fa fa-fw fa-angle-left"></i>
      </a>
    </li>
</ul>