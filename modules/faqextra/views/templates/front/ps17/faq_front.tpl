{*

 * Prestashop Modules & Themen End User License Agreement
 *
 * This End User License Agreement ("EULA") is a legal agreement between you and Presta-Apps ltd.
 * ( here in referred to as "we" or "us" ) with regard to Prestashop Modules & Themes
 * (herein referred to as "Software Product" or "Software").
 * By installing or using the Software Product you agree to be bound by the terms of this EULA.
 *
 * 1. Eligible Licensees. This Software is available for license solely to Software Owners,
 * with no right of duplication or further distribution, licensing, or sub-licensing.
 * A Software Owner is someone who legally obtained a copy of the Software Product via Prestashop Store.
 *
 * 2. License Grant. We grant you a personal/one commercial, non-transferable and non-exclusive right to use the copy
 * of the Software obtained via Prestashop Store. Modifying, translating, renting, copying, transferring or assigning
 * all or part of the Software, or any rights granted hereunder, to any other persons and removing any proprietary
 * notices, labels or marks from the Software is strictly prohibited. Furthermore, you hereby agree not to create
 * derivative works based on the Software. You may not transfer this Software.
 *
 * 3. Copyright. The Software is licensed, not sold. You acknowledge that no title to the intellectual property in the
 * Software is transferred to you. You further acknowledge that title and full ownership rights to the Software will
 * remain the exclusive property of Presta-Apps Mobile, and you will not acquire any rights to the Software,
 * except as expressly set forth above.
 *
 * 4. Reverse Engineering. You agree that you will not attempt, and if you are a corporation,
 * you will use your best efforts to prevent your employees and contractors from attempting to reverse compile, modify,
 * translate or disassemble the Software in whole or in part. Any failure to comply with the above or any other terms
 * and conditions contained herein will result in the automatic termination of this license.
 *
 * 5. Disclaimer of Warranty. The Software is provided "AS IS" without warranty of any kind. We disclaim and make no
 * express or implied warranties and specifically disclaim the warranties of merchantability, fitness for a particular
 * purpose and non-infringement of third-party rights. The entire risk as to the quality and performance of the Software
 * is with you. We do not warrant that the functions contained in the Software will meet your requirements or that the
 * operation of the Software will be error-free.
 *
 * 6. Limitation of Liability. Our entire liability and your exclusive remedy under this EULA shall not exceed the price
 * paid for the Software, if any. In no event shall we be liable to you for any consequential, special, incidental or
 * indirect damages of any kind arising out of the use or inability to use the software.
 *
 * 7. Rental. You may not loan, rent, or lease the Software.
 *
 * 8. Updates and Upgrades. All updates and upgrades of the Software from a previously released version are governed by
 * the terms and conditions of this EULA.
 *
 * 9. Support. Support for the Software Product is provided by Presta-Apps ltd. For product support, please send an
 * email to support at info@iniweb.de
 *
 * 10. No Liability for Consequential Damages. In no event shall we be liable for any damages whatsoever
 * (including, without limitation, incidental, direct, indirect special and consequential damages, damages for loss
 * of business profits, business interruption, loss of business information, or other pecuniary loss) arising out of
 * the use or inability to use the Software Product. Because some states/countries do not allow the exclusion or
 * limitation of liability for consequential or incidental damages, the above limitation may not apply to you.
 *
 * 11. Indemnification by You. You agree to indemnify, hold harmless and defend us from and against any claims or
 * lawsuits, including attorney's fees that arise or result from the use or distribution of the Software in violation
 * of this Agreement.
 *
 * @author    Presta-Apps Limited
 * @website   www.presta-apps.com
 * @contact   info@presta-apps.com
 * @copyright 2009-2016 Presta-Apps Ltd.
 * @license   Proprietary

*}

{if version_compare($smarty.const._PS_VERSION_,'1.6.0.0','<')}


    {include file="$tpl_dir./breadcrumb.tpl"}


{/if}





{extends file='layouts/layout-left-column.tpl'}





 {block name='content'}


<div class="inixframe">


{if isset($search_result) && empty($search_result)}


    <p class="note note-warning">


        {l s='No results were found for your search' mod='faqextra'}{if isset($query) && !empty($query)}&nbsp;"{$query}"{/if}


    </p>


