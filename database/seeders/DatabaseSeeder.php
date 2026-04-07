<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Tạo tài khoản ADMIN mặc định
        \App\Models\User::create([
            'name' => 'ADMIN CHÍNH',
            'email' => 'admin@gmail.com',
            'usertype' => '1', // Giá trị 1 là Admin
            'password' => bcrypt('12345678'),
            'phone' => '0987654321',
            'address' => 'Hà Nội, Việt Nam',
            'email_verified_at' => now(), // Đánh dấu đã xác thực email
        ]);

        // 2. Tạo thêm 5 khách hàng mẫu
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\User::create([
                'name' => 'Khách hàng ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'usertype' => '0', // Giá trị 0 là Người dùng thường
                'password' => bcrypt('12345678'),
                'phone' => '012345678' . $i,
                'address' => 'Địa chỉ khách hàng ' . $i,
                'email_verified_at' => now(), // Đánh dấu đã xác thực email
            ]);
        }

        // 3. Tạo Danh mục (Categories)
        $categories = ['Thời trang', 'Điện tử', 'Gia dụng', 'Thể thao'];
        foreach ($categories as $name) {
            \App\Models\Category::create(['category_name' => $name]);
        }

        // 2. Tạo một số Sản phẩm mẫu (Products)
        $sampleImages = [
            '1707587862.png', '1707659818.jpg', '1707970734.jpg', 
            '1708000584.jpg', '1708007358.jpg', '1708007797.jpg'
        ];

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Product::create([
                'title' => 'Sản phẩm mẫu ' . $i,
                'description' => 'Đây là mô tả chi tiết của sản phẩm mẫu số ' . $i . ' có sẵn hình ảnh thực tế.',
                'image' => $sampleImages[array_rand($sampleImages)],
                'category' => $categories[array_rand($categories)],
                'quantity' => rand(10, 100),
                'price' => rand(100000, 2000000),
                'discount_price' => rand(50000, 100000),
            ]);
        }
    }
}
