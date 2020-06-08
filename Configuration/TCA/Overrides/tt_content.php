<?php

$cols = [
    'tx_intpark_park'=> [
        'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_int_park_map.park',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_intpark_domain_model_park',
            'foreign_table_where' => 'AND {#tx_intpark_domain_model_park}.{#deleted} = 0 AND {#tx_intpark_domain_model_park}.{#hidden} = 0'
        ],
    ],
    'tx_intpark_zoom'=> [
        'label' => 'LLL:EXT:int_park/Resources/Private/Language/locallang_db.xlf:tx_int_park_map.zoom',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['1', 1],
                ['2', 2],
                ['3', 3],
                ['4', 4],
            ],
            'Default' => 3
        ],
    ]
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $cols);

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['intpark_map'] = array(
    'showitem' => '
          --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
          --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;header,
          tx_intpark_park,
          tx_intpark_zoom,
       --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
          --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
       --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
          --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
          --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
       --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
 ');