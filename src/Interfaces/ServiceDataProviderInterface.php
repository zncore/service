<?php

namespace ZnCore\Service\Interfaces;

use ZnCore\DataProvider\Libs\DataProvider;
use ZnCore\Query\Entities\Query;

interface ServiceDataProviderInterface
{

    /**
     * Получить провайдер данных
     * @param Query|null $query Объект запроса
     * @return DataProvider
     */
    public function getDataProvider(Query $query = null): DataProvider;

}