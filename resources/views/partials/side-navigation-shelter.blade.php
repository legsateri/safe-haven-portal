<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePets" data-parent="#exampleAccordion">
            <i class="fa fa-paw" aria-hidden="true"></i>
            <span class="nav-link-text">Pets</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapsePets">
            <li>
              <a href="/pets"><i class="fa fa-home" aria-hidden="true"></i>
                Currently Accepted</a>
            </li>
            <li>
              <a href="/pets/in-need"><i class="fa fa-heart" aria-hidden="true"></i>
                 Pets in Need</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSettings" data-parent="#exampleAccordion">
            <i class="fa fa-sliders" aria-hidden="true"></i>
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
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>