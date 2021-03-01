<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $configurator) {
    $configurator->parameters()->set('domain', '#VALUE#');
    $configurator->parameters()->set('db_name', '#VALUE#');
    $configurator->parameters()->set('db_host', 'localhost');
    $configurator->parameters()->set('db_port', 27017);
    $configurator->parameters()->set('db_username', null);
    $configurator->parameters()->set('db_password', null);

    // -----------------------

    $services = $configurator->services()
                             ->defaults()
                             ->autowire()
                             ->autoconfigure()
                             ->public();

    $services->load('Project\\', '../src/*');
    $services->load('Core\\', '../core/*');

    $services->set(\Core\Http\Request::class)->factory(
        [
            ref(\Core\Http\Request\Factory::class),
            'create',
        ]
    );

    $services->set(\Core\View::class)->args(
        [
            '$viewBasePath' => dirname(__DIR__, 1) . '/view/',
            '$layout'       => 'layout.php',
        ]
    );

    $services->set(\Doctrine\ODM\MongoDB\Configuration::class)
             ->args(
                 [
                     '$databaseName'        => '%db_name%',
                     '$proxyStoragePath'    => dirname(__DIR__, 1) . '/tmp/proxies',
                     '$proxyNamespace'      => 'Proxy',
                     '$hydratorStoragePath' => dirname(__DIR__, 1) . '/tmp/hydrators',
                     '$hydratorNamespace'   => 'Hydrator',
                 ]
             )
             ->factory(
                 [
                     ref(\Core\Database\Mongo\Configuration\Factory::class),
                     'create',
                 ]
             );

    $services->set(\MongoDB\Client::class)
             ->args(
                 [
                     '$host'         => '%db_host%',
                     '$port'         => '%db_port%',
                     '$databaseName' => '%db_name%',
                     '$username'     => '%db_username%',
                     '$password'     => '%db_password%',
                 ]
             )
             ->factory(
                 [
                     ref(\Core\Database\Mongo\Client\Factory::class),
                     'create',
                 ]
             );

    $services->set(\Project\Link\Entity::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Project\Http\Request\CreateLinkValidator\Result::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Project\Link\Entity\Factory::class)->arg('$domain', '%domain%');
};
