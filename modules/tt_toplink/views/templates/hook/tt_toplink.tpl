{*
* 2007-2017 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2017 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- Block Top links module -->
<div id="tttop-link-block">
	<h3 class="title_block ">
		<i class="material-icons">&#xE5D2;</i>
	</h3>
		
	<ul id="tt_toplink" class="block_content">
		<li class="tttoplink tthome">
			<a title="home" href="{$urls.base_url}">{l s='Home'}</a>
		</li>
	{foreach from=$tt_toplink_links item=tt_toplink_link}
		{if isset($tt_toplink_link.$lang)} 
			<li class="tttoplink">
				<a href="{$tt_toplink_link.url}" title="{$tt_toplink_link.$lang}" {if $tt_toplink_link.newWindow} onclick="window.open(this.href);return false;"{/if}>{$tt_toplink_link.$lang}</a></li>
		{/if}
	{/foreach}
	</ul>
</div>
<!-- /Block Top links module -->
