<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;

if(!empty($arParams['IBLOCK_ID_TOV']) && !empty($arParams['IBLOCKS_ID_NEWS']) && !empty($arParams['CODE_NEWS']) && $this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	//SELECT
	$arSelect = array(
		"ID",
		"NAME",
		$arParams['CODE_NEWS']
	);
	//WHERE
	$arFilter = array(
		"IBLOCK_ID" => $arParams['IBLOCK_ID_TOV'],
		"ACTIVE_DATE" => "Y",
		"ACTIVE"=>"Y",
	);
	$itog_item	 = [];
	$rsIBlockElement = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);

	while ($sect = $rsIBlockElement->Fetch())
	{
		$itog_item	[] = $sect;

	}
		//SELECT
	$arSelectEl = array(
		"ID",
		"NAME",
		"IBLOCK_SECTION_ID",
		"PROPERTY_PRICE",
		"PROPERTY_ARTNUMBER",
		"PROPERTY_MATERIAL",
		);
	//WHERE
	$arFilterEl = array(
		"IBLOCK_ID" => $arParams['IBLOCK_ID_TOV'],
		"ACTIVE_DATE" => "Y",
		"ACTIVE"=>"Y",
		//"CHECK_PERMISSIONS"=>"Y",
	);
	$count=0;
	$arMinMax = [];
	$rsIBlockElement = CIBlockElement::GetList(array(), $arFilterEl, false, false, $arSelectEl);
		//print_r($item['ID']);
	while ($elem = $rsIBlockElement->Fetch()) {
		foreach ($itog_item	 as &$item) {
			if ($item['ID'] == $elem['IBLOCK_SECTION_ID']) {
				$item['ITEMS'][] = $elem;
				$arMinMax[] = $elem['PROPERTY_PRICE_VALUE'];
				$count++;
			}
		}
	}
	$arResult['MIN'] = min($arMinMax);
	$arResult['MAX'] = max($arMinMax);

	$arResult['COUNT'] = $count;
	$arSelectNews = array(
	"ID",
	"NAME",
	"ACTIVE_FROM"
	);
	//WHERE
	$arFilterNews = array(
		"IBLOCK_ID" => $arParams['IBLOCKS_ID_NEWS'],
		"ACTIVE_DATE" => "Y",
		"ACTIVE"=>"Y",
		//"CHECK_PERMISSIONS"=>"Y",
	);
	$news = CIBlockElement::GetList(array(), $arFilterNews, false, false, $arSelectNews);
	$num = 0;
	while ($new = $news->Fetch()) {
		$arResult['NEWS'][$num] = $new;
		foreach ($itog_item	 as &$item) {
			foreach ($item[$arParams['CODE_NEWS']] as $code) {
				if ($new['ID'] == $code) {
					$arResult['NEWS'][$num]['ITEMS'][] = $item;
			}
			}
		}
		$num++;
	}
	
}
	
	if(!empty($arResult['NEWS']))
	{
		$this->SetResultCacheKeys(array("COUNT"
		));
	
		$this->IncludeComponentTemplate();
			
		
	}
	else
	{
		$this->AbortResultCache();
	}
			global $APPLICATION;
	$APPLICATION->SetTitle("В каталоге товаров представлено
товаров: ". $arResult['COUNT']);
?>