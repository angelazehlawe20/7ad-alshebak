<div class="d-flex align-items-end {{ app()->getLocale() === 'ar' ? 'me-auto' : 'ms-auto' }} pt-3 gap-2">
    @php
        $newBookings = \App\Models\Booking::where('status', 'pending')
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->where('is_notified', false)
            ->count();
        $unreadMessages = \App\Models\Contact::where('is_read', false)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->where('is_notified', false)
            ->count();
    @endphp

    <div class="dropdown">
        <button class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative"
            type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
            @if($newBookings > 0 || $unreadMessages > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $newBookings + $unreadMessages }}
                </span>
            @endif
        </button>
        <ul class="dropdown-menu {{ app()->getLocale() === 'ar' ? 'dropdown-menu-start' : 'dropdown-menu-end' }}" aria-labelledby="notificationsDropdown">
            @if($newBookings > 0 || $unreadMessages > 0)
                @if($newBookings > 0)
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.bookings.index') }}" onclick="markBookingsAsNotified()">
                            <i class="fas fa-calendar-check {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ $newBookings }} {{ __('messages.new_bookings') }}
                        </a>
                    </li>
                @endif
                @if($unreadMessages > 0)
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.contacts.index') }}" onclick="markMessagesAsNotified()">
                            <i class="fas fa-envelope {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ $unreadMessages }} {{ __('messages.new_messages') }}
                        </a>
                    </li>
                @endif
            @else
                <li><span class="dropdown-item-text">{{ __('messages.no_new_notifications') }}</span></li>
            @endif
        </ul>
    </div>

    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
        class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-language {{ app()->getLocale() === 'ar' ? 'ms-1' : 'me-1' }}"></i>
        {{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}
    </a>

    @php $admin = auth()->guard('admin')->user(); @endphp

    @if($admin->is_owner)
        <div class="dropdown">
            <button class="btn btn-light rounded-pill dropdown-toggle" type="button" id="userDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
                <span>{{ __('messages.admin') }}</span>
            </button>
            <ul class="dropdown-menu {{ app()->getLocale() === 'ar' ? 'dropdown-menu-start' : 'dropdown-menu-end' }}">
                <li><a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="fas fa-user-cog {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ __('messages.profile') }}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i> {{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @else
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-sign-out-alt {{ app()->getLocale() === 'ar' ? 'ms-1' : 'me-1' }}"></i> {{ __('messages.logout') }}
            </button>
        </form>
    @endif
</div>
