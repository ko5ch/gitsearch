@props(['paginator'])

@if ($paginator->hasPages())
    <div class="m-1">
        {{ $paginator->appends(request()->all())->links() }}
    </div>
@endif
