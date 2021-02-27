@props(['items'])

<table class="overflow-x-auto w-full bg-white mt-5">
    <thead class="bg-green-100 border-b border-gray-300">
    <tr>
        @foreach(['name', 'html_url', 'description', 'owner_login', 'stargazers_count', ''] as $titleName)
            @if($loop->iteration !== $loop->count - 1)
                <th class="p-4 text-left text-sm font-medium text-gray-500 whitespace-nowrap">
                    {{ \Str::of($titleName)->replace('_', ' ')->title()->__toString() }}
                </th>
            @else
                <th class="p-4 text-left text-sm font-medium text-gray-500 whitespace-nowrap">
                    <a href="{{ route(
                                    request()->route()->getName(),
                                    array_merge(request()->query(), [
                                        'order' => request()->get('order') === 'desc' ? 'asc' : 'desc',
                                        'sort'  => 'stars'
                                    ])
                                ) }}">
                        {{ \Str::of($titleName)->replace('_', ' ')->title()->__toString() }}
                        {!! !request()->get('order') ? "&#x21D5;" : (request()->get('order') === 'desc' ? "&#x21d3;" : "&#x21d1;") !!}
                    </a>
                </th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
    @foreach($items as $item)
        <x-partials.repositories.item :item="$item"></x-partials.repositories.item>
    @endforeach
    </tbody>
</table>
