<div class="side-bar">
    <a class="abs-bk" href="#"><i class="fa-solid fa-caret-left"></i></a>
    <div class="brand-sec">
        <!-- <a href="" class="brand-link"> <span class="brand-text">CardanoGPT</span></a> -->
        <!-- REMOVE THE SECTION ON 9 JULY, 2025 STARTS -->
        <!-- <img class="mainLogoStyleCls" src="{{ asset('users-images/CardanoGPT-user.png') }}"> -->
        <!-- REMOVE THE SECTION ON 9 JULY, 2025 ENDS -->
    </div>
    <div class="side-option">
        <div class="link-div">
            <ul class="link-ul">
                <!-- ======================AI TOOLS========================= -->
                <!-- <li class="ul-items"><p class="items-main-option">AI TOOLS</p></li> -->
                <li class="ul-items">
                    <a class="{{ request()->routeIs('userDashboard') ? 'active' : '' }} non-category-link" href="{{ route('userDashboard') }}">
                        <!-- <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>Dashboard -->
                        <div class="img-78">
                        <img class="iconStyleCls black-img" src="{{ asset('users-images/ic-1.png') }}">
                        <img class="iconStyleCls green-img" src="{{ asset('users-images/ic-1g.png') }}">
</div>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="ul-items">
                    <a class="{{ request()->routeIs('tools.*') ? 'active' : '' }} tools-link" href="">
                        <!-- <i class="fa-fw nav-icon fas fa-tags"></i> -->
                        <div class="img-78">
                        <img class="iconStyleCls black-img" src="{{ asset('users-images/ic-2.png') }}">
                        <img class="iconStyleCls green-img" src="{{ asset('users-images/ic-2g.png') }}">
</div>
                        <span>Tools</span>
                        <i class="arrow-icon fas fa-chevron-down"></i> <!-- Arrow icon -->
                    </a>

                    <!-- INSIDE THE TOOLS STARTS-->
                    <ul class="link-ul nest">
                        @if(getCategories())
                            <!-- LOOP THE CATEGORIES -->
                            @foreach(getCategories() as $cat)
                                <li class="ul-items">
                                    <a class="category-link" id="category-{{ $cat->id }}" href="{{ route('tools.index', $cat->id) }}">
                                        <!-- <i class="fas fa-fw fa-tachometer-alt nav-icon"></i> -->
                                        {{ $cat->title }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- INSIDE THE TOOLS ENDS-->
                </li>

                <!-- OLD WORKING CODE STARTS -->
                <!-- <li class="ul-items">
                    <a class="{{ request()->routeIs('tools.*') ? 'active' : '' }}" href="">
                        <i class="fa-fw nav-icon fas fa-tags"></i>Tools
                    </a>
                    <ul class="link-ul nest">
                        @if(getCategories())
                            @foreach(getCategories() as $cat)
                                <li class="ul-items">
                                    <a class="category-link" id="category-{{ $cat->id }}" href="{{ route('tools.index', $cat->id) }}">
                                        <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                                        {{ $cat->title }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li> -->
                <!-- OLD WORKING CODE ENDS -->
                <!-- REMOVE THE SECTION ON 9 JULY, 2025 STARTS -->
                <!-- <li class="ul-items">
                    <a class="non-category-link {{ request()->routeIs('chat.*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
                        <div class="img-78">
                        <img class="iconStyleCls black-img" src="{{ asset('users-images/ic-25.png') }}">
                        <img class="iconStyleCls green-img" src="{{ asset('users-images/ic-25g.png') }}">
</div>
                        <span>Chat</span>
                    </a>
                </li> -->
                <!-- REMOVE THE SECTION ON 9 JULY, 2025 ENDS -->
                <!-- ======================ACCOUNT========================= -->
                <li class="ul-items"><p class="items-main-option">ACCOUNT</p></li>
                <li class="ul-items">
                    <a class="non-category-link {{ request()->routeIs('subscription.*') ? 'active' : '' }}" href="{{ route('subscription.index') }}">
                        <!-- <i class="fa-fw nav-icon fas fa-image"></i> -->
                        <div class="img-78">
                        <img class="iconStyleCls black-img" src="{{ asset('users-images/ic-26.png') }}">
                        <img class="iconStyleCls green-img" src="{{ asset('users-images/ic-26g.png') }}">
</div>
                        <span>Subscription</span>
                    </a>
                </li>
                <li class="ul-items">
                    <a class="non-category-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                        <!-- <i class="fa-fw nav-icon fas fa-language"></i> -->
                       <div class="img-78">
                       <img class="iconStyleCls black-img" src="{{ asset('users-images/ic-27.png') }}">
                       <img class="iconStyleCls green-img" src="{{ asset('users-images/ic-27g.png') }}">
                       </div>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('.tools-link').on('click', function(e) {
            e.preventDefault();
            var $linkUl = $(this).next('.link-ul');
            var $arrowIcon = $(this).find('.arrow-icon');

            $linkUl.toggleClass('show');
            $arrowIcon.toggleClass('fa-chevron-down fa-chevron-up');
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('.category-link');
        const nonCategoryLinks = document.querySelectorAll('.non-category-link');
        const activeCategoryId = localStorage.getItem('activeCategoryId');

        // Apply the active class based on the stored value
        if (activeCategoryId) {
            const activeLink = document.getElementById(activeCategoryId);
            if (activeLink) {
                activeLink.classList.add('active');
                var $linkUlOne = $('.tools-link').next('.link-ul');
                $linkUlOne.addClass('show');
            }
        }

        categoryLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                // Prevent the default action of the link
                event.preventDefault();

                // Remove the active class from all category links
                categoryLinks.forEach(link => link.classList.remove('active'));

                // Add the active class to the clicked category link
                this.classList.add('active');

                // Store the ID of the clicked link
                localStorage.setItem('activeCategoryId', this.id);

                // Navigate to the link's href
                window.location.href = this.href;
            });
        });

        nonCategoryLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove the active class from all category links
                categoryLinks.forEach(link => link.classList.remove('active'));

                // Clear the stored active category ID
                localStorage.removeItem('activeCategoryId');
            });
        });
    });
</script>
