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


 require _PS_MODULE_DIR_.'inixframe/InixAdminController.php'; class AdminFaqContentController extends Inix2AdminController { protected static $category = null; public $id_faq_category; protected $position_identifier = 'id_faq_to_move'; public function __construct($module) { $this->controller_type = 'moduleadmin'; $this->module = $module; $this->table = 'faq'; $this->className = 'FAQ'; $this->identifier = 'id_faq'; $this->_defaultOrderBy = 'position'; $this->_defaultOrderWay = 'asc'; $this->lang = true; parent::__construct(); $this->addRowAction('edit'); $this->addRowAction('delete'); $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?'))); $this->fields_list = array( 'id_faq' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25), 'question' => array('title' => $this->l('Title'), 'filter_key' => 'b!question'), 'position' => array('title' => $this->l('Position'), 'width' => 40,'filter_key' => 'position', 'align' => 'center', 'position' => 'position'), 'active' => array('title' => $this->l('Displayed'), 'width' => 25, 'align' => 'center', 'active' => 'status', 'type' => 'bool', 'orderby' => false) ); if ((int)Tools::getValue('id_faq_category')) $this->fields_list['position'] = array( 'title' => $this->l('Position'), 'width' => 70, 'filter_key' => 'position', 'align' => 'center', 'position' => 'position', ); if ($id_category = Tools::getvalue('id_faq_category')) $this->_category = new FAQCategory((int)$id_category); else $this->_category = new FAQCategory(1); $join_category = false; if (Validate::isLoadedObject($this->_category) && empty($this->_filter)) $join_category = true; $this->_select .= 'cl.name `name_category` ,  a.`active`'; $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl ON (a.`id_faq_category` = cl.`id_faq_category` AND b.`id_lang` = cl.`id_lang`) '; if($join_category) $this->_where .= ' AND a.id_faq_category = '.(int) $this->_category->id; $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?'))); } public function renderForm() { if (!$this->loadObject(true)) return; if (Validate::isLoadedObject($this->object)) $this->display = 'edit'; else $this->display = 'add'; $this->breadcrumbs[0] = 'FAQ Pages'; $this->initToolbar(); $this->show_cancel_button = true; $this->fields_form = array( 'tinymce' => true, 'legend' => array( 'title' => $this->l('FAQ Page'), ), 'input' => array( array( 'type' => 'faq_categories', 'label' => $this->l('FAQ Category'), 'name' => 'id_faq_category', 'html' => $this->module->renderCategoryTree(array( 'name' => 'id_faq_category', 'tree' => array( 'id' => 'categories-tree', 'selected_categories' =>array( Tools::getValue('id_faq_category',$this->object->id)), 'disabled_categories' => array(), 'use_search' => true, 'use_checkbox' => false, 'root_category' => 1, ), )), ), array( 'type' => 'text', 'label' => $this->l('Question:'), 'name' => 'question', 'lang' => true, 'required' => true, 'hint' => $this->l('Invalid characters:').' <>;=#{}', 'size' => 50 ), array( 'type' => 'textarea', 'label' => $this->l('Answer:'), 'name' => 'answer', 'autoload_rte' => true, 'required' => true, 'lang' => true, 'rows' => 5, 'cols' => 40, 'hint' => $this->l('Invalid characters:').' <>;=#{}' ), array( 'type' => 'switch', 'label' => $this->l('Displayed:'), 'name' => 'active', 'required' => false, 'class' => 't', 'is_bool' => true, 'values' => array( array( 'id' => 'active_on', 'value' => 1, 'label' => $this->l('Enabled') ), array( 'id' => 'active_off', 'value' => 0, 'label' => $this->l('Disabled') ) ), ), ), 'submit' => array( 'title' => $this->l('Save'), ) ); if (Shop::isFeatureActive()) { $this->fields_form['input'][] = array( 'type' => 'shop', 'label' => $this->l('Shop association:'), 'name' => 'checkBoxShopAsso', ); } $this->tpl_form_vars = array( 'active' => $this->object->active, 'PS_ALLOW_ACCENTED_CHARS_URL', (int)Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL') ); return parent::renderForm(); } protected function afterAdd($object) { $this->redirect_after = self::$currentIndex.'&token='.$this->token.'&conf=3&id_faq_category='. $object->id_faq_category; return parent::afterAdd($object); } protected function afterUpdate($object) { $this->redirect_after = self::$currentIndex.'&token='.$this->token.'&conf=4&id_faq_category='. $object->id_faq_category; return parent::afterUpdate($object); } public function renderList() { $this->toolbar_btn['new'] = array( 'href' => self::$currentIndex.'&amp;add'.$this->table.'&amp;id_faq_category='.(int)$this->_category->id.'&amp;token='.$this->token, 'desc' => $this->l('Add new') ); $this->tpl_list_vars['categories'] =$this->module->renderCategoryTree(array( 'name' => 'id_faq_category', 'tree' => array( 'id' => 'categories-tree', 'selected_categories' =>array( Tools::getValue('id_faq_category',1)), 'disabled_categories' => array(), 'use_search' => true, 'use_checkbox' => false, 'root_category' => 1, ), )); return parent::renderList(); } public function processDelete() { parent::processDelete(); $this->redirect_after = self::$currentIndex.'&token='.$this->token.'&conf=1&id_faq_category='. Tools::getValue('id_faq_category'); } protected function processBulkDelete() { parent::processBulkDelete(); $this->redirect_after = self::$currentIndex.'&token='.$this->token.'&conf=2&id_faq_category='. Tools::getValue('id_faq_category'); } public function processStatus() { parent::processStatus(); $this->redirect_after = self::$currentIndex.'&conf=5&id_faq_category='. (int)Tools::getValue('id_faq_category').'&token='.$this->token; } public function initContent() { if ($id_category = (int)Tools::getValue('id_faq_category')) self::$currentIndex .= '&id_faq_category='.(int)$id_category; else self::$currentIndex .= '&id_faq_category=1'; parent::initContent(); } public function ajaxProcessUpdatePositions() { $id_faq_to_move = (int)(Tools::getValue('id')); $way = (int)(Tools::getValue('way')); $positions = Tools::getValue('faq'); if (is_array($positions)) foreach ($positions as $key => $value) { $pos = explode('_', $value); if (isset($pos[2]) && $pos[2] == $id_faq_to_move) { $position = $key; break; } } $picture = new FAQ($id_faq_to_move); if (Validate::isLoadedObject($picture)) { if (isset($position) && $picture->updatePosition($way, $position)) { die(true); } else die('{"hasError" : true, "errors" : "Can not update Faq position"}'); } else die('{"hasError" : true, "errors" : "This faq can not be loaded"}'); } public static function getCurrentFAQCategory() { if(Tools::isSubmit('id_faq_category')){ self::$category = new FAQCategory((int)Tools::getValue('id_faq_category')); } else { self::$category = new FAQCategory(1); } return self::$category; } } 