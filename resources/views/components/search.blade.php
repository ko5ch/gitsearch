@props(['url' => route(request()->route()->getName()), 'name' => 'search_text'])

<div class="relative sm:col-span-2 md:col-span-3 lg:col-span-2">
    <form action="{{ $url }}">
        <input
            type="text"
            placeholder="Search ....."
            name="{{ $name }}"
            value="{{ request()->get($name) }}"
            class="block px-8 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
        />
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="absolute left-3 bottom-3 h-4 w-4 text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </form>
</div>
