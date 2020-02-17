<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Exception;
use Orm\Zed\ProductSearch\Persistence\Map\SpyProductSearchTableMap;
use PDO;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepository as SprykerProductPageSearchRepository;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchPersistenceFactory getFactory()
 */
class ProductPageSearchRepository extends SprykerProductPageSearchRepository implements ProductPageSearchRepositoryInterface
{
    /**
     * @param  array|int[]  $productIds
     * @param  array|int[]  $localeIds
     * @return array
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function queryProductAbstractIdsByProductIds(
        array $productIds,
        array $localeIds
    ): array {
        //Dirty Workaround, I know
        $connection = $this->getFactory()->getPublicQueryContainer()->getConnection();
        try {
            $sql = sprintf('SELECT * FROM %s WHERE %s IN (%s) AND %s IN (%s)',
                SpyProductSearchTableMap::TABLE_NAME,
                SpyProductSearchTableMap::COL_FK_LOCALE,
                implode(',', $localeIds),
                SpyProductSearchTableMap::COL_FK_PRODUCT,
                implode(',', $productIds)
            );
            $stmt = $connection->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
