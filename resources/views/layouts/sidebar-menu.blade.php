<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt grey"></i>
          <p>
            DASHBOARD
          </p>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/invoice" class="nav-link">
          <i class="nav-icon fas fa-tag grey"></i>
          <p>
          Invoice
          </p>
        </router-link>
      </li> 

      @can('isAdmin')
      <li class="nav-item">
        <router-link to="/customers" class="nav-link">
          <i class="nav-icon fas fa-user-tag grey"></i>
          <p>
            Customers
          </p>
        </router-link>
      </li>
      @endcan

      @can('isAdmin')
      <li class="nav-item">
        <router-link to="/products" class="nav-link">
          <i class="nav-icon fas fa-list grey"></i>
          <p>
            Items
          </p>
        </router-link>
      </li>
      @endcan

      @can('isAdmin')
      <li class="nav-item">
        <router-link to="/serialnos" class="nav-link">
          <i class="nav-icon fas fa-barcode grey"></i>
          <p>
            Serial Numbers
          </p>
        </router-link>
      </li>
      @endcan

      {{-- @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon grey"></i>
            <p>Users</p>
          </router-link>
        </li>
      @endcan --}}


      <li class="nav-item">
        <router-link to="/Returns" class="nav-link">
          <i class="fa fa-arrow-left nav-icon grey"></i>
          <p>Returns</p>
        </router-link>
      </li>


      

      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog grey"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/product/category" class="nav-link">
              <i class="nav-icon fas fa-list-ol grey"></i>
              <p>
                Category
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/users" class="nav-link">
              <i class="fa fa-users nav-icon grey"></i>
              <p>Users</p>
            </router-link>
          </li>
          
    

          {{-- <li class="nav-item">
            <router-link to="/product/tag" class="nav-link">
              <i class="nav-icon fas fa-tags grey"></i>
              <p>
                Tags
              </p>
            </router-link>
          </li> --}}
          
            {{-- <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs grey"></i>
                  <p>
                      Developer
                  </p>
              </router-link>
            </li> --}}
        </ul>
      </li>

      @endcan
      
      <li class="nav-item">
        <a class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off grey"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
       
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>

  

