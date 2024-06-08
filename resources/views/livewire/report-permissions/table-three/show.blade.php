<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                @foreach ($permissions as $value)
                    <li class="list-group-item">{{ $value }}</li>
                @endforeach
            </ul>

        </div>
      </div>
</div>
