<div class="d-flex flex-column flex-shrink-0 pt-3 bg-light" style="width: 280px; padding-right: 1rem">
    <a href="/" class="d-flex align-items-center flex-column mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <span class="fs-4">@yield('title')</span>

    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ route('profile.index') }}" class="nav-link @yield('activeHome')" aria-current="page">
          Главная
        </a>
      </li>
      <li>
        <a href="{{ route('profile.settings') }}" class="nav-link @yield('activeSettings')">
          Настройки
        </a>
      </li>
      <li>
        <a href="{{ route('profile.exhib') }}" class="nav-link @yield('activeExhib')">
          Выставки
        </a>
      </li>
      <li>
        <a href="{{ route('profile.excurs') }}" class="nav-link @yield('activeExcurs')">
          Экскурсии
        </a>
      </li>
      <li>
        @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
        <a href="{{ route('admin.index') }}" class="nav-link @yield('activeAdmin')">
          Панель управления
        </a>
        @endif
      </li>
      <li>
        @if (session('status'))
                <div class="alert alert-success alert-info mt-2" role="alert">
                    {{ session('status') }}
                </div>
            @endif
      </li>
    </ul>
</div>
