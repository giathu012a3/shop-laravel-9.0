# 🛒 Dự án Shop Laravel 9.0 (Phoenix) 🚀

Website bán hàng chuyên nghiệp, được tối ưu hóa giao diện và bảo mật dữ liệu.

## 🌟 Tính năng nổi bật đã cập nhật
- **Môi trường cực nhanh**: Chạy trên **Laravel Herd** (Windows).
- **Dữ liệu mẫu (Seeding)**: Tự động tạo hàng chục sản phẩm, danh mục và tài khoản mẫu.
- **Bảo mật (Validation)**: Kiểm soát chặt chẽ dữ liệu đầu vào cho cả Admin và Khách hàng.
- **Tối ưu hóa PHP 8.4**: Đã xử lý các cảnh báo lỗi thời (Deprecated) để web chạy mượt mà nhất.

## 🛠 Hướng dẫn cài đặt nhanh

### 1. Chuẩn bị
- Cài đặt **Laravel Herd** (Windows) để có PHP >= 8.1 và Nginx.
- Cài đặt **Node.js** (để chạy npm).
- Chuẩn bị **MySQL** (MySQL Workbench).

### 2. Các bước thiết lập
Mở Terminal tại thư mục dự án:

1. **Cài đặt thư viện:**
   ```bash
   composer install
   npm install
   ```

2. **Cấu hình Database:**
   - Tạo file `.env` (nếu chưa có): `copy .env.example .env`
   - Sửa thông số `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` trong `.env` cho khớp với MySQL của bạn.

3. **Khởi tạo dữ liệu:**
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   ```

4. **Biên dịch Giao diện:**
   ```bash
   npm run prod
   ```

### 3. Cách chạy và Đăng nhập
- Truy cập web tại: 👉 **[http://shop-laravel-9.0.test](http://shop-laravel-9.0.test)**

#### 🔑 Tài khoản thử nghiệm:
| Vai trò | Email | Mật khẩu |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `12345678` |
| **User** | `user1@gmail.com` | `12345678` |

---
*Dự án đã sẵn sàng để phát triển và sử dụng!*