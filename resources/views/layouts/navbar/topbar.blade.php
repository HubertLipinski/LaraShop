<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+48 123 456 789</div>
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:hubertlipinskipl@gmail.com">hubertlipinskipl@gmail.com</a></div>
                <div class="top_bar_contact_item m-auto text-danger text-uppercase">
                    This is demo version
                </div>
                <div class="top_bar_content ml-auto">
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">Polish</a></li>
                                    <li><a href="#" class="text-muted">Spanish</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">PLN Polish złoty</a></li>
                                    <li><a href="#">EUR Euro</a></li>
                                    <li><a href="#">GBP British Pound</a></li>
                                    <li><a href="#">JPY Japanese Yen</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @guest
                    <div class="top_bar_user">
                        <div class="user_icon"><img src="{{asset('images/test.png')}}" alt=""></div>
                        <div><a href="{{ route('register') }}">{{ __('Register') }}</a></div>
                        <div><a href="{{ route('login') }}">{{ __('Login') }}</a></div>
                    </div>
                    @else
                        <div class="top_bar_user">
                            <div class="user_icon"><img src="{{asset('images/test.png')}}" alt=""></div>
                            <div><a href="#">{{ __('Profile') }}</a></div>
                            <div>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
