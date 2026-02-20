# Shop Laravel 9.0

Ứng dụng được xây dựng với Laravel 9.0. Hướng dẫn này sẽ giúp bạn thiết lập và chạy dự án trên máy cá nhân.

## Yêu cầu tiên quyết

Trước khi bắt đầu, hãy đảm bảo bạn đã cài đặt những thứ sau trên máy của mình:

-   [PHP](https://www.php.net/downloads) >= 8.0
-   [Composer](https://getcomposer.org/)
-   [Node.js](https://nodejs.org/) & NPM
-   [MySQL](https://www.mysql.com/) hoặc MariaDB

## Cài đặt

Làm theo các bước sau để thiết lập dự án:

### 1. Clone Repository (Tải mã nguồn)
Clone repository này về máy của bạn.

### 2. Cài đặt Backend Dependencies
Mở terminal tại thư mục dự án và chạy lệnh:

```bash
composer install
```

### 3. Cấu hình Môi trường
Sao chép tệp môi trường mẫu để tạo tệp `.env` của riêng bạn:

```bash
cp .env.example .env
```
*Trên Windows (Command Prompt):* `copy .env.example .env`

Mở tệp `.env` và cấu hình thông tin kết nối cơ sở dữ liệu của bạn:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database_cua_ban
DB_USERNAME=user_database_cua_ban
DB_PASSWORD=pass_database_cua_ban
```

### 4. Tạo Key Ứng dụng
Tạo khóa mã hóa ứng dụng:

```bash
php artisan key:generate
```

### 5. Chạy Database Migrations
Tạo các bảng cơ sở dữ liệu:

```bash
php artisan migrate
```

### 6. Cài đặt Frontend Dependencies & Build
Dự án này sử dụng Laravel Mix để biên dịch assets.

```bash
npm install
npm run dev
```

## Chạy Ứng dụng

Khởi động server phát triển cục bộ:

```bash
php artisan serve
```

Ứng dụng sẽ có thể truy cập tại [http://localhost:8000](http://localhost:8000).

## Thông tin thêm

-   **Cấu hình Mail**: Để kiểm tra chức năng gửi email cục bộ, bạn có thể sử dụng [Mailhog](https://github.com/mailhog/MailHog) hoặc cấu hình SMTP của bạn trong `.env`.
-   **Storage Link**: Nếu bạn gặp vấn đề ảnh không hiển thị, bạn có thể cần liên kết thư mục storage:
    ```bash
    php artisan storage:link
    ```