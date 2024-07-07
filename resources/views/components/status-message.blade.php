@if(session('success') || session('warning') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                let successMessage = document.getElementById('success-message');
                let warningMessage = document.getElementById('warning-message');
                let errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    successMessage.classList.add('animate-slide-out');
                    setTimeout(() => successMessage.remove(), 500);
                }

                if (warningMessage) {
                    warningMessage.classList.add('animate-slide-out');
                    setTimeout(() => warningMessage.remove(), 500);
                }

                if (errorMessage) {
                    errorMessage.classList.add('animate-slide-out');
                    setTimeout(() => errorMessage.remove(), 500);
                }
            }, 3000);
        });
    </script>
    <!-- Status messages -->
    <div class="fixed top-0 z-10 mt-4 transform -translate-x-1/2 left-1/2">
        @if (session('success'))
        <div id="success-message" class="flex p-4 m-4 text-center text-white bg-green-500 rounded-lg max-w-max animate-slide-in">
            {{ session('success') }}
        </div>
        @endif

        @if (session('warning'))
        <div id="warning-message" class="flex p-4 m-4 text-center text-white bg-yellow-500 rounded-lg max-w-max animate-slide-in">
            {{ session('warning') }}
        </div>
        @endif

        @if (session('error'))
        <div id="error-message" class="flex p-4 m-4 text-center text-white bg-red-500 rounded-lg max-w-max animate-slide-in">
            {{ session('error') }}
        </div>
        @endif
    </div>
@endif
