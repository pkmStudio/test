<li @if ($currentGroup->id === $group->id) class="active" @endif>
    <a href="{{ route('group.index.products', ['group' => $group->id]) }}">
        {{ $group->name }}
    </a>
    @if ($group->children->isNotEmpty())
        <ul>
            @foreach ($group->children as $child)
                @include('group.partials.groupItemSubs', ['group' => $child, 'currentGroup' => $currentGroup])
            @endforeach
        </ul>
    @endif
</li>
