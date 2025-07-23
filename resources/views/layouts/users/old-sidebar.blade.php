<div class="side-bar">
        <a class="abs-bk" href="#"><i class="fa-solid fa-caret-left"></i></a>
        <div class="brand-sec">
           <a href="" class="brand-link"> <span class="brand-text">CardanoGPT</span></a>
        </div>
        <div class="side-option">
            <div class="link-div">
                <ul class="link-ul">
                    <!-- ======================AI TOOLS========================= -->
                    <li class="ul-items"><p class="items-main-option">AI TOOLS</p></li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('userDashboard') ? 'active' : '' }}" href="{{ route('userDashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>Dashboard
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="{{ request()->routeIs('tools.*') ? 'active' : '' }}" href="">
                            <i class="fa-fw nav-icon fas fa-tags"></i>Tools
                        </a>
                    
                        <!-- INSIDE THE TOOLS STARTS-->
                        <ul class="link-ul nest">
                            @if(getCategories())
                            <!-- LOOP THE CATEGORIES -->
                                @foreach(getCategories() as $cat)
                                    <li class="ul-items">
                                        <a class="" href="{{ route('tools.index',$cat->id) }}"><i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                                            {{ $cat->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <!-- INSIDE THE TOOLS ENDS-->
                    </li>
                    <li class="ul-items">
                        <a class="" href="{{ route('questions.index') }}">
                            <i class="fa-fw nav-icon fas fa-question-circle"></i>Chat
                        </a>
                    </li>
                    <!-- ======================ACCOUNT========================= -->
                    <li class="ul-items"><p class="items-main-option">ACCOUNT</p></li>
                    <li class="ul-items">
                        <a class="" href="{{ route('settings.brand') }}">
                            <i class="fa-fw nav-icon fas fa-image"></i>Subscription
                        </a>
                    </li>
                    <li class="ul-items">
                        <a class="" href="{{ route('locales.index') }}"><i class="fa-fw nav-icon fas fa-language"></i>Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>


    </div>