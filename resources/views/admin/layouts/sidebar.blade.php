<!-- Hamburger Button for Mobile -->
<button class="btn btn-primary d-md-none position-fixed" style="top: 10px; {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 10px; z-index: 1000;" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars"></i>
</button>

<div class="col-md-4 col-lg-3 px-0 sidebar shadow-sm collapse d-md-block {{ app()->getLocale() == 'ar' ? 'order-first' : '' }}" id="sidebarMenu">
    <div class="d-flex flex-column h-100">
        <!-- Header -->
        <div class="p-4 fw-bold text-center border-bottom">
            <h4 class="mb-1">
                {{ app()->getLocale() == 'en' ? ($heroPage->title_en ?? 'Had alshebak') : ($heroPage->title_ar ?? 'حد الشباك') }}
            </h4>
            <p class="text-muted small mb-0">{{ __('messages.admin_dashboard') }}</p>
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column p-3">

            @if(auth()->guard('admin')->user()->is_owner)
                {{-- == جميع الروابط لصاحب الموقع == --}}
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-2 px-3 mb-2 rounded {{ request()->routeIs('') ? 'active' : '' }}"
                        href="#" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-home {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                        {{ __('messages.home_page') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="homeDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.hero.indexForAdmin') }}">
                                <i class="fas fa-store {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
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

                <a href="{{ route('admin.dashboard') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.dashboard') }}
                </a>

                <a href="{{ route('admin.categories.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                    <i class="fas fa-list {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.categories') }}
                </a>

                <a href="{{ route('admin.menu.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.menu.index') ? 'active' : '' }}">
                    <i class="fas fa-utensils {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.menu_items') }}
                </a>

                <a href="{{ route('admin.offers.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.offers.index') ? 'active' : '' }}">
                    <i class="fas fa-gift {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.offers') }}
                </a>
            @endif

            {{-- == مشتركة بين الـ owner والمدير العادي == --}}
            <a href="{{ route('admin.bookings.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                {{ __('messages.bookings') }}
                <span id="booking-pending-badge" 
                      class="badge bg-warning rounded-pill {{ app()->getLocale() == 'ar' ? 'me-2' : 'ms-2' }}"
                      style="{{ isset($pendingBookingsCount) && $pendingBookingsCount > 0 ? '' : 'display: none;' }}">
                    {{ $pendingBookingsCount ?? 0 }}
                </span>
            </a>

            <a href="{{ route('admin.contacts.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                <i class="fas fa-envelope {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                {{ __('messages.contact_messages') }}
                <span id="contact-unread-badge"
                      class="badge bg-danger rounded-pill {{ app()->getLocale() == 'ar' ? 'me-2' : 'ms-2' }}"
                      style="{{ $unreadMessagesCount > 0 ? '' : 'display: none;' }}">
                    {{ $unreadMessagesCount }}
                </span>
            </a>

            {{-- == رابط إدارة المدراء فقط للمالك == --}}
            @if(auth()->guard('admin')->user()->is_owner)
                <a href="{{ route('admin.settings.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                    <i class="fas fa-cog {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.settings') }}
                </a>

                <a href="{{ route('admin.admins.index') }}" class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
                    <i class="fas fa-users-cog {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
                    {{ __('messages.admin_management') }}
                </a>
            @endif
        </nav>
    </div>
</div>
