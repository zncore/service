<?php

namespace ZnCore\Service\Base;

use ZnCore\Domain\Interfaces\GetEntityClassInterface;
use ZnCore\EntityManager\Traits\EntityManagerAwareTrait;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnCore\Repository\Traits\RepositoryAwareTrait;
use ZnCore\Service\Interfaces\CreateEntityInterface;

abstract class BaseService implements GetEntityClassInterface, CreateEntityInterface
{

    use EventDispatcherTrait;
    use EntityManagerAwareTrait;
    use RepositoryAwareTrait;

    public function getEntityClass(): string
    {
        return $this->getRepository()->getEntityClass();
    }

    public function createEntity(array $attributes = [])
    {
        $entityClass = $this->getEntityClass();
        return $this
            ->getEntityManager()
            ->createEntity($entityClass, $attributes);
    }
}