<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

            {{-- <ul class="list-group list-group-flush"> --}}
                @php
                    // dump($properties['properties']);
                    $attributes = isset($properties['properties']['attributes']) ? $properties['properties']['attributes'] : [];
                    $old = isset($properties['properties']['old']) ? $properties['properties']['old'] : [];
                @endphp
                <div class="row">
                    <div class="col-6 col-sm-6">
                        <div class="text-center"><strong>Valor Nuevo: </strong></div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="text-center"><strong>Valor Anterior: </strong></div>
                    </div>
                </div>
                <hr>
                {{-- @foreach ($properties['properties'] as $key => $value) --}}
                <ul class="list-group list-group-flush">
                    @if ($properties['event'] === 'deleted')
                        @foreach($old as $key => $value)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="text-center col-6 col-sm-6">{{ $key }} = {{ $attributes[$key] ?? 'N/A' }}</div>
                                        <div class="text-center col-6 col-sm-6">{{ $key }} = {{ $value }}</div>
                                    </div>
                                </li>
                        @endforeach
                    @else
                        @foreach($attributes as $key => $value)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="text-center col-6 col-sm-6">{{ $key }} = {{ $value }}</div>
                                        <div class="text-center col-6 col-sm-6">{{ $key }} = {{ $old[$key] ?? 'N/A' }}</div>
                                    </div>
                                </li>
                        @endforeach
                    @endif
                </ul>

                {{-- @endforeach --}}
            {{-- </ul> --}}

        </div>
      </div>
</div>
