<?php

namespace Wagento\Mega\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory /* For Attribute create  */;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        /* assign object to class global variable for use in other class methods */
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,'yourcustomattribute_id');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'columns_id',/* Custom Attribute Code */
            [
                'group' => 'Number of Columns',/* Group name in which you want
                                              to display your custom attribute */
                'type' => 'int',/* Data type in which formate your value save in database*/
                'backend' => '',
                'frontend' => '',
                'label' => 'Columns', /* lablel of your attribute*/
                'input' => 'select',
                'class' => '',
                'source' => 'Wagento\Mega\Model\Config\Source\Options',
                /* Source of your select type custom attribute options*/
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                /*Scope of your attribute */
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );


        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'image_yes',/* Custom Attribute Code */
            [
                'group' => 'Number of Columns',/* Group name in which you want
                                              to display your custom attribute */
                'type' => 'int',/* Data type in which formate your value save in database*/
                'backend' => '',
                'frontend' => '',
                'label' => 'Yes/No', /* lablel of your attribute*/
                'input' => 'select',
                'class' => '',
                'source' => 'Wagento\Mega\Model\Config\Source\YesNoOptions',
                /* Source of your select type custom attribute options*/
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                /*Scope of your attribute */
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );
    }
}