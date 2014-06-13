<?php
//consumes messages from a queue, the "mine.test" queue using a routing key
try{
  //establish the connection to an AMQP server
  $amqpConn = new AMQPConnection();
  $amqpConn->connect();

  if(!$amqpConn->isConnected()){
    die('Failed to connect!');
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
  $queueName= 'mine.test';
  $queue    = new AMQPQueue($channel);
  $queue->setName($queueName);

  $counter = 0;
  while($envelope = $queue->get()){
    //get message payload
    $message = $envelope->getBody();
    if($message){
      echo $message.'';
      //inform the queue that the message was acknowledged 
      $queue->ack($envelope->getDeliveryTag());
    }else{
      $queue->nack($envelope->getDeliveryTag(), AMQP_REQUEUE);
    }

    $counter++;
  }

  if($counter){
    echo 'Consuming...';
  }else{
    echo 'No messages to consume...';
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