<?php
// it produces messages ==> publish them on an exchange, the "mine.test" exchange
try{
	//establish the connection to an AMQP server
	$amqpConn = new AMQPConnection();
	$amqpConn->connect();

	if(!$amqpConn->isConnected()){
		die('Conexiune esuata!');
	}

	//creates the channel of comunication - mandatory !!!
	$channel = new AMQPChannel($amqpConn);
	if(!$channel->isConnected()){
		die('Connection through channel failed!');
	}

	//sets the exchange
	$exchangeName= 'mine.test';
	$exchange    = new AMQPExchange($channel);
	$exchange->setName($exchangeName);

	//sets the queue
	$queueName  = 'mine.test';
	$queue      = new AMQPQueue($channel);
	$queue->setName($queueName);
	$routingKey  = '';

	//publish the message
	$message = "Hello world!";
	if($exchange->publish($message, $routingKey)){
		echo 'Published!';
	}
}catch(AMQPException $e){
	echo 'AMQP Exception - '.$e->getMessage();
}catch(AMQPConnectionException $e){
	echo 'AMQP Connection Exception - '.$e->getMessage();
}catch(AMQPExchangeException $e){
	echo 'AMQP Exchange Exception - '.$e->getMessage();
}catch(AMQPQueueException  $e){
	echo 'AMQP Queue Exception - '.$e->getMessage();
}