{/if}


<form action="" method="post" class="form">


<div class="form-group col-lg-6" >


    <select  name="search_category" id="faq_control" class="form-control faq-control" onchange="location.href=$(this).val()">


        <option value="{$link->getFAQCategoryLink(1)}">{l s='All categories' mod='faqextra'}</option>


        {foreach from=$html_categories item=htmlcategories}


            {$htmlcategories nofilter}


        {/foreach}


    </select>


</div>


    <div class="input-group col-lg-6">





        <input id="query" class="form-control" type="text" value="{$query}" name="query" placeholder="{l s='Search ...' mod='faqextra'}">


        <span class="input-group-btn">


            <button id="submitSearch" class="btn btn-default" type="submit" name="submitSearch" style="height: 34px"><i class="icon-search" ></i> {l s='Search' mod='faqextra'}</button>


        </span>


    </div>


    </fieldset>


</form>


{if isset($search_result) && !empty($search_result)}


    <p class="title_block">{l s='Results for your search' mod='faqextra'}:{if isset($query) && !empty($query)}&nbsp;"{$query}"{/if}</p>


    <div class="panel-group" id="accordion">


        {foreach from=$search_result item=faqpages}


            <div class="panel panel-default">


                <div class="panel-heading">


                    <h4 class="panel-title">


                        <a data-toggle="collapse" data-parent="#accordion" href="#answer{$faqpages.id_faq}">


                            {$faqpages.question}


                        </a>


                    </h4>


                </div>


                <div  name="answer{$faqpages.id_faq}" id="answer{$faqpages.id_faq}" class="panel-collapse collapse">


                    <div class="panel-body">


                        {$faqpages.answer nofilter}


                    </div>


                </div>


            </div>


        {/foreach}


    </div>





{elseif !isset($search_result)}





    {if isset($faq_category)}


    


        <div class="block-faq">           


            <h1 {if version_compare($smarty.const._PS_VERSION_ , '1.7.0' , '>=')}style="margin:.67em 0 !important"{/if} >{$faq_category->name}</h1>


            {if isset($faq_category->description) && !empty($faq_category->description)}


            <p class="faq_description">{$faq_category->description}</p>


            {/if}


            {if isset($sub_category) && !empty($sub_category)}


                <div class="faq_sub">


                <p class="title_block">{l s='Subcategories' mod='faqextra'}</p>


                <ul class="list-group col-lg-12">


                    {foreach from=$sub_category item=subcategory}


                        <li >


                            <a href="{$link->getFAQCategoryLink($subcategory.id_faq_category, $subcategory.link_rewrite)}" class="list-group-item">{$subcategory.name}</a>


                        </li>


                    {/foreach}


                </ul>


                </div>


            {/if}


            {if isset($faq_pages) && !empty($faq_pages)}








                <div class="panel-group col-lg-12" id="accordion">


                    {foreach from=$faq_pages item=faqpages}


                        <div class="panel panel-default">


                            <div class="panel-heading">


                                <h4 class="panel-title" >


                                    <a data-toggle="collapse" data-parent="#accordion" href="#answer{$faqpages.id_faq}">


                                        {$faqpages.question}


                                    </a>


                                </h4>


                            </div>


                            <div id="answer{$faqpages.id_faq}" class="panel-collapse collapse">


                                <div class="panel-body">


                                    {$faqpages.answer nofilter}


                                </div>


                            </div>


                        </div>


                    {/foreach}


                </div>


            {/if}


        </div>


    {else}


        <div class="error">


            {l s='This page does not exist.' mod='faqextra'}


        </div>


    {/if}


    <br />


{/if}


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <script>


        $(window).load(function(){


        if( jQuery.uniform ){





            $.uniform.restore("#faq_control, .faq-control"); $('#faq_control, .faq-control').parent().addClass('uniform-reset');


        }





            $("#accordion").find(".panel-heading").css({ cursor: 'pointer' }).on('click',function(e){


                e.preventDefault();


                var target  = $(this).find('a').attr('href');


                $(target).collapse('toggle');


            });


        });








    </script>


</div>


    {/block}


