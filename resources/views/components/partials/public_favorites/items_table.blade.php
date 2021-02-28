@props(['items'])

<table class="overflow-x-auto w-full bg-yellow-50 mt-5 table-auto">
    <thead class="bg-green-100 border-b">
    <tr>
        @foreach(['name', 'html_url', 'description', 'owner_login', 'stargazers_count', ''] as $titleName)
            <th class="p-4 text-left text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ \Str::of($titleName)->replace('_', ' ')->title()->__toString() }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="text-gray-600 text-sm divide-y divide-gray-300">

    @foreach($items as $item)
        <x-partials.public_favorites.item :item="$item"></x-partials.public_favorites.item>
    @endforeach
    </tbody>
</table>
