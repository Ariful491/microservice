<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereEmail($value)
 * @method static Builder<static>|Order whereFirstName($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereLastName($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @property-read mixed $total
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read string $name
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected  $guarded = ['id'];


    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum(function (OrderItem $item) {
            return $item->price * $item->quantity;
        });
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
