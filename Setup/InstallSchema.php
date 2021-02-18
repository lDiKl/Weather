<?php

namespace Kostynenko\Weather\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'dk_weather'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('dk_weather'))
            ->addColumn(
                'weather_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Weather ID'
            )
            ->addColumn(
                'main',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => ''],
                'Weather main status'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => ''],
                'Weather description'
            )
            ->addColumn(
                'icon',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                10,
                ['nullable' => false, 'default' => ''],
                'Weather icon'
            )
            ->addColumn(
                'temp',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                10,
                ['nullable' => false, 'default' => ''],
                'Weather temp'
            )
            ->addColumn(
                'city',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => ''],
                'Weather city'
            )
            ->setComment("Kostynenko Weather table");
        $setup->getConnection()->createTable($table);
    }
}
