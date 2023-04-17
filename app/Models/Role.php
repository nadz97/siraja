<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use Uuids;

    protected $fillable = [
        'name', 'guard_name',
    ];

    protected $primaryKey = 'uuid';


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
