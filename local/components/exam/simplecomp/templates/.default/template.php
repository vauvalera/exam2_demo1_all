<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<?	//echo '<pre>'; print_r($arResult); echo '</pre>';
?>
<div class="catalog">
<?$this->SetViewTarget('comp_min_max');?>
<div style="color:red; margin: 34px 15px 35px 15px"><?=$arResult['MIN']." - ".$arResult['MAX']?></div>
<?$this->EndViewTarget();?> 
	---<br>
	<p><b>Каталог</b></p>
	<ul>
	<?foreach($arResult['NEWS'] as $news):?>
	<?$str = []?>
		<?foreach($news['ITEMS'] as $item):?>
			<?$str[] = $item['NAME']?>
		<?endforeach?>
		<li><b>
			<?=$news['NAME']?></b><?=" - ".$news['ACTIVE_FROM']." 	(".implode(", ", $str).")"?>
			<?foreach($news['ITEMS'] as $item):?>
			<ul>
				<?foreach($item['ITEMS'] as $it):?>
				<li>
					<?=$it['NAME']." - ".$it['PROPERTY_PRICE_VALUE']." - ".$it['PROPERTY_MATERIAL_VALUE']." - ".$it['PROPERTY_ARTNUMBER_VALUE'];?>
				</li>
				<?endforeach?>
			</ul>
			<?endforeach?>
		</li>
	<?endforeach;?>
	</ul>	

</div>
