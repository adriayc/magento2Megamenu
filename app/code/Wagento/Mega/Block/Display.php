<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 2/19/18
 * Time: 2:49 PM
 */

namespace Wagento\Mega\Block;


class Display extends \Magento\Framework\View\Element\Template
{

    protected $_categoryCollectionFactory;
    protected $_categoryHelper;
    protected $_categoryFactory;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        array $data = []
    )
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $data);
    }


    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }
    public function _getParentName($path = ''){
        $parentName = '';
        $rootCats = array(1,2);
        $catTree = explode("/", $path);
        array_pop($catTree);
        if($catTree && (count($catTree) > count($rootCats))){
            foreach ($catTree as $catId){
                if(!in_array($catId, $rootCats)){
                    $category = $this->_categoryFactory->create()->load($catId);
                    $categoryName = $category->getName();
                    $parentName .= $categoryName . ' -> ';
                }
            }
        }
        return $parentName;
    }


}