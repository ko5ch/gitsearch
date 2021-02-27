@props(['item'])

<tr class="bg-white font-medium text-sm divide-y divide-gray-200">
    <td  class="p-4 whitespace-normal break-all">
        {{ $item->name }}
    </td>
    <td  class="p-4 whitespace-normal break-all">
        <a href="{{ $item->html_url_link }}" target="_blank">{{ $item->html_url_link }}</a>
    </td>
    <td  class="p-4 whitespace-normal break-all">
        {{ $item->description }}
    </td>
    <td class="p-4 whitespace-nowrap">
	    <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">
            <a href="{{ $item->owner_login_link }}" target="_blank">{{ $item->owner_login }}</a>
        </span>
	</td>
    <td  class="p-4 whitespace-normal">
        {{ $item->stargazers_count }}
    </td>
    <td class="p-4 whitespace">
        <div class="flex space-x-1">
            <x-remove-button :url="route('repositories.delete', $item->repo_id)" :title="'Remove to Favorites'"></x-remove-button>
        </div>
    </td>
</tr>
