    <section class="dasboard-all top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-flex">
                        <ul class="ul312">
                            <li><button class="tog-bt">
                                <i class="fa fa-bars"></i>
                            </button></li>
                            <li>
                                <ul class="navbar-nav ml-auto ul313">
                                    <li class="option-item  ">
                                        <a href="{{ route('getHomePage') }}" target="_blank">{{ trans('translation.landing_page') }}</a>
                                    </li>
                                    <!-- <li class="option-item  ">
                                        <a href="/dashboard/home" target="_blank">User dashboard</a>
                                    </li> -->
                                    @if($locales)
                                    <li class="option-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ strtoupper(app()->getLocale()) }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            @foreach($locales as $langLocale => $langName)
                                                <li>
                                                    <a class="dropdown-item"  href="{{ route('locales.switch') }}?change_language={{ $langLocale }}">
                                                        {{ strtoupper($langLocale) }} ({{ $langName }})
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>