@props(['url', 'title' => 'Remove', 'method' => 'DELETE'])
<form action="{{ $url }}" method="post">
    @csrf
    @method($method)
    <button class="border-2 border-red-200 rounded-md p-1" title="{{ $title }}" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-red-500">
            <path d="M15.582 19.485c-1.141 1.119-2.345 2.287-3.582 3.515-6.43-6.381-12-11.147-12-15.808 0-4.005 3.098-6.192 6.281-6.192 2.197 0 4.434 1.042 5.719 3.248 1.279-2.195 3.521-3.238 5.726-3.238 3.177 0 6.274 2.171 6.274 6.182 0 1.577-.649 3.168-1.742 4.828l-1.447-1.447c.75-1.211 1.189-2.341 1.189-3.381 0-2.873-2.216-4.182-4.274-4.182-3.257 0-4.976 3.475-5.726 5.021-.747-1.54-2.484-5.03-5.72-5.031-2.315-.001-4.28 1.516-4.28 4.192 0 3.442 4.742 7.85 10 13l2.168-2.121 1.414 1.414zm7.418-5.485h-8v2h8v-2z"/>
        </svg>
    </button>
</form>
