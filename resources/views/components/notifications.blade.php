<!-- resources/views/components/Notifications.blade.php -->

@php
    $success = session('success') ?? [];
    $info = session('info') ?? [];
    $warning = session('warning') ?? [];
    $error = session('error') ?? [];
@endphp

@if(count($success) > 0 || count($info) > 0 || count($warning) > 0 || count($error) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function showSuccessNotifications(messages) {
                messages.forEach(function(message) {
                    showNotification('Sukces', message, 'success', 5000);
                });
            }
            showSuccessNotifications(@json($success));

            function showInfoNotifications(messages) {
                messages.forEach(function(message) {
                    showNotification('Informacja', message, 'info', 5000);
                });
            }
            showInfoNotifications(@json($info));

            function showWarningNotifications(messages) {
                messages.forEach(function(message) {
                    showNotification('Ostrzeżenie', message, 'warning', 5000);
                });
            }
            showWarningNotifications(@json($warning));

            function showErrorNotifications(messages) {
                messages.forEach(function(message) {
                    showNotification('Błąd', message, 'error', 5000);
                });
            }
            showErrorNotifications(@json($error));

            $.ajax({
                url: '/clear-session-messages',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({ clear: true }),
                contentType: 'application/json',
                success: function(response) {
                    console.log('Session messages cleared');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to clear session messages:', error);
                }
            });
        });

    </script>
@endif
