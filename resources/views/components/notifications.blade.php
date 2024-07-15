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
        });
    </script>
@endif
