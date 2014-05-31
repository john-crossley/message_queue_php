<?php

namespace Banshee;

class Queue {

    /**
     * Unique queue ID
     * @var {integer}
     */
    const QUEUE_KEY = 1988;

    const QUEUE_TYPE_START = 1;
    const QUEUE_TYPE_END = 2;

    /**
     * Stores the queue semaphore
     * @var {resource}
     */
    private static $queue = null;

    public static function getQueue()
    {
        if (!self::$queue)
            self::$queue = msg_get_queue(self::QUEUE_KEY, 0600);

        return self::$queue;
    }

    public static function messageCount()
    {
        $queue = self::getQueue();
        return (int)msg_stat_queue($queue)['msg_qnum'];
    }

    public static function addMessage($key, array $data = array())
    {
        $message = new Message($key, $data);

        if (msg_send(self::getQueue(), 1, $message, true, true)) {
            return msg_stat_queue(self::getQueue());
        }
        throw new BansheeQueueException("Unable to add message to the queue.");
    }

}
