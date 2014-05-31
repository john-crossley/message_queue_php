<?php

namespace Banshee;

class Worker {

    private $queue = null;

    private $message = null;

    public function __construct()
    {
        $this->queue = Queue::getQueue();
        return $this;
    }

    public function processFirstMessage()
    {
        $messageType = NULL;
        $messageMaxSize = 1024;

        $status = msg_stat_queue($this->queue);

        if (Queue::messageCount() > 0) {
            // Check to see if we have anything in the queue
            if (msg_receive($this->queue, Queue::QUEUE_TYPE_START, $messageType, $messageMaxSize, $this->message)) {

                return $this->complete($messageType, $this->message);
            }
        }

        throw new BansheeQueueException("No more messages to process in the queue: ");

    }

    public function process()
    {
        $messageType = null;
        $messageMaxSize = 1024;

        $messageCount = Queue::messageCount();

        for ($i = 1; $i <= $messageCount; $i++) {
            msg_receive($this->queue, 1, $messageType, $messageMaxSize, $this->message); // if
            $messages[] = $this->complete($messageType, $this->message);

            $messageType = null;
            $this->message;
        }

        return $messages;

    }

    private function complete($messageType, Message $message) 
    {
        return $message;
    }

}