Các bước để cài package rabbitmq:

###### Bước 1: 
Thêm vào file _composer.json_ của project

- Package name: `owner/rabbit`
- Repository
<pre>
    "repositories":[
        {
            "type": "vcs",
            "url": "https://gitlab.com/lamhuynhb779/owner-package.git"
        }
    ]
</pre>

###### Bước 2: 
Chạy lệnh `$ composer update`

###### Bước 3: 
Copy nội dung file _config/connection.php_ trong package vào thư mục project _config/queue.php_

Chỉnh lại field queue.job => \Owner\Rabbit\Jobs\ReceivedJob::class

###### Bước 4: 
Chỉnh QUEUE_CONNECTION = rabbitmq

###### Bước 5: 
Copy file _src/Commands/TestPushJobCommand.php_ vào folder _Commands_ của project

###### Bước 6: Thực hiện test:

- Chạy command để push job lên rabbitmq
- Chạy php artisan rabbitmq:consume để consume job

