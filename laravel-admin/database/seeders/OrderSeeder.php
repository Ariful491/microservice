<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Database\Factories\OrderFactory;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderFactory::new()->count(30)->create()->each(function ($order) {
            OrderItemFactory::new()
                ->count(rand(1,5))
                ->create([
                    'order_id' => $order->id,
                ]);
        });

    }
}
