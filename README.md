Publish and consume message using RabbitMQ and PHP AMQP library
===================================================================

Steps you have to take to use the PHP AMQP extension to publish messages and to consume messages.

1) Installing
----------------------------------
You have to install RabbitMQ [Installation][1] and the PHP AMQP library [Installation][2].

[1]:  https://www.rabbitmq.com/download.html
[2]:  http://pecl.php.net/package/amqp

2) Using the demo files (assume we saved the files into a folder named `workers`)
Browser: 

	http://localhost/workers/publisher.php

	http://localhost/workers/consumer.php

CLI:

	/var/www/workers/>>>php publisher.php

	/var/www/workers/>>>php consumer.php