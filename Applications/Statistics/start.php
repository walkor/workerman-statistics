<?php 
require_once __DIR__ .'/Config/Config.php';
require_once __DIR__.'/Protocols/Statistic.php';
require_once __DIR__.'/Bootstrap/StatisticProvider.php';
require_once __DIR__.'/Bootstrap/StatisticWorker.php';

use Bootstrap\StatisticProvider;
use Bootstrap\StatisticWorker;
use \Workerman\Worker;
use \Workerman\WebServer;

// StatisticProvider
$statistic_provider = new StatisticProvider("Text://0.0.0.0:55858");
$statistic_provider->name = 'StatisticProvider';


// StatisticWorker
$statistic_worker = new StatisticWorker("Statistic://0.0.0.0:55656");
$statistic_worker->transport = 'udp';
$statistic_worker->name = 'StatisticWorker';


// WebServer
$web = new WebServer("http://0.0.0.0:55757");
$web->name = 'StatisticWeb';
$web->addRoot('www.your_domain.com', __DIR__.'/Web');
