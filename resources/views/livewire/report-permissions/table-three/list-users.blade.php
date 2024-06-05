<div>
    {{-- {{ $item['users'] }} --}}
    <ul class="list-group list-group-flush">
        @foreach ($item['users'] as $value)
            <li class="list-group-item">{{ $value->alias }}</li>
        @endforeach
    </ul>
</div>
