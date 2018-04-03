<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?><?$APPLICATION->IncludeComponent(
	"exam:simplecomp",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID_TOV" => "2",
		"IBLOCKS_ID_NEWS" => "1",
		"CODE_NEWS" => "UF_NEWS_LINK",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "180"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>