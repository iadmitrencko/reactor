<?php

declare(strict_types=1);

namespace Project\Link;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDBMappingAnnotations;

/**
 * @MongoDBMappingAnnotations\Document(collection="short_link")
 * @MongoDBMappingAnnotations\HasLifecycleCallbacks
 * @MongoDBMappingAnnotations\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Entity
{
    /**
     * @var string
     * @MongoDBMappingAnnotations\Id(type="string", name="_id", strategy="auto")
     */
    private $id;

    /**
     * @var string
     * @MongoDBMappingAnnotations\Field(type="string", name="target_link")
     */
    private $targetLink;

    /**
     * @var string
     * @MongoDBMappingAnnotations\Field(type="string", name="short_link")
     */
    private $shortLink;

    /**
     * @var string
     * @MongoDBMappingAnnotations\Field(type="string", name="hash")
     * @MongoDBMappingAnnotations\UniqueIndex
     */
    private $hash;

    /**
     * @var \DateTime
     * @MongoDBMappingAnnotations\Field(type="date", name="expiration_date")
     */
    private $expirationDate;

    /**
     * @var int
     * @MongoDBMappingAnnotations\Field(type="int", name="redirects_count")
     */
    private $redirectsCount;

    /**
     * @var \DateTime
     * @MongoDBMappingAnnotations\Field(type="date", name="update_date")
     */
    private $updateDate;

    /**
     * @var \DateTime
     * @MongoDBMappingAnnotations\Field(type="date", name="create_date")
     */
    private $createDate;

    // ########################################

    /**
     * @MongoDBMappingAnnotations\PrePersist
     */
    public function prePersist(): void
    {
        $this->updateDate = new \DateTime();
        $this->createDate = clone $this->updateDate;
    }

    /**
     * @MongoDBMappingAnnotations\PreUpdate
     */
    public function preUpdate(): void
    {
        $this->updateDate = new \DateTime();
    }

    // ########################################

    public function __construct(
        string $targetLink,
        string $shortLink,
        string $hash,
        \DateTime $expirationDate,
        int $redirectsCount
    ) {
        $this->targetLink     = $targetLink;
        $this->shortLink      = $shortLink;
        $this->hash           = $hash;
        $this->expirationDate = $expirationDate;
        $this->redirectsCount = $redirectsCount;
    }

    // ########################################

    public function getId(): string
    {
        return $this->id;
    }

    // ########################################

    public function getTargetLink(): string
    {
        return $this->targetLink;
    }

    // ########################################

    public function getShortLink(): string
    {
        return $this->shortLink;
    }

    // ########################################

    public function getHash(): string
    {
        return $this->hash;
    }

    // ########################################

    public function isExpired(): bool
    {
        return $this->expirationDate->getTimestamp() < (new \DateTime())->getTimestamp();
    }

    public function getExpirationDate(): \DateTime
    {
        return $this->expirationDate;
    }

    // ########################################

    public function increaseRedirectsCount(): void
    {
        $this->setRedirectsCount(
            $this->getRedirectsCount() + 1
        );
    }

    public function setRedirectsCount(int $redirectsCount): void
    {
        $this->redirectsCount = $redirectsCount;
    }

    public function getRedirectsCount(): int
    {
        return $this->redirectsCount;
    }

    // ########################################

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    // ########################################
}
