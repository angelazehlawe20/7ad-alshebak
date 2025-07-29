@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        <div class="alert-body">
            <i class="fas fa-check-circle me-2"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
        <div class="alert-body">
            <i class="fas fa-exclamation-circle me-2"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="validationAlert">
        <div class="alert-body">
            <div class="alert-title">
                <i class="fas fa-times-circle me-2"></i>
                <strong>{{ __('messages.validation_errors') }}</strong>
            </div>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
        </div>
    </div>
@endif

<script>
    // Auto-dismiss alerts after 10 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = ['successAlert', 'errorAlert', 'validationAlert'];
        alerts.forEach(function(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 10000); // 10 seconds
            }
        });
    });
</script>
