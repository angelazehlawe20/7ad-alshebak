<div class="col-md-3 col-lg-2 px-0 sidebar bg-white shadow-sm">
    <div class="d-flex flex-column h-100">
        <div class="p-4 text-center border-bottom">
            <h4 class="fw-bold mb-2">Had AlShebak</h4>
            <p class="text-muted small mb-0">Admin Dashboard</p>
        </div>
        <nav class="nav flex-column p-3">
            <a href="{{ route('admin.profile.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.profile.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-home me-2"></i> Profile
            </a>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.about.indexForAdmin') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.about.indexForAdmin') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-info-circle me-2"></i> About
            </a>
            <a href="{{ route('admin.hero.indexForAdmin') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.hero.indexForAdmin') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-info-circle me-2"></i> Hero
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.categories.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-list me-2"></i> Categories
            </a>
            <a href="{{ route('admin.menu.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.menu.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-utensils me-2"></i> Menu Items
            </a>
            <a href="{{ route('admin.offers.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.offers.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-gift me-2"></i> Offers
            </a>
            <a href="{{ route('admin.bookings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.bookings.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-calendar-alt me-2"></i> Bookings
            </a>
            <a href="{{ route('admin.contacts.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.contacts.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-envelope me-2"></i> Contact Messages
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="nav-link py-2 px-3 mb-2 rounded {{ request()->routeIs('admin.settings.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-cog me-2"></i> Settings
            </a>
        </nav>
    </div>
</div>
