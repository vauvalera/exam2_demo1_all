    <?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if ($arParams["CONT"] == 'Y') {
    global $APPLICATION;
    $APPLICATION->SetPageProperty('content', $arResult['CONT']);
}