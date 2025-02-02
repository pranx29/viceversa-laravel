<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define sample product data
        $products = [
            [
                'slug' => Str::slug('Flannel Button-Up Shirt'),
                'name' => 'Flannel Button-Up Shirt',
                'description' => '
                    This flannel button-up shirt is made from 100% cotton and features a classic plaid pattern.
                    It has a regular fit, long sleeves, and a button-up front. It is perfect for casual wear.',
                'price' => 3600.00,
                'discount' => 1000.00,
                'is_active' => true,
                'category_id' => 4,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/5261fced-d82d-47f1-b59c-f93a4c3e8054.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/d0d52482-1b7a-42d6-9192-f1c79419d828.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/916c9d55-0c7a-4ac7-8759-64760825b7e5.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/77995a09-7bd4-4301-88ef-1fae7fb0cf32.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                    ['path' => 'https://n.nordstrommedia.com/it/957097d6-6539-43aa-940a-a11a66b61537.jpeg?crop=pad&w=780&h=1196', 'order' => 5],
                    [
                        'path' => 'https://n.nordstrommedia.com/it/38b7954d-fe54-4630-88f0-238cd66b0dff.jpeg?crop=pad&w=780&h=1196',
                        'order' => 6
                    ]

                ],
            ],
            [
                'slug' => Str::slug('Commuter Slim Fit Shirt'),
                'name' => 'Commuter Slim Fit Shirt',
                'description' => '
                    This slim fit shirt is made from a blend of cotton, polyester, and spandex.
                    It has a slim fit, long sleeves, and a button-up front. It is perfect for work or casual wear.',
                'price' => 3600.00,
                'discount' => 0.00,
                'is_active' => true,
                'category_id' => 4,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/cbdbaf47-ae36-477e-a73a-74a738a93470.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/33186bd5-1bde-4748-b889-4a736a25d64f.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/9e893701-40b7-4d03-906e-450b426e427e.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/d56a249e-dfe0-4113-8330-f1cfffe6f4f5.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                ],
            ],
            [
                'slug' => Str::slug('Redact Graphic T-Shirt'),
                'name' => 'Redact Graphic T-Shirt',
                'description' => '
                    This graphic t-shirt is made from 100% cotton and features a unique graphic print.
                    It has a regular fit, short sleeves, and a crew neck. It is perfect for casual wear.',
                'price' => 4000.00,
                'discount' => 500.00,
                'is_active' => true,
                'category_id' => 1,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/86e9d3fd-72b5-4a31-829b-7b13686ad2d1.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/7bdedd79-125a-40d9-92a2-f2ad27da9e72.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/99c913e4-c885-409b-9aca-07cd893b917c.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/282ff582-cf74-4052-938e-4606df43b163.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                ],
            ],
            [
                'slug' => Str::slug('Oversize Graphic T-Shirt'),
                'name' => 'Oversize Graphic T-Shirt',
                'description' => '
                    This graphic t-shirt is made from 100% cotton and features an oversized fit.
                    It has a crew neck, short sleeves, and a unique graphic print. It is perfect for casual wear.',
                'price' => 4200.00,
                'discount' => 0.00,
                'is_active' => true,
                'category_id' => 1,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/ec4b1dfd-a481-4f89-9a3c-1da0524fef10.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/bf9b3b52-8a7e-4aeb-b210-361eb96bc44a.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/f354a3ce-ad62-44ef-aa31-7d9bc976ccaf.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/282ff582-cf74-4052-938e-4606df43b163.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                    ['path' => 'https://n.nordstrommedia.com/it/ae0fd0d8-20ec-4a11-a223-da665f2d96ee.jpeg?crop=pad&w=780&h=1196', 'order' => 5],
                    ['path' => 'https://n.nordstrommedia.com/it/0133c27b-5f4a-4355-b93f-a0ebc6e7a34f.jpeg?crop=pad&w=780&h=1196', 'order' => 6],
                ],
            ],
            [
                'slug' => Str::slug('Inlet Knit Blazer'),
                'name' => 'Inlet Knit Blazer',
                'description' => '
                    This knit blazer is made from a blend of cotton and polyester, providing both comfort and style. It features a slim fit, long sleeves, and a single-breasted front with button closure.
                    ',
                'price' => 6000.00,
                'discount' => 700.00,
                'is_active' => true,
                'category_id' => 2,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/d508b425-1550-409d-ad71-b82d63ba566d.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/f06ef1e3-00bb-460e-ad77-ea00ae168eda.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/2cbba115-4177-4151-9c48-6ec12f10fc23.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/bf38f3a3-bd07-4288-a22c-5c2d96af242b.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                ],
            ],
            [
                'slug' => Str::slug('Hanry Sport Coat'),
                'name' => 'Hanry Sport Coat',
                'description' => '
                    This knit sport coat is made from a blend of cotton and polyester, providing both comfort and style. It features a slim fit, long sleeves, and a single-breasted front with button closure.
                    ',
                'price' => 5500.00,
                'discount' => 0.00,
                'is_active' => true,
                'category_id' => 2,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/afeb2369-5071-49ca-b4b5-378aba70e189.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/98719912-acff-444d-ae97-6ae234f9fee9.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/a3864d91-477e-4a39-9dff-91757ecd8376.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/bbe82f1c-3d74-4e34-8141-cc21485c3d36.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                    ['path' => 'https://n.nordstrommedia.com/it/461ad7de-a02c-4dc0-9ca7-1bd14fecec97.jpeg?crop=pad&w=780&h=1196', 'order' => 5],
                ],
            ],
            [
                'slug' => Str::slug('Floyde Relaxed Twill Shorts'),
                'name' => 'Floyde Relaxed Twill Shorts',
                'description' => '
                    These relaxed twill shorts are made from a blend of cotton and spandex, providing both comfort and style. They feature a relaxed fit, knee length, and a zip fly with button closure.
                    ',
                'price' => 3000.00,
                'discount' => 0.00,
                'is_active' => true,
                'category_id' => 5,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/6adf32c6-9e9e-48e4-ac8f-d678e4363d06.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/1b750837-5213-405d-b88d-ce4d7964a7d0.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/a3864d91-477e-4a39-9dff-91757ecd8376.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/3679ad54-b4e0-4f35-ae2c-4241fbe674da.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                    ['path' => 'https://n.nordstrommedia.com/it/830829c3-92ae-4e11-b0c4-a2eaeeee5198.jpeg?crop=pad&w=780&h=1196', 'order' => 5],
                    ['path' => 'https://n.nordstrommedia.com/it/ab39fa77-4931-468f-a175-75fe78c52e28.jpeg?crop=pad&w=780&h=1196', 'order' => 6],
                ],
            ],
            [
                'slug' => Str::slug('Ripstop Short'),
                'name' => 'Ripstop Short',
                'description' => '
                    These ripstop shorts are made from a blend of cotton and spandex, providing both comfort and style. They feature a relaxed fit, knee length, and a zip fly with button closure.
                    ',
                'price' => 3400.00,
                'discount' => 200.00,
                'is_active' => true,
                'category_id' => 5,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/f3dfe151-1a5e-4b84-8c61-de5d5082fd25.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/95acab53-29c6-4c1b-a739-ab068976b517.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/b0419d0a-856e-474c-8e5d-12f59fc5fd3e.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/95acab53-29c6-4c1b-a739-ab068976b517.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                    ['path' => 'https://n.nordstrommedia.com/it/0dd19bde-6e37-4245-9db1-901dc5d070eb.jpeg?crop=pad&w=780&h=1196', 'order' => 5],
                    ['path' => 'https://n.nordstrommedia.com/it/0a996c68-03c6-4b9b-9aa6-ce88a7fade6e.jpeg?crop=pad&w=780&h=1196', 'order' => 6],
                ],
            ],
            [
                'slug' => Str::slug('Terry 5-Pocket Pants'),
                'name' => 'Terry 5-Pocket Pants',
                'description' => '
                    These 5-pocket pants are made from a blend of cotton and spandex, providing both comfort and style. They feature a slim fit, knee length, and a zip fly with button closure.
                    ',
                'price' => 4500.00,
                'discount' => 0.00,
                'is_active' => true,
                'category_id' => 3,
                'sizes' => [
                    ['size_id' => 1, 'quantity_in_stock' => 10],
                    ['size_id' => 2, 'quantity_in_stock' => 20],
                ],
                'images' => [
                    ['path' => 'https://n.nordstrommedia.com/it/ce85dfb4-8851-4cfd-bac8-665736120a0c.jpeg?crop=pad&w=780&h=1196', 'order' => 1],
                    ['path' => 'https://n.nordstrommedia.com/it/a7fa2fd2-9fe4-40ed-9952-fac3ff8e9a92.jpeg?crop=pad&w=780&h=1196', 'order' => 2],
                    ['path' => 'https://n.nordstrommedia.com/it/893e27f5-8f14-417e-ad55-d7f5d0bb61a1.jpeg?crop=pad&w=780&h=1196', 'order' => 3],
                    ['path' => 'https://n.nordstrommedia.com/it/2d88c786-dcbd-4080-b6ac-df02a93fab21.jpeg?crop=pad&w=780&h=1196', 'order' => 4],
                ],
            ],
        ];

        // Loop through each product and insert data
        foreach ($products as $product) {
            // Insert into products table
            $productId = DB::table('products')->insertGetId([
                'slug' => $product['slug'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'discount' => $product['discount'],
                'is_active' => $product['is_active'],
                'category_id' => $product['category_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert related sizes into product_size table
            foreach ($product['sizes'] as $size) {
                DB::table('product_size')->insert([
                    'product_id' => $productId,
                    'size_id' => $size['size_id'],
                    'quantity_in_stock' => $size['quantity_in_stock'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Insert related images into product_images table
            foreach ($product['images'] as $image) {
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'path' => $image['path'],
                    'order' => $image['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


    }
}
