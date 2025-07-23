<style>
    .removeArwCls::after{
        display: none !important;
    }
</style>
    <section class="dasboard-all top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-flex">
                        <ul class="ul312">
                            <div>
                                <li>
                                    <button class="tog-bt"><i class="fa fa-bars"></i></button>
                                </li>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- NEW BUTTONS STARTS -->
                                <li class="option-item spCls">
                                    <a class="btn btn-success greenColorBtn" href="{{ route('subscription.index') }}" role="button">
                                    Purchase Credits
                                    </a>
                                </li>
                                <li class="option-item spCls">
                                    <a class="btn btn-secondary lightColorBtn" href="#" role="button" style="display:flex;background: gainsboro;color: black;">
                                        <img src="{{ asset('users-images/coin.png') }}" width="25px" height="25px">
                                        <span class="myAvailableCoins" style="align-self: center;margin-left: 7px;">
                                            {{
                                                number_format(\App\Models\Wallet::where('user_id', Illuminate\Support\Facades\Auth::guard('user')->user()->id)->first()->balance_in_wallet, 0)
                                            }}
                                        </span>
                                    </a>
                                </li>
                                <!-- NEW BUTTONS ENDS -->
                                <li class="marClsN">
                                    <ul>
                                        <li class="option-item dropdown">
                                            <a class="nav-link dropdown-toggle removeArwCls" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image ? asset('f_user/'.Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image) : asset('users-images/defaultimage.jpg') }}" alt="Profile picture" class="pro-pic" id="pro-pic">
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                @if(!empty(Illuminate\Support\Facades\Auth::guard('user')->check()))
                                                    <li>
                                                        <p class="styleName">{{ Illuminate\Support\Facades\Auth::guard('user')->user()->name ?? Illuminate\Support\Facades\Auth::guard('user')->user()->username }}</p>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                                        <form method="POST" action="{{ route('userLogout') }}">
                                                            @csrf
                                                            <a class="dropdown-item" href="{{ route('userLogout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>Logout
                                                            </a>
                                                        </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>