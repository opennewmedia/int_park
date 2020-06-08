<?php
namespace ONM\IntPark\Utility;

class TcaProcFunc
{   
    /**
     * @param array $config
     * @return array
     */
    public function getMarkers($config)
    {
        $itemList = [];
        $images = glob(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3conf/ext/int_park/Resources/Public/markers/*.png'));
        foreach($images as $image)
        {
            $fileName = basename($image);
            $itemList[] = [$fileName, $fileName, 'EXT:int_park/Resources/Public/markers/' . $fileName];
        }
        $config['items'] = $itemList;
        return $config;
    }
}