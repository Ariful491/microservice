<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @method static Builder<static>|Role newModelQuery()
 * @method static Builder<static>|Role newQuery()
 * @method static Builder<static>|Role query()
 * @method static Builder<static>|Role whereId($value)
 * @method static Builder<static>|Role whereName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $guarded=['id'];

    public $timestamps = false;


  public function permissions(): BelongsToMany
  {
      return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
  }
}
