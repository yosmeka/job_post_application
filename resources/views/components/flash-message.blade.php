@if(session()->has('message'))
<div x-data="{show: true}" 
     x-init="setTimeout(() => show = false, 3000)" 
     x-show="show" 
     class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <p class="text-center font-medium">
        {{ session('message') }}
    </p>
</div>
@endif
