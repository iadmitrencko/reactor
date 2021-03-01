<?php

include_once 'vendor/autoload.php';

$containerBuilder = new \Symfony\Component\DependencyInjection\ContainerBuilder();

$loader = new \Symfony\Component\DependencyInjection\Loader\PhpFileLoader(
    $containerBuilder,
    new \Symfony\Component\Config\FileLocator(__DIR__ . '/../config')
);
$loader->load('services.php');
$containerBuilder->compile();

/** @var \Project\Application $application */
$application = $containerBuilder->get(\Project\Application::class);
$application->process();
