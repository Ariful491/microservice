<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property string $product_title
 * @property string $price
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @method static Builder<static>|OrderItem newModelQuery()
 * @method static Builder<static>|OrderItem newQuery()
 * @method static Builder<static>|OrderItem query()
 * @method static Builder<static>|OrderItem whereCreatedAt($value)
 * @method static Builder<static>|OrderItem whereId($value)
 * @method static Builder<static>|OrderItem whereOrderId($value)
 * @method static Builder<static>|OrderItem wherePrice($value)
 * @method static Builder<static>|OrderItem whereProductTitle($value)
 * @method static Builder<static>|OrderItem whereQuantity($value)
 * @method static Builder<static>|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    protected $guarded = ['id'];



    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
