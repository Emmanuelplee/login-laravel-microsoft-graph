<div>
    @php
        // use App\Models\User;
        // $user = new User();
        // $userCount = $user->permission($item->name)->count();
        // $userCount = User::whereHas('roles', function ($query) use ($permissionName) {
        //     $query->whereHas('permissions', function ($query) use ($permissionName) {
        //         $query->where('name', $permissionName);
        //     });
        // })->count();
        use App\Models\Role;
        $permissionName = $item->name;
        $roles = Role::whereHas('permissions', function($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->get();
        $names = $roles->pluck('name');
    @endphp
    <div>
        <strong>{{ $roles->count() }} »</strong>
        @foreach ($names as $key => $value)
            {{ $value }},
        @endforeach
    </div>
</div>
