<header>
    <div class="header_wrap">
        <div class="header_inner mcontainer">
            <div class="left_side">
                <span class="slide_menu" uk-toggle="target: #wrapper ; cls: is-collapse is-active">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z" fill="currentColor"></path></svg>
                </span>
                <div id="logo">
                    <a href="{{ route('komix.index') }}"> 
                        <img src="{{ asset('assets/v1/img/logo/square/kamus-ori.png') }}" alt="Logo">
                        <img src="{{ asset('assets/v1/img/logo/square/kamus-ori.png') }}" alt="Logo" class="logo_inverse"> 
                        <img src="{{ asset('assets/v1/img/logo/square/kamus-ori.png') }}" class="logo_mobile" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="right_side">
                <div class="header_widgets">

                    @include('components.launcher')
                    
                    @auth

                        <a href="{{ route('komix.member.index', me()->username) }}" class="is_link">{{ me()->name }}</a>
                        
                        <a href="#"><img src="{{ me()->photo }}" class="is_avatar" alt="{{ me()->name }}"></a>
                        <div uk-drop="mode:click;offset:5;" class="header_dropdown profile_dropdown">
                            <a href="javascript:;" class="user">
                                <div class="user_avatar">
                                    <img src="{{ me()->photo }}" alt="{{ me()->name }}">
                                </div>
                                <div class="user_name">
                                    <div>{{ me()->name }}</div>
                                    <span>{{ '@' . me()->username }}</span>
                                </div>
                            </a>
                            <hr class="border-gray-100">
                            <a href="{{ route('my.account') }}" target="_blank">
                                <span class="iconify" data-icon="uil:user" data-inline="false"></span>
                                My Account 
                            </a>
                            <a href="#" id="night-mode" class="btn-night-mode">
                                <span class="iconify" data-icon="uil:moon" data-inline="false"></span> 
                                Night mode
                                <span class="btn-night-mode-switch"><span class="uk-switch-button"></span></span>
                            </a>
                            @if(officer_komix())
                            <a href="{{ route('komix.panel.index') }}">
                                <span class="iconify" data-icon="uil:fire" data-inline="false"></span>
                                Back Office
                            </a>
                            @endif
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Log Out 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    {!! Form::hidden('redirect', request()->fullUrl()) !!}
                                </form>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}?redirect={{ request()->url() }}" class="is_link">Login</a> 
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>