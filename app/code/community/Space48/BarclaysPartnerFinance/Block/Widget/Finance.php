<?php

class Space48_BarclaysPartnerFinance_Block_Widget_Finance
    extends Mage_Core_Block_Template
        implements Mage_Widget_Block_Interface
{
    /**
     * default static block id
     */
    const DEFAULT_STATIC_BLOCK_ID = 'finance-widget';
    
    /**
     * can we show this widget.
     * 
     * generally we're looking to be on a product page
     *
     * @return bool
     */
    public function canShow()
    {
        if ( ! $this->hasProduct() ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * get product
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        return Mage::registry('current_product');
    }
    
    /**
     * have we got a product
     *
     * @return bool
     */
    public function hasProduct()
    {
        $product = $this->getProduct();
        
        if ( ! $product || ! $product->getId() ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * get static block html
     *
     * @return string
     */
    public function getStaticBlockHtml()
    {
        if ( ! $this->getData('static_block_html') ) {
            $html = $this->getLayout()->createBlock('cms/block')
                ->setBlockId($this->getBlockId())->toHtml();
            
            if ( $html ) {
                $this->setData('static_block_html', $html);
            }
        }
        
        return $this->getData('static_block_html');
    }
    
    /**
     * get block id
     *
     * @return string
     */
    public function getBlockId()
    {
        if ( $blockId = $this->getData('block_id') ) {
            return $blockId;
        }
        
        return Space48_BarclaysPartnerFinance_Block_Widget_Finance::DEFAULT_STATIC_BLOCK_ID;
    }
}
