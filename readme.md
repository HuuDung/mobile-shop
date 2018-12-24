#role:
    code: hùng và dũng
    document: sơn và hùng( sơ đồ chuyển màn hình và các giao diện)

### Requirement
```
Mysql 5.5+ or Postgres 
PHP 7.2+ with Composer
```

### Setup
```bash
git clone https://github.com/HuuDung/Lap-trinh-cau-truc.git
cd Lap-trinh-cau-truc
Change config in .evn.example and save to .env file:
    databasename:...
    username:....
    password:...
    add these line to end of .env file 
        PUSHER_APP_ID=
        PUSHER_APP_KEY=
        PUSHER_APP_SECRET=
        PUSHER_APP_CLUSTER=mt1
        
        MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
        MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
        
        AWS_ACCESS_KEY_ID=AKIAITDKJAE4QPDSDIXA
        AWS_SECRET_ACCESS_KEY=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
        AWS_DEFAULT_REGION=us-east-1
        AWS_BUCKET=shopkingman
        AWS_URL=https://s3.amazonaws.com/shopkingman/
        FILESYSTEM_DRIVER=s3

composer install
php artisan migrate db:seed
php artisan serve
```


