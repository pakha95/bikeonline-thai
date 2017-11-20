{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

<div class="block-contact contact-rich col-md-3 links">
<h4 class="hidden-sm-down">{l s='Store information' d='Shop.Theme.Global'}</h4>
	<div  class="title clearfix hidden-md-up" data-toggle="collapse" data-target="#contact-footer">
  	<span class="h3 block-contact-title">{l s='Store information' d='Shop.Theme.Global'}</span>
	 <span class="float-xs-right">
          <span class="navbar-toggler collapse-icons">
            <i class="material-icons add">&#xE313;</i>
            <i class="material-icons remove">&#xE316;</i>
          </span>
	</span>
  </div>
    <ul id="contact-footer" class="collapse">
	  <div class="block">
		<div class="icon"><i class="material-icons">&#xE55F;</i></div>
		  <div class="data">{$contact_infos.address.formatted nofilter}</div>
		  </div>
	  <div class="block">
<div class="data">
      {if $contact_infos.phone}
	  	        <div class="icon"><i class="material-icons">&#xE0CD;</i></div>
        {* [1][/1] is for a HTML tag. *}
        <span class="title">{l s='Call us:</span> [1]%phone%[/1]'
          sprintf=[
          '[1]' => '<span>',
          '[/1]' => '</span>',
          '%phone%' => $contact_infos.phone
          ]
          d='Shop.Theme.Global'
        }
      {/if}
	  </div>
	  </div>
	  	  <div class="block">
				<div class="data">
      {if $contact_infos.fax}
		<div class="icon"><i class="material-icons">&#xE0DF;</i></div>
        {* [1][/1] is for a HTML tag. *}
        <span class="title">{l
          s='Fax:</span> [1]%fax%[/1]'
          sprintf=[
            '[1]' => '<span>',
            '[/1]' => '</span>',
            '%fax%' => $contact_infos.fax
          ]
          d='Shop.Theme.Global'
        }
      {/if}
	  </div>
	  </div>
	  <div class="block">
			  				<div class="data">
      {if $contact_infos.email}
	  		        <div class="icon"><i class="material-icons">&#xE158;</i></div>
        {* [1][/1] is for a HTML tag. *}
       <span class="title">{l
          s='Email us:</span> [1]%email%[/1]'
          sprintf=[
            '[1]' => '<span>',
            '[/1]' => '</span>',
            '%email%' => $contact_infos.email
          ]
          d='Shop.Theme.Global'
        }
      {/if}
	  </div>
	  </div>
	  </ul>
<!--  <div class="hidden-md-up">
    <div class="title">
      <a class="h3" href="{$urls.pages.stores}">{l s='Store information' d='Shop.Theme.Global'}</a>
    </div>
  </div>
-->  
</div>
