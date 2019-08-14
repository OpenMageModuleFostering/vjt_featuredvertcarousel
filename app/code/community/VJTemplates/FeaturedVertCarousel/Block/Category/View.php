<?php
class VJTemplates_FeaturedVertCarousel_Block_Category_View extends Mage_Catalog_Block_Category_View
{
	public function getFeaturedProductHtml()
	{
		return $this->getBlockHtml('product_featuredvert');
	}
}
?>