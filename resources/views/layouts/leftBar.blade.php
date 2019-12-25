<!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556074849/avatar-1_tcnd60.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h4 class="m-0">{{ucwords(Session::get('name'))}}</h4>
          <p class="font-weight-light text-muted mb-0">Welcome</p>
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="/" class="nav-link text-dark font-italic bg-light">
                  <i class="fa fa-th-large mr-3 text-primary fa-fw fa-main" ></i>
                  Home
              </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('todo.index') }}" class="nav-link text-dark font-italic">
                  <i class="fa fa-address-card mr-3 text-primary fa-fw fa-main" ></i>
                  Todo
              </a>
      </li>
      @if(Session::get('user_type')=='admin')
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link text-dark font-italic">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw fa-main"></i>
                    User
                </a>
        </li>
      @endif
      <li class="nav-item">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" class="nav-link text-dark font-italic">
               <i class="fa fa-address-card mr-3 text-primary fa-fw fa-main"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
      </li>
    </ul>
  </div>
