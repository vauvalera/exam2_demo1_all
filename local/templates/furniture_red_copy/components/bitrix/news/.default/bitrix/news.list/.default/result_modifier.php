<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
 if ($arParams["CONT"]) {
        $arResult['CONT'] = $arResult['ITEMS'][0]['ACTIVE_FROM'];
        $cp = $this->__component;
        $cp->SetResultCacheKeys(array("CONT"));
 }
