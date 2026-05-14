<nav class="fixed top-0 left-0 right-0 z-50 bg-[var(--color-canvas)] border-b border-[var(--color-frame)] navbar-shadow">
    <div class="container-main">
        <div class="flex items-center justify-between h-16">
            {{-- Logo / Brand --}}
            <a href="{{ route('home') }}" class="font-[var(--font-display)] text-2xl font-black text-[var(--color-white)] tracking-tight uppercase hover:text-[var(--color-white)]">
                REEFAI
            </a>

            {{-- Desktop Navigation Links --}}
            <ul class="hidden md:flex items-center gap-8">
                <li>
                    <a href="{{ route('home') }}"
                       class="mono-label {{ request()->routeIs('home') ? 'text-[var(--color-white)] shadow-[0px_-1px_0px_0px_inset_var(--color-mint)]' : 'text-[var(--color-gray)]' }} pb-1 hover:text-[var(--color-link-hover)]">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                       class="mono-label {{ request()->routeIs('about') ? 'text-[var(--color-white)] shadow-[0px_-1px_0px_0px_inset_var(--color-mint)]' : 'text-[var(--color-gray)]' }} pb-1 hover:text-[var(--color-link-hover)]">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects') }}"
                       class="mono-label {{ request()->routeIs('projects') ? 'text-[var(--color-white)] shadow-[0px_-1px_0px_0px_inset_var(--color-mint)]' : 'text-[var(--color-gray)]' }} pb-1 hover:text-[var(--color-link-hover)]">
                        Projects
                    </a>
                </li>
                <li>
                    <a href="{{ route('certificates') }}"
                       class="mono-label {{ request()->routeIs('certificates') ? 'text-[var(--color-white)] shadow-[0px_-1px_0px_0px_inset_var(--color-mint)]' : 'text-[var(--color-gray)]' }} pb-1 hover:text-[var(--color-link-hover)]">
                        Certificates
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ config('portfolio.owner.email') }}"
                       class="btn-primary hover:opacity-80 hover:text-[var(--color-black)] hover:shadow-[0_0_0_1px_var(--color-frame)]">
                        Hire Me
                    </a>
                </li>
            </ul>

            {{-- Theme Toggle + Hamburger --}}
            <div class="flex items-center gap-2">
                {{-- Theme Toggle Button (Desktop) --}}
                <button id="theme-toggle-desktop" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-[var(--color-gray)] hover:text-[var(--color-mint)] focus:outline-none transition-colors duration-150" aria-label="Toggle dark/light mode">
                    {{-- Sun icon (visible in dark mode) --}}
                    <svg class="theme-icon-sun h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                    {{-- Moon icon (visible in light mode) --}}
                    <svg class="theme-icon-moon h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                </button>

                {{-- Hamburger Menu Button (Mobile) --}}
                <button id="mobile-menu-btn" type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-[var(--color-gray)] hover:text-[var(--color-mint)] focus:outline-none" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation menu">
                    {{-- Hamburger icon --}}
                    <svg id="menu-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    {{-- Close icon --}}
                    <svg id="menu-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Menu (Drawer) --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-[var(--color-frame)]">
            <ul class="px-2 pt-4 pb-6 space-y-4">
                <li>
                    <a href="{{ route('home') }}"
                       class="block mono-label py-2 {{ request()->routeIs('home') ? 'text-[var(--color-mint)]' : 'text-[var(--color-gray)]' }} hover:text-[var(--color-link-hover)]">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                       class="block mono-label py-2 {{ request()->routeIs('about') ? 'text-[var(--color-mint)]' : 'text-[var(--color-gray)]' }} hover:text-[var(--color-link-hover)]">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects') }}"
                       class="block mono-label py-2 {{ request()->routeIs('projects') ? 'text-[var(--color-mint)]' : 'text-[var(--color-gray)]' }} hover:text-[var(--color-link-hover)]">
                        Projects
                    </a>
                </li>
                <li>
                    <a href="{{ route('certificates') }}"
                       class="block mono-label py-2 {{ request()->routeIs('certificates') ? 'text-[var(--color-mint)]' : 'text-[var(--color-gray)]' }} hover:text-[var(--color-link-hover)]">
                        Certificates
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ config('portfolio.owner.email') }}"
                       class="block mono-label py-2 text-[var(--color-gray)] hover:text-[var(--color-link-hover)]">
                        Hire Me
                    </a>
                </li>
                <li class="pt-2 border-t border-[var(--color-frame)]">
                    <button id="theme-toggle-mobile" type="button" class="flex items-center gap-2 mono-label py-2 text-[var(--color-gray)] hover:text-[var(--color-mint)] transition-colors duration-150" aria-label="Toggle dark/light mode">
                        <svg class="theme-icon-sun h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                        <svg class="theme-icon-moon h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                        <span>Toggle Theme</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
