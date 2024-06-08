<div>
    {{-- {{ $item['users'] }} --}}
    @if (count($item['users']) > 0)
        <ul class="list-group list-group-flush">
            @if (count($item['users']) == 1)
                <li class="list-group-item">{{ $item['users'][0]->alias }}</li>
            @else
                <li class="list-group-item d-flex justify-content-start align-items-center">{{ $item['users'][0]->alias }}
                    <span class="badge bg-info ms-2 f-12" style="opacity: 1;"
                        data-bs-toggle="collapse" data-bs-target="#verMas"
                        aria-expanded="false" aria-controls="collapseExample">
                        Ver más
                    </span>
                </li>
            @endif
        </ul>
    @else
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>No hay usuarios asociados.</strong>
            </li>
        </ul>
    @endif

    <!-- El contenido oculto con la información adicional -->
    <div class="collapse" id="verMas">
        <!-- Contenido adicional para el elemento 1 -->
        @if ($item['users'])
            @php $list = array_slice($item['users']->toArray(), 1); @endphp
            <ul class="list-group list-group-flush">
                @foreach ($list as $value)
                    <li class="list-group-item"> {{ $value['alias'] }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
