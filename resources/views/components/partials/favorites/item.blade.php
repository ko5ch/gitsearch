@props(['item'])

<tr class="bg-white font-medium text-sm divide-y divide-gray-300">
    <td  class="p-4 whitespace-normal break-all">
        {{ $item->name }}
    </td>
    <td  class="p-4 whitespace-normal break-all text-grey-300 hover:text-green-500">
        <a href="{{ $item->html_url_link }}" target="_blank">{{ $item->html_url_link }}</a>
    </td>
    <td  class="p-4 whitespace-normal break-all">
        {{ $item->description }}
    </td>
    <td class="p-4 whitespace-nowrap">
	    <span class="bg-green-600 text-green-50 text-xs font-semibold rounded-2xl py-1 px-4 hover:bg-green-200 hover:text-gray-600">
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
