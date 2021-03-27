<?php
/**
 * Copyright (c) 2020. Electric
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Modules\Orders\Models\Entities\OrderShop;
use App\Modules\Orders\Models\Entities\OrderShopBank;
use App\Modules\Systems\Models\Entities\RoleHierarchy;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 10;
        $faker = Faker::create();
        /* Create roles */
        $shopRole = Role::create(['name' => 'shop', 'guard_name' => 'shop']);
        RoleHierarchy::create([
            'role_id' => $shopRole->id,
            'hierarchy' => 4,
        ]);

        /*  insert users   */
        $user = OrderShop::create([
            'name' => 'electric',
            'phone' => $faker->phoneNumber(),
            'email' => 'huydien.it@gmail.com',
            'email_verified_at' => now(),
            'address' => $faker->address(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'shop'
        ]);
        $user->assignRole($shopRole);
        OrderShopBank::create([
            'id' => $user->id,
            'bank_name' => Str::random(10),
            'bank_branch' => Str::random(20),
            'stk_name' => Str::random(50),
            'stk' => Str::random(15),
            'cycle_cod' => 'payment_twice_per_week_odd'
        ]);

        for($i = 0; $i<$numberOfUsers; $i++){
            $user = OrderShop::create([
                'name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'address' => $faker->address(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'menuroles' => 'shop'
            ]);
            $user->assignRole($shopRole);
            OrderShopBank::create([
                'id' => $user->id,
                'bank_name' => Str::random(10),
                'bank_branch' => Str::random(20),
                'stk_name' => Str::random(50),
                'stk' => Str::random(15),
                'cycle_cod' => 'payment_twice_per_week_odd'
            ]);
        }
    }
}