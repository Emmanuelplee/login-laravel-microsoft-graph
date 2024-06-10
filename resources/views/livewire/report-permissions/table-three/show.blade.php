<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-6">
                    <ul class="list-group list-group-flush">
                        @if (count($roleFind['users']) > 0)
                            @foreach ($roleFind['users'] as $value)
                                <li class="list-group-item">{{ $value->alias }}</li>
                            @endforeach
                        @else
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>No hay usuarios asociados.</strong>
                                </li>
                            </ul>
                        @endif

                    </ul>
                </div>

                <div class="col-6">
                    <ul class="list-group list-group-flush">
                        @foreach ($permissions as $value)
                            <li class="list-group-item">{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
      </div>
</div>
