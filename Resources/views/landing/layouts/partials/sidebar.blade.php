<div class="sidebar">
    <div class="sidebar_header"> 
        <img src="{{ asset('assets/komix/img/logo.png') }}" alt="Logo">
        <img src="{{ asset('assets/komix/img/logo.png') }}" class="logo-icon" alt="Logo">

        <span class="btn-mobile" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></span>
    </div>

    <div class="sidebar_inner" data-simplebar>
        <ul>
            <li class="@yield('mLanding')">
                <a href="{{ route('kamus.index') }}"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-pink-600"> 
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span>Landing</span>
                </a> 
            </li>
            <li class="@yield('mPanduan')">
                <a href="{{ route('kamus.panduan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-pink-500">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                    <span>Panduan</span>
                </a> 
            </li>
        </ul>

        @auth('web')
            <hr class="mt-2">
            <h3 class="text-lg mt-3 font-semibold ml-2 is-title">Kontribusi</h3>
            <ul style="margin-top: 0!important">
                <li class="@yield('mSubscribed')">
                    <a href=""> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-red-500">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a> 
                </li>
                <li class="@yield('mComments')">
                    <a href=""> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-blue-500">
                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                        </svg>
                        <span>Kontribusi</span>
                    </a> 
                </li>
            </ul>
        @endauth
    </div>
</div> 