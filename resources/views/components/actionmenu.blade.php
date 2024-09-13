<div class="relative block lg:hidden">
    <button id="dropdownButton-{{ $uniqueId }}" class="flex items-center space-x-2">
        <!-- Three dots icon -->
        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="1.5"></circle>
            <circle cx="19" cy="12" r="1.5"></circle>
            <circle cx="5" cy="12" r="1.5"></circle>
        </svg>
    </button>
    <div id="dropdownMenu-{{ $uniqueId }}" class="z-50 absolute right-0 mt-2 bg-white border border-gray-200 rounded shadow-lg hidden">
        <a href="{{ $editUrl }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            {{ __('Edit') }}
        </a>
        <form method="post" action="{{ $deleteUrl }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:bg-gray-100">
                {{ __('Del') }}
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton-{{ $uniqueId }}');
    const dropdownMenu = document.getElementById('dropdownMenu-{{ $uniqueId }}');

    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>
