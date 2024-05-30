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
    @endphp
    <h6>{{ $roles->count() }}</h6>
</div>
