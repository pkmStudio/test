<li>
    <a href="{{ route('group.index.products', ['group' => $group->id]) }}">
        {{ $group->name }}
    </a>
    @if ($group->children->isNotEmpty())
        <ul class="child-categories">
            @foreach($group->children as $child)
                @include('group.partials.groupItem', ['group' => $child])
            @endforeach
        </ul>
    @endif
</li>
