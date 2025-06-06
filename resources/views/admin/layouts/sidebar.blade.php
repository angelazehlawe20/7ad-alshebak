<div class="col-md-3 col-lg-2 px-0 sidebar">
    <div class="d-flex flex-column">
        <div class="p-3 text-center">
            <h4>Had AlShebak</h4>
            <p class="text-muted">Admin Panel</p>
        </div>
        <nav class="nav flex-column mt-2">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.menu') }}"
                class="nav-link @if(request()->routeIs('admin.menu.index')) active @endif">
                <i class="fas fa-utensils me-2"></i> Menu Items
            </a>
            <a href="{{ route('admin.offers.index') }}"
                class="nav-link @if(request()->routeIs('admin.offers.index')) active @endif">
                <i class="fas fa-gift me-2"></i> Offers
            </a>
            <a href="{{ route('admin.bookings.index') }}"
                class="nav-link @if(request()->routeIs('admin.bookings.index')) active @endif">
                <i class="fas fa-calendar-alt me-2"></i> Bookings
            </a>
            <a href="{{ route('admin.contacts.index') }}"
                class="nav-link @if(request()->routeIs('admin.contacts.index')) active @endif">
                <i class="fas fa-envelope me-2"></i> Contact Messages
            </a>
        </nav>
    </div>
</div>
