@if(session('success') || session('warning') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                let successMessage = document.getElementById('success-message');
                let warningMessage = document.getElementById('warning-message');
                let errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    successMessage.remove();
                }

                if (warningMessage) {
                    warningMessage.remove();
                }

                if (errorMessage) {
                    errorMessage.remove();
                }
            }, 3000);
        });
    </script>
    <!-- Status messages -->
    @if (session('success'))
    <div id="success-message" class="p-4 mx-auto my-4 text-center text-white transition-opacity duration-500 ease-in-out bg-green-500 rounded-lg max-w-max animate-fade-in">
        {{ session('success') }}
    </div>
    @endif

    @if (session('warning'))
    <div id="warning-message" class="p-4 mx-auto my-4 text-center text-white transition-opacity duration-500 ease-in-out delay-150 bg-yellow-500 rounded-lg max-w-max animate-fade-in">
        {{ session('warning') }}
    </div>
    @endif

    @if (session('error'))
    <div id="error-message" class="p-4 mx-auto my-4 text-center text-white transition-opacity duration-500 ease-in-out delay-150 bg-red-500 rounded-lg max-w-max animate-fade-in">
        {{ session('error') }}
    </div>
    @endif
@endif
