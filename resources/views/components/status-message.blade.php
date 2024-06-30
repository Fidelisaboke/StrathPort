<!-- Status messages -->
@if (session('success'))
<div class="p-4 mb-4 text-center text-white bg-green-500">
    {{ session('success') }}
</div>
@elseif (session('warning'))
<div class="p-4 mb-4 text-center text-white bg-yellow-500">
    {{ session('warning') }}
@elseif (session('error'))
<div class="p-4 mb-4 text-center text-white bg-red-500">
    {{ session('error') }}
</div>
@endif
