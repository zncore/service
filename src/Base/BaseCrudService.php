<?php

namespace ZnCore\Service\Base;

use ZnCore\Domain\Enums\EventEnum;
use ZnCore\Domain\Events\QueryEvent;
use ZnCore\Domain\Traits\DispatchEventTrait;
use ZnCore\Domain\Traits\ForgeQueryTrait;
use ZnCore\Entity\Exceptions\NotFoundException;
use ZnCore\Entity\Interfaces\EntityIdInterface;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnCore\Query\Entities\Query;
use ZnCore\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use ZnCore\Repository\Interfaces\CrudRepositoryInterface;
use ZnCore\Service\Interfaces\CrudServiceInterface;
use ZnCore\Service\Traits\CrudServiceCreateTrait;
use ZnCore\Service\Traits\CrudServiceDeleteTrait;
use ZnCore\Service\Traits\CrudServiceFindAllTrait;
use ZnCore\Service\Traits\CrudServiceFindOneTrait;
use ZnCore\Service\Traits\CrudServiceUpdateTrait;
use ZnCore\Validation\Helpers\ValidationHelper;

/**
 * @method CrudRepositoryInterface getRepository()
 */
abstract class BaseCrudService extends BaseService implements CrudServiceInterface, ForgeQueryByFilterInterface
{

    use DispatchEventTrait;
    use ForgeQueryTrait;

    use CrudServiceCreateTrait;
    use CrudServiceDeleteTrait;
    use CrudServiceFindAllTrait;
    use CrudServiceFindOneTrait;
    use CrudServiceUpdateTrait;

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        $repository = $this->getRepository();
        ClassHelper::checkInstanceOf($repository, ForgeQueryByFilterInterface::class);
        $event = new QueryEvent($query);
        $event->setFilterModel($filterModel);
        $this->getEventDispatcher()->dispatch($event, EventEnum::BEFORE_FORGE_QUERY_BY_FILTER);
        $repository->forgeQueryByFilter($filterModel, $query);
    }

    /**
     * @param $id
     * @param Query|null $query
     * @return object|EntityIdInterface
     * @throws NotFoundException
     */
    public function persist(object $entity)
    {
        ValidationHelper::validateEntity($entity);
        $this->getEntityManager()->persist($entity);
    }
}
