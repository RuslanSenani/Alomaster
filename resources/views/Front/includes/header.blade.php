<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center">

        <a href="{{Route("work-area")}}" class="logo d-flex align-items-center me-auto">
            <img src="{{empty(cache('siteData')['settings']) ?"":asset(cache('siteData')['settings']->logo)}}" alt="Icon">
            <h1 class="sitename"><span
                        style="color:#F60303">{{empty(cache('siteData')['companyName']) ? " ":cache('siteData')['companyName'][0]}}</span> {{empty(cache('siteData')['companyName']) ? " " :cache('siteData')['companyName'][1]}}
            </h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{Route('about-us.index')}}"
                       class="{{ Route::currentRouteName() == 'about-us.' ? 'active' : '' }}">Hakkımlzda
                    </a>
                </li>

                <li>
                    <a href="{{Route('service.index')}}"
                       class="{{ Route::currentRouteName() == 'service.' ? 'active' : '' }}">Xidmətlər
                    </a>
                </li>
                <li>
                    <a href="{{Route('advantage.index')}}"
                       class="{{ Route::currentRouteName() == 'advantage.' ? 'active' : '' }}">Üstünlüklər
                    </a>
                </li>
                <li>
                    <a href="{{Route('contact.index')}}"
                       class="{{ Route::currentRouteName() == 'contact.' ? 'active' : '' }}">Əlaqə
                    </a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="header-social-links">
            <a href="{{empty(cache('siteData')['settings']) ? "#": cache('siteData')['settings']->tik_tok}}" target="_blank"><i
                        class="bi bi-tiktok"></i></a>
            <a href="{{empty(cache('siteData')['settings']) ? "#" : cache('siteData')['settings']->facebook}}" target="_blank"><i
                        class="bi bi-facebook"></i></a>
            <a href="{{empty(cache('siteData')['settings']) ?"#" :cache('siteData')['settings']->instagram}}" target="_blank"><i
                        class="bi bi-instagram"></i></a>
            <a href="{{empty(cache('siteData')['settings']) ? "#" : cache('siteData')['settings']->youtube}}" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>

    </div>
</header>
