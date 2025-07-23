    <div class="side-bar">
        <a class="abs-bk" href="#"><i class="fa-solid fa-caret-left"></i></a>
        <div class="brand-sec">
           <a href="" class="brand-link"> <span class="brand-text">CardanoGPT</span></a>
        </div>

        <div class="side-option">
            <div class="link-div">
                <ul class="link-ul">
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('adminDashboard') ? 'active' : '' }}" href="{{ route('adminDashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>{{ trans('translation.dashboard') }}
                        </a>
                    </li>
                    <!-- ======================AI SOLUTION========================= -->
                    <li class="ul-items"><p class="items-main-option">{{ trans('translation.AI SOLUTIONS') }}</p></li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fa-fw nav-icon fas fa-tags"></i>{{ trans('translation.categories') }}
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('questions.*') ? 'active' : '' }}" href="{{ route('questions.index') }}">
                            <i class="fa-fw nav-icon fas fa-question-circle"></i>{{ trans('translation.questions') }}
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('prompts.*') ? 'active' : '' }}" href="{{ route('prompts.index') }}">
                            <i class="fa-fw nav-icon fas fa-key"></i>{{ trans('translation.prompts') }}
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('settings.ai-solutions') ? 'active' : '' }}" href="{{ route('settings.ai-solutions') }}">
                            <i class="fa-fw nav-icon fa fa-cog"></i>{{ trans('translation.settings') }}
                        </a>
                    </li>
                    <!-- ======================APPEARANCE========================= -->
                    <li class="ul-items"><p class="items-main-option">{{ trans('translation.APPEARANCE') }}</p></li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('settings.brand') ? 'active' : '' }}" href="{{ route('settings.brand') }}">
                            <i class="fa-fw nav-icon fas fa-image"></i>{{ trans('translation.brand') }}
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('themes.*') ? 'active' : '' }}" href="{{ route('themes.index') }}"><i class="fa-fw nav-icon fas fa-palette"></i>Themes
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('locales.*') ? 'active' : '' }}" href="{{ route('locales.index') }}"><i class="fa-fw nav-icon fas fa-language"></i>{{ trans('translation.locales') }}
                        </a>
                    </li>
                    <!-- ======================USER========================= -->
                    <li class="ul-items"><p class="items-main-option">{{ trans('translation.USERS') }}</p></li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="fa-fw nav-icon fas fa-users"></i>{{ trans('translation.users') }}
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('changePassword') ? 'active' : '' }}" href="{{ route('changePassword') }}"><i class="fa-fw fas fa-key nav-icon"></i> {{ trans('translation.change_password') }}
                        </a>
                    </li> 
                    <form method="POST" action="{{ route('adminlogout') }}">
                        @csrf
                        <li class="ul-items">
                            <a href="{{ route('adminlogout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                                {{ trans('translation.logout') }}
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
        </div>


    </div>