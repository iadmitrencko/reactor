<?php

declare(strict_types=1);

namespace Project\Link;

class Storage
{
    /** @var \Core\Database\Mongo\Manager */
    private $mongoManager;

    // ########################################

    public function __construct(\Core\Database\Mongo\Manager $mongoManager)
    {
        $this->mongoManager = $mongoManager;
    }

    // ########################################

    public function set(\Project\Link\Entity $entity): void
    {
        $this->mongoManager->persist($entity);
        $this->mongoManager->flush();
    }

    public function findByHash(string $hash): ?\Project\Link\Entity
    {
        return $this->mongoManager->getRepository(\Project\Link\Entity::class)->findOneBy(['hash' => $hash]);
    }

    /**
     * @return \Project\Link\Entity[]
     */
    public function getAll(): array
    {
        return $this->mongoManager->getRepository(\Project\Link\Entity::class)->findAll();
    }

    // ########################################
}
