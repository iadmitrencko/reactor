<?php

declare(strict_types=1);

namespace Core\Database\Mongo\Configuration;

class Factory
{
    // ########################################

    public function create(
        string $databaseName,
        string $proxyStoragePath,
        string $proxyNamespace,
        string $hydratorStoragePath,
        string $hydratorNamespace
    ): \Doctrine\ODM\MongoDB\Configuration {
        $configuration = new \Doctrine\ODM\MongoDB\Configuration();

        $configuration->setDefaultDB($databaseName);

        $configuration->setProxyDir($proxyStoragePath);
        $configuration->setProxyNamespace($proxyNamespace);

        $configuration->setHydratorDir($hydratorStoragePath);
        $configuration->setHydratorNamespace($hydratorNamespace);

        $configuration->setMetadataDriverImpl(
            new \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver(
                new \Doctrine\Common\Annotations\AnnotationReader()
            )
        );

        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

        return $configuration;
    }

    // ########################################
}
