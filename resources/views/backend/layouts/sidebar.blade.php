<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-crown"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SOTUMA Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('admin.dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Projets
    </div>

    <!-- Projects Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#projectCollapse" aria-expanded="true" aria-controls="projectCollapse">
          <i class="fas fa-project-diagram"></i>
          <span>{{ __('admin.projects') }}</span>
        </a>
        <div id="projectCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.project_options') }}:</h6>
            <a class="collapse-item" href="{{route('admin.projects.index')}}">{{ __('admin.project_list') }}</a>
            <a class="collapse-item" href="{{route('admin.projects.create')}}">{{ __('admin.add_project') }}</a>
            <a class="collapse-item" href="{{route('admin.projectcategory.index')}}">{{ __('admin.project_categories') }}</a>
            <a class="collapse-item" href="{{route('admin.projectcategory.create')}}">{{ __('admin.add_category') }}</a>
          </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Produits
    </div>

    <!-- Products Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>{{ __('admin.products') }}</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('admin.product_options') }}:</h6>
            <a class="collapse-item" href="{{route('admin.product.index')}}">{{ __('admin.product_list') }}</a>
            <a class="collapse-item" href="{{route('admin.product.create')}}">{{ __('admin.add_product') }}</a>
            <a class="collapse-item" href="{{route('admin.category.index')}}">{{ __('admin.product_categories') }}</a>
            <a class="collapse-item" href="{{route('admin.category.create')}}">{{ __('admin.add_category') }}</a>
          </div>
        </div>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('review.index')}}">
            <i class="fas fa-comments"></i>
            <span>{{ __('admin.client_reviews') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Médias
    </div>

    <!-- Media Management -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mediaCollapse" aria-expanded="true" aria-controls="mediaCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>{{ __('admin.media') }}</span>
      </a>
      <div id="mediaCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{{ __('admin.media_options') }}:</h6>
          <a class="collapse-item" href="{{route('post.index')}}">{{ __('admin.article_list') }}</a>
          <a class="collapse-item" href="{{route('post.create')}}">{{ __('admin.add_article') }}</a>
          <a class="collapse-item" href="{{route('post-category.index')}}">{{ __('admin.article_categories') }}</a>
          <a class="collapse-item" href="{{route('post-category.create')}}">{{ __('admin.add_category') }}</a>
        </div>
      </div>
    </li>

    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('comment.index')}}">
            <i class="fas fa-comments"></i>
            <span>{{ __('admin.comments') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Certificats
    </div>

    <!-- Certificates Management -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#certificateCollapse" aria-expanded="true" aria-controls="certificateCollapse">
        <i class="fas fa-certificate"></i>
        <span>{{ __('admin.certificates') }}</span>
      </a>
      <div id="certificateCollapse" class="collapse" aria-labelledby="headingCert" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{{ __('admin.certificate_options') }}:</h6>
          <a class="collapse-item" href="{{ route('admin.certificate.index') }}">{{ __('admin.certificate_list') }}</a>
          <a class="collapse-item" href="{{ route('admin.certificate.create') }}">{{ __('admin.add_certificate') }}</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Pages
    </div>

    <!-- About Us Images Management retired - now managed in Settings -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion des Utilisateurs
    </div>

    <!-- Users Management (Admin Only) -->
    @if(Auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>{{ __('admin.users') }}</span></a>
    </li>
    @endif

    <!-- Messages -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('message.index')}}">
            <i class="fas fa-envelope"></i>
            <span>{{ __('admin.messages') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Configuration
    </div>

    <!-- Settings (Admin Only) -->
    @if(Auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>{{ __('admin.settings') }}</span></a>
    </li>
    @endif

    <!-- Analytics -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.analytics') }}">
            <i class="fas fa-chart-line"></i>
            <span>{{ __('admin.analytics') }}</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>