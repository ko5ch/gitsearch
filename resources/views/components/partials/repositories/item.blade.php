@props(['item'])

<tr class="bg-white font-medium text-sm divide-y divide-gray-200">
    <td  class="p-2 whitespace-normal md:break-all">
        {{ $item->get('name') }}
    </td>
    <td  class="p-2 whitespace-normal md:break-all">
        <a href="{{ $item->get('html_url') }}" target="_blank">{{ $item->get('html_url') }}</a>
    </td>
    <td  class="p-2 whitespace-normal md:break-all">
        {{ $item->get('description') }}
    </td>
    <td class="p-2 whitespace-nowrap">
	    <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">{{ $item->get('owner_login') }}</span>
	</td>
    <td  class="p-2 whitespace-normal">
        {{ $item->get('stargazers_count') }}
    </td>
    <td class="p-4 whitespace-normal">
        <div class="flex space-x-1">
            @if(!$item->get('is_exist'))
                <x-add-button :url="route('repositories.store')" :title="'Add to Favorites'">
                    @foreach(['name', 'html_url', 'description', 'stargazers_count', 'repo_id', 'owner_login'] as $field)
                        <x-input type="hidden" name="{{ $field }}" :value="$item->get($field)" id="{{ $field }}"></x-input>
                    @endforeach
                </x-add-button>
            @else
                <x-remove-button :url="route('repositories.delete', $item->get('repo_id'))" :title="'Remove to Favorites'"></x-remove-button>
            @endif
        </div>
    </td>
</tr>
