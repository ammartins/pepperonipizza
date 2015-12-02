<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

// Turn Debug ON
$app['debug'] = true;

$app = new Silex\Application();

// Setting Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../views',
));

// Setting config File
$app->register(new DerAlex\Silex\YamlConfigServiceProvider(__DIR__ . '/team.yml'));

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../log/development.log',
));

//Routing
$app->get('/blog', function() use ($app) {
  return $app['twig']->render('index.html.twig', array('users' => $app['config']['team'] ));
})
->bind('blog');


$app->run();
