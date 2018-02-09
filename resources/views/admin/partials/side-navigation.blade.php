<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="/admin/dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers" data-parent="#exampleAccordion">
            <i class="fa fa-handshake-o" aria-hidden="true"></i>

            <span class="nav-link-text">Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseUsers">
            <li>
              <a href="{{ route('admin.users.advocates.list') }}"><i class="fa fa-balance-scale"></i> Advocates</a>
            </li>
            <li>
              <a href="{{ route('admin.users.shelters.list') }}"><i class="fa fa-home"></i> Shelters</a>
            </li>
            <li>
              <a href="{{ route('admin.users.user_add.list') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>
                 Add User</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Clients">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseClients" data-parent="#exampleAccordion">

            <i class="fa fa-user" aria-hidden="true"></i>

            <span class="nav-link-text">Clients</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseClients">
            <li>
              <a href="/admin/clients/clients-all"><i class="fa fa-users" aria-hidden="true"></i> All Clients</a>
            </li>
            <li>
              <a href="/admin/clients/pets-all"><i class="fa fa-paw" aria-hidden="true"></i>
                All Pets</a>
            </li>
            <li>
              <a href="/admin/clients/applications"><i class="fa fa-book" aria-hidden="true"></i>
                Applications</a>
            </li>
            <li>
              <a href="/admin/clients/client-add"><i class="fa fa-user-plus" aria-hidden="true"></i>
                Add Client</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Clients">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSettings" data-parent="#exampleAccordion">

            <i class="fa fa-sliders" aria-hidden="true"></i>

            <span class="nav-link-text">Settings</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseSettings">
            <li>
              <a href="/admin/settings/application"><i class="fa fa-sliders" aria-hidden="true"></i>
                Application Settings</a>
            </li>
            <li>
              <a href="/admin/settings/admin-users"><i class="fa fa-user-secret" aria-hidden="true"></i>

                Admin Users</a>
            </li>
            <li>
              <a href="/admin/settings/account"><i class="fa fa-address-card" aria-hidden="true"></i>
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