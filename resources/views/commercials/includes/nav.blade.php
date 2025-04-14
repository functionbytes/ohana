
<aside class="left-sidebar">
  <div>
    <nav class="sidebar-nav scroll-sidebar container-fluid">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        </li>
            <li class="sidebar-item">
              <a class="sidebar-link " href="{{  route('home') }}" aria-expanded="false" >
                <span>
                   <i class="fa-duotone fa-house"></i>
                </span>
                <span class="hide-menu">Inicio</span>
              </a>
            </li>

          <li class="sidebar-item">
              <a class="sidebar-link " href="{{  route('commercial.customers') }}" aria-expanded="false" >
                <span>
                   <i class="fa-duotone fa-house"></i>
                </span>
                  <span class="hide-menu">Clientes</span>
              </a>
          </li>
          <li class="sidebar-item">
              <a class="sidebar-link " href="{{  route('commercial.notes') }}" aria-expanded="false" >
                <span>
                   <i class="fa-duotone fa-house"></i>
                </span>
                  <span class="hide-menu">Notas</span>
              </a>
          </li>
          <li class="sidebar-item">
              <a class="sidebar-link " href="{{  route('commercial.worksessions') }}" aria-expanded="false" >
                <span>
                   <i class="fa-duotone fa-house"></i>
                </span>
                  <span class="hide-menu">Horario</span>
              </a>
          </li>


          <li class="sidebar-item">
              <a class="sidebar-link has-arrow" >
            <span>
              <i class="fa-duotone fa-note"></i>
            </span>
                  <span class="hide-menu">Configuración</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                      <a href="{{ route('commercial.settings.profile') }}" class="sidebar-link">
                          <span class="hide-menu">Usuario</span>
                      </a>
                  </li>

              </ul>
          </li>
      </ul>
    </nav>

  </div>

</aside>
