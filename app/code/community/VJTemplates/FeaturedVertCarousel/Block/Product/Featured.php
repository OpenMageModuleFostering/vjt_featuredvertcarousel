<?php
/*
#------------------------------------------------------------------------
  Magento Extension - Featured Product Carousel
#------------------------------------------------------------------------
# @license - OSL V3.0
# Author: VJ Templates
# Websites: http://www.vjtemplates.com
#------------------------------------------------------------------------
*/
class VJTemplates_FeaturedVertCarousel_Block_Product_Featured extends Mage_Catalog_Block_Product_List {

    public function getFeaturedProduct(){
            
        $product = Mage::getModel('catalog/product');
		$storeId = Mage::app()->getStore()->getId();
        $collection = $product->getCollection()
				->addStoreFilter($storeId)
				->addMinimalPrice()
				->addFinalPrice()
				->addTaxPercents()
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('price')
                ->addAttributeToSelect('small_image')
				->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
                ->addAttributeToFilter('featured',array('yes'=>true))
				->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
				->addAttributeToFilter('visibility', array('in' => array(Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG, Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)));

    
		$current_categoryId = Mage::getModel('catalog/layer')->getCurrentCategory()->getId(); 
    	$current_category = Mage::getModel('catalog/category')->load($current_categoryId);
		$current_category->setIsAnchor(1);
		$collection->addCategoryFilter($current_category);
            
        if($this->getCategoryId()) {
		$CategoryIds = explode(',',$this->getCategoryId());
			foreach($CategoryIds as $CategoryId) {
				$category = Mage::getModel('catalog/category')->load($CategoryId);
				$category->setIsAnchor(1);
				$collection->addCategoryFilter($category);
			}
		}

        if($this->getOrderby()) $collection->getSelect()->order($this->getOrderby());
        if($this->getNumProducts()) $collection->getSelect()->limit($this->getNumProducts());
        
        return $collection;
    
    }
}
?> 