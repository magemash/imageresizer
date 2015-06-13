<?php

class MageMash_ImageResizer_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function resizeImage($image, $path, $height = 250)
    {
        $dir = Mage::getBaseDir('media').DS.$path;
        $url = Mage::getBaseUrl('media').$path;

        $imageUrl = $dir.DS.$image;
        $imageResized = $dir.DS.'resized'.DS.$image;

        if (!file_exists($dir.DS.'resized')) {
            mkdir($dir.DS.'resized', 0777, true);
        }

        if ( !file_exists($imageResized) && file_exists($imageUrl )) :
            $imageObj = new Varien_Image($imageUrl);
            $imageObj->constrainOnly(TRUE);
            $imageObj->keepAspectRatio(TRUE);
            $imageObj->keepFrame(FALSE);
            $imageObj->quality(100);
            $imageObj->resize($imageObj->getOriginalWidth(), $height);
            $imageObj->save($imageResized);
        endif;

        return $url.DS.'resized'.DS.$image;
    }
}
	 