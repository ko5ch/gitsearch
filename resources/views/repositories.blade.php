<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-search :url="route('repositories.search')"></x-search>
                    <x-partials.repositories.items_table :items="$repositories"></x-partials.repositories.items_table>

                </div>
                <x-pagination :paginator="$repositories"></x-pagination>
            </div>
        </div>
    </div>
</x-app-layout>
