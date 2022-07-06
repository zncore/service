<?php

namespace ZnCore\Service\Interfaces;

use ZnCore\Domain\Interfaces\GetEntityClassInterface;
use ZnCore\Domain\Interfaces\ReadAllInterface;

interface CrudServiceInterface extends ServiceDataProviderInterface, ServiceInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface, ModifyInterface
{


}