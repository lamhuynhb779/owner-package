Các bước để cài package rabbitmq:

###### Bước 1: 
Thêm vào file _composer.json_ của project

- Package name: `hayashi/rabbitmq`
- Repository `https://gitlab.com/lamhuynhb779/rabbitmq-basecode-package.git`

###### Bước 2: 
Chạy lệnh `$ composer update`

###### Bước 3: 
Copy nội dung file _config/connection.php_ trong package vào thư mục project _config/queue.php_

Chỉnh lại field queue.job => \Hayashi\Rabbitmq\Jobs\ReceivedJob::class

###### Bước 4: 
Chỉnh QUEUE_CONNECTION = rabbitmq

###### Bước 5: 
Copy file _src/Commands/TestPushJobCommand.php_ vào folder _Commands_ của project

###### Bước 6: Thực hiện test:

- Chạy command để push job lên rabbitmq
- Chạy php artisan rabbitmq:consume để consume job

