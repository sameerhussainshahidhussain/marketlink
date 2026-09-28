<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Market;
use App\Models\FarmerProfile;
use App\Models\Product;
use App\Models\Announcement;
use App\Models\PickupSlot;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Notifications\OrderStatusUpdatedNotification;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        $admin = User::updateOrCreate(
            ['email' => 'sameer@gmail.com'],
            [
                'name'     => 'Sameer',
                'password' => Hash::make('1234567890'),
                'role'     => 'admin',
                'status'   => 'active',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Sameer',
                'password' => Hash::make('1234567890'),
                'role'     => 'admin',
                'status'   => 'active',
            ]
        );

        // Default categories
        $cats = [];
        foreach ([
            'Vegetables', 'Fruits', 'Dairy', 'Eggs',
            'Meat', 'Honey', 'Herbs', 'Grains', 'Flowers', 'Preserves',
        ] as $catName) {
            $cats[$catName] = Category::updateOrCreate(
                ['name' => $catName],
                ['slug' => Str::slug($catName), 'status' => 'active']
            );
        }

        // Seed markets
        $markets = [];
        foreach ([
            [
                'market_name'    => 'Green Valley Farmers Market',
                'city'           => 'Lahore',
                'address'        => 'Liberty Market, Gulberg III, Lahore',
                'description'    => 'The largest open-air farmers market in Lahore, running every Saturday morning.',
                'operating_days' => 'Saturday, Sunday',
                'opening_time'   => '07:00:00',
                'closing_time'   => '13:00:00',
                'status'         => 'active',
                'latitude'       => '31.52040000',
                'longitude'      => '74.35870000',
            ],
            [
                'market_name'    => 'Sunrise Organic Market',
                'city'           => 'Karachi',
                'address'        => 'DHA Phase 6, Karachi',
                'description'    => 'Premium organic produce every Friday and Saturday.',
                'operating_days' => 'Friday, Saturday',
                'opening_time'   => '08:00:00',
                'closing_time'   => '14:00:00',
                'status'         => 'active',
                'latitude'       => '24.86070000',
                'longitude'      => '67.00110000',
            ],
            [
                'market_name'    => 'Capital Fresh Market',
                'city'           => 'Islamabad',
                'address'        => 'F-7 Markaz, Islamabad',
                'description'    => 'Weekend market with fresh produce from nearby farms.',
                'operating_days' => 'Saturday, Sunday',
                'opening_time'   => '09:00:00',
                'closing_time'   => '15:00:00',
                'status'         => 'active',
                'latitude'       => '33.72150000',
                'longitude'      => '73.04330000',
            ],
        ] as $m) {
            $slug = Str::slug($m['market_name']);
            $markets[] = Market::updateOrCreate(
                ['slug' => $slug],
                array_merge($m, ['slug' => $slug])
            );
        }

        // Seed farmers
        $farmersData = [
            [
                'name'          => 'Ahmed Ali',
                'email'         => 'ahmed@gmail.com',
                'phone'         => '0300-1234567',
                'city'          => 'Lahore',
                'business_name' => 'Ali Organic Farm',
                'description'   => 'Third-generation vegetable farmer from Lahore. We grow everything organically without any chemical inputs.',
                'certification' => 'USDA Organic Certified',
                'farm_address'  => 'Plot 44, Bedian Road, Lahore',
            ],
            [
                'name'          => 'Fatima Khan',
                'email'         => 'fatima@gmail.com',
                'phone'         => '0311-9876543',
                'city'          => 'Karachi',
                'business_name' => 'Khan Fresh Dairy',
                'description'   => 'Specializing in exotic fruits and fresh dairy products from our family farm.',
                'certification' => 'Pure Dairy Assurance',
                'farm_address'  => 'Malir Agricultural Zone, Karachi',
            ],
            [
                'name'          => 'Hassan Raza',
                'email'         => 'hassan@gmail.com',
                'phone'         => '0333-5551234',
                'city'          => 'Islamabad',
                'business_name' => 'Raza Honey Co.',
                'description'   => 'Beekeeper and honey producer. Natural honey harvested from mountain flowers.',
                'certification' => '100% Raw Harvest',
                'farm_address'  => 'Murree Foothills, Islamabad',
            ],
            [
                'name'          => 'Sara Malik',
                'email'         => 'sara@gmail.com',
                'phone'         => '0321-7771234',
                'city'          => 'Lahore',
                'business_name' => 'Malik Herb Gardens',
                'description'   => 'Herb and flower farmer. We grow more than 50 varieties of fresh herbs and flowers.',
                'certification' => 'Eco-Botanical Certified',
                'farm_address'  => 'Raiwind Road, Lahore',
            ],
        ];

        $farmers = [];
        foreach ($farmersData as $i => $fd) {
            $user = User::updateOrCreate(
                ['email' => $fd['email']],
                [
                    'name'     => $fd['name'],
                    'password' => Hash::make('1234567890'),
                    'role'     => 'farmer',
                    'status'   => 'active',
                    'phone'    => $fd['phone'],
                ]
            );

            FarmerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'business_name'   => $fd['business_name'],
                    'description'     => $fd['description'],
                    'address'         => $fd['farm_address'],
                    'location_name'   => $fd['city'],
                    'approval_status' => 'approved',
                    'contact_person'  => $fd['name'],
                ]
            );

            // Attach farmer to a market
            $market = $markets[$i % count($markets)];
            $user->markets()->syncWithoutDetaching([$market->id]);

            $farmers[] = $user;
        }

        // Seed sample products
        $productsData = [
            // Ahmed - Vegetables
            ['name' => 'Organic Spinach',    'farmer' => 0, 'cat' => 'Vegetables', 'price' => 120,  'unit' => 'bunch',   'stock' => 50,  'desc' => 'Fresh organic spinach, hand-picked daily.', 'img' => 'products/spinach.jpg'],
            ['name' => 'Heirloom Tomatoes',  'farmer' => 0, 'cat' => 'Vegetables', 'price' => 200,  'unit' => 'kg',      'stock' => 80,  'desc' => 'Vine-ripened heirloom tomatoes, rich in flavour.', 'img' => 'products/tomatoes.jpg'],
            ['name' => 'Baby Carrots',       'farmer' => 0, 'cat' => 'Vegetables', 'price' => 150,  'unit' => 'bag',     'stock' => 60,  'desc' => 'Sweet baby carrots, perfect for snacking.', 'img' => 'products/carrots.jpg'],
            ['name' => 'Fresh Broccoli',     'farmer' => 0, 'cat' => 'Vegetables', 'price' => 180,  'unit' => 'head',    'stock' => 40,  'desc' => 'Large fresh broccoli heads, grown without pesticides.', 'img' => 'products/broccoli.jpg'],
            // Fatima - Fruits & Dairy
            ['name' => 'Strawberries',       'farmer' => 1, 'cat' => 'Fruits',     'price' => 350,  'unit' => 'punnet',  'stock' => 30,  'desc' => 'Sweet and juicy strawberries, seasonal.', 'img' => 'products/strawberries.jpg'],
            ['name' => 'Organic Mangoes',    'farmer' => 1, 'cat' => 'Fruits',     'price' => 400,  'unit' => 'kg',      'stock' => 100, 'desc' => 'Premium Anwar Ratol mangoes from our orchard.', 'img' => 'products/mangoes.jpg'],
            ['name' => 'Farm Fresh Milk',    'farmer' => 1, 'cat' => 'Dairy',      'price' => 180,  'unit' => 'litre',   'stock' => 50,  'desc' => 'Fresh buffalo milk, delivered daily.', 'img' => 'products/milk.jpg'],
            ['name' => 'Natural Yogurt',     'farmer' => 1, 'cat' => 'Dairy',      'price' => 220,  'unit' => 'kg',      'stock' => 40,  'desc' => 'Thick and creamy homemade yogurt.', 'img' => 'products/yogurt.jpg'],
            // Hassan - Honey
            ['name' => 'Wildflower Honey',   'farmer' => 2, 'cat' => 'Honey',      'price' => 800,  'unit' => 'jar',     'stock' => 25,  'desc' => 'Raw wildflower honey from mountain hives.', 'img' => 'products/honey-wild.jpg'],
            ['name' => 'Sidr Honey',         'farmer' => 2, 'cat' => 'Honey',      'price' => 1500, 'unit' => 'jar',     'stock' => 15,  'desc' => 'Premium Sidr honey, considered the finest.', 'img' => 'products/honey-sidr.jpg'],
            ['name' => 'Acacia Honey',       'farmer' => 2, 'cat' => 'Honey',      'price' => 950,  'unit' => 'jar',     'stock' => 20,  'desc' => 'Light and delicate acacia blossom honey.', 'img' => 'products/honey-acacia.jpg'],
            // Sara - Herbs & Flowers
            ['name' => 'Fresh Mint',         'farmer' => 3, 'cat' => 'Herbs',      'price' => 80,   'unit' => 'bunch',   'stock' => 80,  'desc' => 'Fragrant fresh mint, perfect for teas and cooking.', 'img' => 'products/mint.jpg'],
            ['name' => 'Coriander Bundle',   'farmer' => 3, 'cat' => 'Herbs',      'price' => 60,   'unit' => 'bunch',   'stock' => 100, 'desc' => 'Fresh green coriander, harvested this morning.', 'img' => 'products/coriander.jpg'],
            ['name' => 'Lavender Bouquet',   'farmer' => 3, 'cat' => 'Flowers',    'price' => 450,  'unit' => 'bouquet', 'stock' => 20,  'desc' => 'Beautiful dried lavender bouquets.', 'img' => 'products/lavender.jpg'],
            ['name' => 'Basil Pot',          'farmer' => 3, 'cat' => 'Herbs',      'price' => 200,  'unit' => 'pot',     'stock' => 35,  'desc' => 'Live basil plant in terracotta pot.', 'img' => 'products/basil.jpg'],
        ];

        $createdProducts = [];
        foreach ($productsData as $pd) {
            $slug = Str::slug($pd['name'] . '-' . $farmers[$pd['farmer']]->id);
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'farmer_id'      => $farmers[$pd['farmer']]->id,
                    'category_id'    => $cats[$pd['cat']]->id,
                    'name'           => $pd['name'],
                    'slug'           => $slug,
                    'description'    => $pd['desc'],
                    'price'          => $pd['price'],
                    'unit'           => $pd['unit'],
                    'stock_quantity' => $pd['stock'],
                    'image'          => $pd['img'],
                    'status'         => 'active',
                    'availability'   => 'available',
                ]
            );
            $createdProducts[] = $product;
        }

        $legacyImages = [
            'Organic Tomatoes' => 'products/tomatoes.jpg',
            'Baby Spinach' => 'products/spinach.jpg',
            'Fresh Mint' => 'products/mint.jpg',
            'Butter Lettuce' => 'products/basil.jpg',
            'Mango (Chaunsa)' => 'products/mangoes.jpg',
            'Red Apples' => 'products/strawberries.jpg',
            'Free-Range Eggs' => 'products/milk.jpg',
            'Buffalo Milk' => 'products/milk.jpg',
            'Sidr Honey' => 'products/honey-sidr.jpg',
            'Wheat Flour (Desi)' => 'products/honey-acacia.jpg',
        ];
        foreach ($legacyImages as $pName => $pImg) {
            Product::where('name', $pName)->where(function($q) {
                $q->whereNull('image')->orWhere('image', '');
            })->update(['image' => $pImg]);
        }

        // Pickup slots for each farmer
        $createdSlots = [];
        foreach ($farmers as $i => $farmer) {
            $market = $markets[$i % count($markets)];
            foreach ([
                now()->next('Saturday'),
                now()->next('Sunday'),
            ] as $date) {
                $slot = PickupSlot::updateOrCreate(
                    [
                        'farmer_id'   => $farmer->id,
                        'market_id'   => $market->id,
                        'pickup_date' => $date->format('Y-m-d'),
                    ],
                    [
                        'start_time'  => '08:00:00',
                        'end_time'    => '12:00:00',
                        'max_orders'  => 20,
                        'cutoff_time' => $date->copy()->subDay()->setTime(20, 0)->format('Y-m-d H:i:s'),
                        'status'      => 'available',
                    ]
                );
                $createdSlots[] = $slot;
            }
        }

        // Announcements
        Announcement::updateOrCreate(
            ['title' => 'Welcome to MarketLink!'],
            [
                'message'      => 'Welcome to MarketLink! Pre-order fresh organic harvest from verified local growers during the week and collect your crate directly from their stall on Saturday morning. Pay in cash when collecting.',
                'type'         => 'general',
                'status'       => 'published',
                'created_by'   => $admin->id,
                'published_at' => now(),
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Summer Harvest Now Open for Pre-Orders'],
            [
                'message'      => 'Fresh Anwar Ratol mangoes, raw mountain Sidr honey, and farm-fresh dairy are available for reserve this weekend at Liberty Market (Lahore) and DHA Phase 6 (Karachi). Cutoff is Friday 8:00 PM.',
                'type'         => 'general',
                'status'       => 'published',
                'created_by'   => $admin->id,
                'published_at' => now(),
            ]
        );

        // Sample customer accounts (Authentic Muslim names, @gmail.com, password: 1234567890)
        $customer = User::updateOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name'     => 'Tariq Mehmood',
                'password' => Hash::make('1234567890'),
                'role'     => 'customer',
                'status'   => 'active',
                'phone'    => '0301-1112233',
            ]
        );

        User::updateOrCreate(
            ['email' => 'tariq@gmail.com'],
            [
                'name'     => 'Tariq Mehmood',
                'password' => Hash::make('1234567890'),
                'role'     => 'customer',
                'status'   => 'active',
                'phone'    => '0301-1112233',
            ]
        );

        $customer2 = User::updateOrCreate(
            ['email' => 'amina@gmail.com'],
            [
                'name'     => 'Amina Tariq',
                'password' => Hash::make('1234567890'),
                'role'     => 'customer',
                'status'   => 'active',
                'phone'    => '0322-4445566',
            ]
        );

        User::updateOrCreate(
            ['email' => 'zainab@gmail.com'],
            [
                'name'     => 'Zainab Bibi',
                'password' => Hash::make('1234567890'),
                'role'     => 'customer',
                'status'   => 'active',
                'phone'    => '0313-7788990',
            ]
        );

        User::updateOrCreate(
            ['email' => 'bilal@gmail.com'],
            [
                'name'     => 'Bilal Ahmed',
                'password' => Hash::make('1234567890'),
                'role'     => 'customer',
                'status'   => 'active',
                'phone'    => '0324-9988776',
            ]
        );

        // Customer favorites
        $customer->favoriteFarmers()->syncWithoutDetaching([$farmers[0]->id, $farmers[1]->id]);
        if (!empty($createdProducts)) {
            $customer->favoriteProducts()->syncWithoutDetaching([$createdProducts[0]->id, $createdProducts[4]->id, $createdProducts[8]->id]);
        }

        // Sample orders & reviews
        // Order 1: Completed Order from Ahmed Ali (Tomatoes & Spinach)
        $order1 = Order::updateOrCreate(
            ['order_number' => 'ORD-2026-00101'],
            [
                'customer_id'       => $customer->id,
                'farmer_id'         => $farmers[0]->id,
                'market_id'         => $markets[0]->id,
                'pickup_slot_id'    => $createdSlots[0]->id ?? null,
                'pickup_date'       => Carbon::now()->subDays(5)->format('Y-m-d'),
                'pickup_start_time' => '08:00:00',
                'pickup_end_time'   => '12:00:00',
                'subtotal'          => 520.00,
                'total_amount'      => 520.00,
                'payment_method'    => 'pay_at_pickup',
                'order_status'      => 'completed',
                'cutoff_time'       => Carbon::now()->subDays(6)->setTime(20, 0),
                'notes'             => 'Please pack gently in wooden crate.',
                'created_at'        => Carbon::now()->subDays(7),
                'updated_at'        => Carbon::now()->subDays(5),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $createdProducts[0]->id],
            [
                'product_name' => $createdProducts[0]->name,
                'price'        => $createdProducts[0]->price,
                'quantity'     => 1,
                'subtotal'     => $createdProducts[0]->price * 1,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $createdProducts[1]->id],
            [
                'product_name' => $createdProducts[1]->name,
                'price'        => $createdProducts[1]->price,
                'quantity'     => 2,
                'subtotal'     => $createdProducts[1]->price * 2,
            ]
        );

        // Review for Order 1
        Review::updateOrCreate(
            ['order_id' => $order1->id, 'customer_id' => $customer->id],
            [
                'farmer_id'         => $farmers[0]->id,
                'product_id'        => $createdProducts[1]->id,
                'rating'            => 5,
                'comment'           => 'The heirloom tomatoes were extraordinarily sweet and flavorful. Picked up in 2 minutes at Stall 04!',
                'farmer_reply'      => 'Thank you so much! We harvest them vine-ripe just before market morning.',
                'farmer_replied_at' => Carbon::now()->subDays(4),
                'status'            => 'approved',
                'created_at'        => Carbon::now()->subDays(5),
            ]
        );

        // Order 2: Completed Order from Fatima Khan (Strawberries & Fresh Milk)
        $order2 = Order::updateOrCreate(
            ['order_number' => 'ORD-2026-00102'],
            [
                'customer_id'       => $customer->id,
                'farmer_id'         => $farmers[1]->id,
                'market_id'         => $markets[1]->id,
                'pickup_slot_id'    => $createdSlots[2]->id ?? null,
                'pickup_date'       => Carbon::now()->subDays(2)->format('Y-m-d'),
                'pickup_start_time' => '08:00:00',
                'pickup_end_time'   => '12:00:00',
                'subtotal'          => 530.00,
                'total_amount'      => 530.00,
                'payment_method'    => 'pay_at_pickup',
                'order_status'      => 'completed',
                'cutoff_time'       => Carbon::now()->subDays(3)->setTime(20, 0),
                'notes'             => 'Morning collection.',
                'created_at'        => Carbon::now()->subDays(3),
                'updated_at'        => Carbon::now()->subDays(2),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $createdProducts[4]->id],
            [
                'product_name' => $createdProducts[4]->name,
                'price'        => $createdProducts[4]->price,
                'quantity'     => 1,
                'subtotal'     => $createdProducts[4]->price * 1,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $createdProducts[6]->id],
            [
                'product_name' => $createdProducts[6]->name,
                'price'        => $createdProducts[6]->price,
                'quantity'     => 1,
                'subtotal'     => $createdProducts[6]->price * 1,
            ]
        );

        // Review for Order 2
        Review::updateOrCreate(
            ['order_id' => $order2->id, 'customer_id' => $customer->id],
            [
                'farmer_id'         => $farmers[1]->id,
                'product_id'        => $createdProducts[4]->id,
                'rating'            => 5,
                'comment'           => 'Crisp sweet strawberries, the whole family loved them. Highly recommend Khan Fresh Dairy!',
                'farmer_reply'      => 'Delighted to hear! We will have more punnets ready this coming weekend.',
                'farmer_replied_at' => Carbon::now()->subDay(),
                'status'            => 'approved',
                'created_at'        => Carbon::now()->subDays(2),
            ]
        );

        // Order 3: Active Order (Ready for pickup) for Demo Customer
        $order3 = Order::updateOrCreate(
            ['order_number' => 'ORD-2026-00103'],
            [
                'customer_id'       => $customer->id,
                'farmer_id'         => $farmers[0]->id,
                'market_id'         => $markets[0]->id,
                'pickup_slot_id'    => $createdSlots[0]->id ?? null,
                'pickup_date'       => Carbon::now()->next('Saturday')->format('Y-m-d'),
                'pickup_start_time' => '08:00:00',
                'pickup_end_time'   => '12:00:00',
                'subtotal'          => 330.00,
                'total_amount'      => 330.00,
                'payment_method'    => 'pay_at_pickup',
                'order_status'      => 'ready_for_pickup',
                'cutoff_time'       => Carbon::now()->next('Friday')->setTime(20, 0),
                'notes'             => 'Will pickup before 10 AM.',
                'created_at'        => Carbon::now()->subHours(6),
                'updated_at'        => Carbon::now()->subHours(2),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'product_id' => $createdProducts[2]->id],
            [
                'product_name' => $createdProducts[2]->name,
                'price'        => $createdProducts[2]->price,
                'quantity'     => 1,
                'subtotal'     => $createdProducts[2]->price * 1,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'product_id' => $createdProducts[3]->id],
            [
                'product_name' => $createdProducts[3]->name,
                'price'        => $createdProducts[3]->price,
                'quantity'     => 1,
                'subtotal'     => $createdProducts[3]->price * 1,
            ]
        );

        // Order 4: Customer 2 completed order from Hassan Raza (Honey)
        $order4 = Order::updateOrCreate(
            ['order_number' => 'ORD-2026-00104'],
            [
                'customer_id'       => $customer2->id,
                'farmer_id'         => $farmers[2]->id,
                'market_id'         => $markets[2]->id,
                'pickup_slot_id'    => $createdSlots[4]->id ?? null,
                'pickup_date'       => Carbon::now()->subDays(10)->format('Y-m-d'),
                'pickup_start_time' => '09:00:00',
                'pickup_end_time'   => '13:00:00',
                'subtotal'          => 1500.00,
                'total_amount'      => 1500.00,
                'payment_method'    => 'pay_at_pickup',
                'order_status'      => 'completed',
                'cutoff_time'       => Carbon::now()->subDays(11)->setTime(20, 0),
                'notes'             => 'Special gift packing.',
                'created_at'        => Carbon::now()->subDays(12),
                'updated_at'        => Carbon::now()->subDays(10),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order4->id, 'product_id' => $createdProducts[9]->id],
            [
                'product_name' => $createdProducts[9]->name,
                'price'        => $createdProducts[9]->price,
                'quantity'     => 1,
                'subtotal'     => 1500.00,
            ]
        );

        Review::updateOrCreate(
            ['order_id' => $order4->id, 'customer_id' => $customer2->id],
            [
                'farmer_id'         => $farmers[2]->id,
                'product_id'        => $createdProducts[9]->id,
                'rating'            => 5,
                'comment'           => 'Purest Sidr honey we have ever tasted. Authentic taste of mountain wildflowers.',
                'farmer_reply'      => 'Thank you Amina! Our hives are kept high in the Murree pine hills.',
                'farmer_replied_at' => Carbon::now()->subDays(9),
                'status'            => 'approved',
                'created_at'        => Carbon::now()->subDays(10),
            ]
        );

        $this->command->info('');
        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('  Admin:      sameer@gmail.com    / 1234567890  (Name: Sameer)');
        $this->command->info('  Farmer 1:   ahmed@gmail.com     / 1234567890  (Ahmed Ali)');
        $this->command->info('  Farmer 2:   fatima@gmail.com    / 1234567890  (Fatima Khan)');
        $this->command->info('  Farmer 3:   hassan@gmail.com    / 1234567890  (Hassan Raza)');
        $this->command->info('  Farmer 4:   sara@gmail.com      / 1234567890  (Sara Malik)');
        $this->command->info('  Customer 1: customer@gmail.com  / 1234567890  (Tariq Mehmood)');
        $this->command->info('  Customer 2: amina@gmail.com     / 1234567890  (Amina Tariq)');
        $this->command->info('  Customer 3: zainab@gmail.com    / 1234567890  (Zainab Bibi)');
        $this->command->info('  Customer 4: bilal@gmail.com     / 1234567890  (Bilal Ahmed)');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}
