<div class="col-md-4 col-lg-3 px-0 sidebar shadow-sm">
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
            <a href="{{ route('admin.profile.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.profile.index') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i> {{ __('messages.profile') }}
            </a>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> {{ __('messages.dashboard') }}
            </a>

            <a href="{{ route('admin.about.indexForAdmin') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.about.indexForAdmin') ? 'active' : '' }}">
                <i class="fas fa-info-circle me-2"></i> {{ __('messages.about') }}
            </a>

            <a href="{{ route('admin.hero.indexForAdmin') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.hero.indexForAdmin') ? 'active' : '' }}">
                <i class="fas fa-image me-2"></i> {{ __('messages.hero') }}
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                <i class="fas fa-list me-2"></i> {{ __('messages.categories') }}
            </a>

            <a href="{{ route('admin.menu.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.menu.index') ? 'active' : '' }}">
                <i class="fas fa-utensils me-2"></i> {{ __('messages.menu_items') }}
            </a>

            <a href="{{ route('admin.offers.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.offers.index') ? 'active' : '' }}">
                <i class="fas fa-gift me-2"></i> {{ __('messages.offers') }}
            </a>

            <a href="{{ route('admin.bookings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i> {{ __('messages.bookings') }}
                @if(isset($pendingBookingsCount) && $pendingBookingsCount > 0)
                <span class="badge bg-warning rounded-pill ms-2">{{ $pendingBookingsCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.contacts.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                <i class="fas fa-envelope me-2"></i> {{ __('messages.contact_messages') }}
                @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                <span class="badge bg-danger rounded-pill ms-2">{{ $unreadMessagesCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i> {{ __('messages.settings') }}
            </a>
        </nav>
    </div>
</div>
