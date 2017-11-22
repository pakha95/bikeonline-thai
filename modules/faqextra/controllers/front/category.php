<?php

 /**

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

 */


 class FaqExtraCategoryModuleFrontController extends ModuleFrontController { public $faq_category; public $ssl = false; public function init() { if ($id_faq_category = (int)Tools::getValue('id_faq_category')) $this->faq_category = new FAQCategory($id_faq_category, $this->context->language->id); parent::init(); } public function setMedia() { parent::setMedia(); $this->context->controller->addCSS($this->module->getFramePathUri().'css/bootstrap.css'); $this->context->controller->addJS($this->module->getFramePathUri().'js/vendor/bootstrap.min.js'); $this->context->controller->addCSS($this->module->getFramePathUri().'css/style.css'); } public function initContent() { parent::initContent(); $parent_cat = new FAQCategory(1, $this->context->language->id); $this->context->smarty->assign('id_current_lang', $this->context->language->id); $this->context->smarty->assign('home_title', $parent_cat->name); if ($this->faq_category->indexation == 0) $this->context->smarty->assign('nobots', true); $id_shop = null; if (Shop::isFeatureActive()) $id_shop = (int)$this->context->shop->id; $categories = FAQCategory::getCategories($this->context->language->id, false); $selected_category = 0; $query = ''; if (Tools::isSubmit('submitSearch')) { $selected_category = (int)Tools::getValue('id_faq_category'); $query = Tools::getValue('query'); $this->context->smarty->assign(array( 'search_result' => FAQ::getFAQPages($this->context->language->id, (int)($selected_category), true, $id_shop, null, $query), )); } $this->context->smarty->assign(array( 'faq_category' => $this->faq_category, 'sub_category' => $this->faq_category->getSubCategories($this->context->language->id), 'faq_pages' => FAQ::getFAQPages($this->context->language->id, (int)($this->faq_category->id), true, $id_shop), 'path' => $this->getPath($this->faq_category->id, $this->faq_category->name), 'html_categories' => FAQCategory::recurseFAQCategory($categories, $categories[0][1], 1, $selected_category, 1), 'query' => $query, )); if(Tools::version_compare(_PS_VERSION_, '1.7')){ $this->setTemplate('faq_front.tpl'); } else{ $this->setTemplate('module:faqextra/views/templates/front/ps17/faq_front.tpl'); } } private function getPath($id_category, $path = '', Context $context = null) { if (!$context) $context = Context::getContext(); $id_category = (int)$id_category; if ($id_category == 0) return '<span class="navigation_end">'.$path.'</span>'; $pipe = Configuration::get('PS_NAVIGATION_PIPE'); if (empty($pipe)) $pipe = '>'; $full_path = ''; $category = new FAQCategory($id_category, $context->language->id); if (!Validate::isLoadedObject($category)) die(Tools::displayError()); $category_link = $context->link->getFAQCategoryLink($category); if ($path != $category->name) $full_path .= '<a href="'.Tools::safeOutput($category_link).'">'.htmlentities($category->name, ENT_NOQUOTES, 'UTF-8').'</a><span class="navigation-pipe">'.$pipe.'</span>'.$path; else $full_path = htmlentities($path, ENT_NOQUOTES, 'UTF-8'); return $this->getPath($category->id_parent, $full_path); } } 