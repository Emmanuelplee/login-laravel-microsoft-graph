<div>
    @php

        use Illuminate\Support\Facades\DB;

        $modelfind = (object)[];
        $name = '';
        // Usando explode
        $parts = explode('\\', $item->subject_type);
        $model = end($parts);
        if ($item->subject_id != null) {
            if ($model === 'Role') {
                // $modelfind = Role::find($item->subject_id);
                $modelfind = DB::table('roles')->where('id','=',$item->subject_id)->first();
                $name = $modelfind->name;
                }
            if ($model === 'User') {
                // $modelfind = User::find($item->subject_id);
                $modelfind = DB::table('users')->where('id','=',$item->subject_id)->first();

                $name = explode(" ",($modelfind->name != null ? $modelfind->name : ''));
                $surname = explode(" ",$modelfind->surname != null ? $modelfind->surname : '');
                $full_name = $name[0]. " ". $surname[0];
                strlen($full_name) <= 1 ? $full_name = $modelfind->alias : $full_name;

                $name = $full_name;
            }
            if ($model === 'Permissions') {
                // $modelfind = Permissions::find($item->subject_id);
                $modelfind = DB::table('permissions')->where('id','=',$item->subject_id)->first();
                $name = $modelfind->name;
            }
        }
        // dump($name);
    @endphp
    {{ $name }}
</div>
