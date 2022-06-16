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

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
      <li class="nav-item">
        <router-link to="/customers" class="nav-link">
          <i class="nav-icon fas fa-user-tag grey"></i>
          <p>
            Customers
          </p>
        </router-link>
      </li>
      <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
      <li class="nav-item">
        <router-link to="/products" class="nav-link">
          <i class="nav-icon fas fa-list grey"></i>
          <p>
            Items
          </p>
        </router-link>
      </li>
      <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
      <li class="nav-item">
        <router-link to="/serialnos" class="nav-link">
          <i class="nav-icon fas fa-barcode grey"></i>
          <p>
            Serial Numbers
          </p>
        </router-link>
      </li>
      <?php endif; ?>

      


      <li class="nav-item">
        <router-link to="/Returns" class="nav-link">
          <i class="fa fa-arrow-left nav-icon grey"></i>
          <p>Returns</p>
        </router-link>
      </li>


      

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>
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
          
    

          
          
            
        </ul>
      </li>

      <?php endif; ?>
      
      <li class="nav-item">
        <a class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off grey"></i>
          <p>
            <?php echo e(__('Logout')); ?>

          </p>
        </a>
       
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
        </form>
      </li>
    </ul>
  </nav>

  

<?php /**PATH C:\Users\Abi\open-pos-inventory-laravelvue\resources\views/layouts/sidebar-menu.blade.php ENDPATH**/ ?>