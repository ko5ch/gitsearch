<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Fovorites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <x-partials.favorites.items_table :items="$repositories"></x-partials.favorites.items_table>
                </div>
                <x-pagination :paginator="$repositories"></x-pagination>
            </div>
        </div>
    </div>
</x-app-layout>
