



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
MAIL_USERNAME=gmail cua ban
MAIL_PASSWORD=  pass
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="gmail cua ban"
MAIL_FROM_NAME="Ecommerce Mail"


## Chạy lệnh 
Chạy lệnh composer install hoặc composer update

## Chạy lệnh 
php artisan migrate 
## Chạy lệnh 
php artisan serve 