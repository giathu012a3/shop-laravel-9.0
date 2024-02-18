## Thành viên nhóm em gồm 
1. Nguyễn Vũ Ngân Châu	MSSV:501220737
2. Lê Hoàng Anh Quốc		MSSV:501220734
3. Phạm Văn Tài	MSSV:501220744
4. Nguyễn Gia Thụ MSSV:501220765

### Thay 
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
## Thành
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=nguyengiathu24052004@gmail.com
MAIL_PASSWORD=hvqdewbenwypicbc
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="ngyengiathu24052004@gmail.com"
MAIL_FROM_NAME="Ecommerce Mail"

## Chạy lệnh 
Chạy lệnh composer install hoặc composer update

## Chạy lệnh 
php artisan migrate 
## Chạy lệnh 
php artisan serve 