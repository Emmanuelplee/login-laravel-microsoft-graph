<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                @foreach ($usersWithPermission as $value)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $value->alias }}</span>
                        <span>{{ $value->roles[0]->name }}</span>
                    </li>
                @endforeach
            </ul>

        </div>
      </div>
</div>
