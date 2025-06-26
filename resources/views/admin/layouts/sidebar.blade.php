<div class="col-md-4 col-lg-3 px-0 sidebar shadow-sm {{ app()->getLocale() == 'ar' ? 'order-first' : '' }}">
    <div class="d-flex flex-column h-100">
        <!-- Header -->
        <div class="p-4 fw-bold text-center border-bottom">
            <h4 class="mb-1">
                {{ app()->getLocale() == 'en' ? $heroPage->title_en : $heroPage->title_ar }}
            </h4>
            <p class="text-muted small mb-0">{{ __('messages.admin_dashboard') }}</p>
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column p-3">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle py-2 px-3 mb-2 rounded {{ request()->routeIs('') ? 'active' : '' }}"
                    href="#" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-home {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                    __('messages.home_page') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="homeDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.hero.indexForAdmin') }}">
                            <i class="fas fa-image {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                            {{ __('messages.hero') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.about.indexForAdmin') }}">
                            <i class="fas fa-info-circle {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                            {{ __('messages.about') }}
                        </a>
                    </li>
                </ul>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.dashboard') }}
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                <i class="fas fa-list {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.categories') }}
            </a>

            <a href="{{ route('admin.menu.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.menu.index') ? 'active' : '' }}">
                <i class="fas fa-utensils {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.menu_items') }}
            </a>

            <a href="{{ route('admin.offers.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.offers.index') ? 'active' : '' }}">
                <i class="fas fa-gift {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ __('messages.offers')
                }}
            </a>

            <a href="{{ route('admin.bookings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.bookings') }}
                @if(isset($pendingBookingsCount) && $pendingBookingsCount > 0)
                <span class="badge bg-warning rounded-pill {{ app()->getLocale() == 'ar' ? 'me-2' : 'ms-2' }}">{{
                    $pendingBookingsCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.contacts.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                <i class="fas fa-envelope {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.contact_messages') }}
                @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                <span class="badge bg-danger rounded-pill {{ app()->getLocale() == 'ar' ? 'me-2' : 'ms-2' }}">{{
                    $unreadMessagesCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                <i class="fas fa-cog {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ __('messages.settings')
                }}
            </a>

            @if(auth()->guard('admin')->user()->is_owner)
            <a href="{{ route('admin.admins.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
                <i class="fas fa-users-cog {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i> {{
                __('messages.admin_management') }}
            </a>
            @endif
        </nav>
    </div>
</div>
