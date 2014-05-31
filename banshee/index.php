<?php

// TODO - Move this shit to an autoloader.
require_once 'src/Banshee/Exceptions/BansheeRouteException.php';
require_once 'src/Banshee/Exceptions/BansheeQueueException.php';
require_once 'src/Banshee/Route.php';
require_once 'src/Banshee/Queue.php';
require_once 'src/Banshee/Message.php';
require_once 'src/Banshee/Worker.php';

$route = new \Banshee\Route;

$route->get('/create', function () {

    $data = array(
        'time' => time(),
        'key' => 1989,
        'request' => 'start'
    );

    echo "<br>----------------------------------------<br>";
    $count = \Banshee\Queue::messageCount();
    echo 'The queue has: ' . $count . 
        ' message' . ($count > 1 || $count <= 0 ? 's' : '');

    if (\Banshee\Queue::addMessage(1989, $data)) {
        echo "<br>Message has been added to the queue.";
    }
});

$route->get('/process', function () {
    $result = (new \Banshee\Worker())->processFirstMessage();
    var_dump($result);
});

$route->get('/process-all', function () {

    $results = (new \Banshee\Worker())->process();
    var_dump($results);
});

try {
    $route->run();
} catch (\Banshee\BansheeRouteException $e) {
    die($e->getMessage());
}
