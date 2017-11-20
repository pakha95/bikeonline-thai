{*
 * PrestaShop module created by VEKIA, a guy from official PrestaShop community ;-)
 *
 * @author    VEKIA https://www.prestashop.com/forums/user/132608-vekia/
 * @copyright 2010-2016 VEKIA
 * @license   This program is not free software and you can't resell and redistribute it
 *
 * CONTACT WITH DEVELOPER http://mypresta.eu
 * support@mypresta.eu
 *}

<li class="category_{$node.id}{if isset($last) && $last == 'true'} last{/if}">
	<a href="{$node.link|escape:'html':'UTF-8'}" {if isset($currentCategoryId) && $node.id == $currentCategoryId}class="selected"{/if}
		title="{$node.desc|strip_tags|trim|truncate:255:'...'|escape:'html':'UTF-8'}">{$node.name|escape:'html':'UTF-8'}{if $node.children|@count > 0}{assign var=_expand_id value=10|mt_rand:100000}
			<span class="hidden_mobile"style="position:absolute;right:0px;">
				<i class="material-icons more">&#xE315;</i>
			</span>
			<span class="float-xs-right hidden-md-up">
			<span data-target="#top_sub_menu_{$_expand_id}" data-toggle="collapse" class="navbar-toggler collapse-icons" style="position:absolute;right:0px;" aria-expanded="false">

				<i class="material-icons add">&#xE313;</i>
				<i class="material-icons remove">&#xE316;</i>
				<i class="material-icons add-down">&#xE409;</i>
			</span>
		</span>{/if}<!-- ({$node.nbproducts}) --></a>
	{if $node.children|@count}
	<!-- <div {if $count === 0} class="popover sub-menu js-sub-menu collapse"{else} class="collapse"{/if} id="top_sub_menu_{$_expand_id}"> -->
		<ul class="sub-menu js-sub-menu collapse" id="top_sub_menu_{$_expand_id}" aria-expanded="false">
		{foreach from=$node.children item=child name=categoryTreeBranch}
			{if $smarty.foreach.categoryTreeBranch.last}
				{include file="$branche_tpl_path" node=$child last='true'}
			{else}
				{include file="$branche_tpl_path" node=$child last='false'}
			{/if}
		{/foreach}
		</ul>
	<!-- </div> -->
	{/if}
</li>
