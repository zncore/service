<?php

namespace ZnCore\Service\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Contract\Common\Exceptions\ReadOnlyException;
use ZnCore\Domain\Enums\EventEnum;
use ZnCore\Domain\Events\EntityEvent;
use ZnCore\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\EntityManager\Traits\EntityManagerAwareTrait;

class ReadOnlyServiceSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onBefore',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBefore',
            EventEnum::BEFORE_DELETE_ENTITY => 'onBefore',
        ];
    }

    public function onBefore(EntityEvent $event)
    {
        throw new ReadOnlyException('Service readonly');
    }
}
