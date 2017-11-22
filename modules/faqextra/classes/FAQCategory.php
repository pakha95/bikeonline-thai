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


 class FAQCategory extends ObjectModel { public $id; public $id_faq_category; public $name; public $active; public $description; public $id_parent; public $position; public $level_depth; public $nleft; public $nright; public $link_rewrite; public $meta_title; public $meta_keywords; public $meta_description; public $date_add; public $date_upd; public $indexation; protected static $_links = array(); public static $definition = array( 'table' => 'faq_category', 'primary' => 'id_faq_category', 'multilang' => true, 'multishop'=> true, 'fields' => array( 'active' => array('type' => self::TYPE_BOOL), 'id_parent' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true), 'position' => array('type' => self::TYPE_INT), 'indexation' => array('type' => self::TYPE_BOOL), 'level_depth' => array('type' => self::TYPE_INT), 'nleft' => array('type'=>self::TYPE_INT,'validate'=>'isInt'), 'nright' => array('type'=>self::TYPE_INT,'validate'=>'isInt'), 'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'), 'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'), 'name' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64), 'link_rewrite' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isLinkRewrite', 'required' => true, 'size' => 64), 'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'), 'meta_title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 128), 'meta_description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255), 'meta_keywords' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255), ), ); public function __construct( $id = null, $id_lang = null, $id_shop = null ) { Shop::addTableAssociation('faq_category', array( 'type'=> 'shop' )); parent::__construct( $id, $id_lang, $id_shop ); } public function add($autodate = true, $nullValues = false) { $this->position = self::getLastPosition((int)$this->id_parent); if (!isset($this->level_depth)) $this->level_depth = $this->calcLevelDepth(); $add = parent::add($autodate, $nullValues); return $add; } public function toggleStatus(){ $ret = parent::toggleStatus(); $toToggle = array((int)($this->id)); $this->recursiveDelete($toToggle, (int)($this->id)); $toToggle = array_unique($toToggle); $list = implode(', ', $toToggle); if($this->active==1) DB::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'faq_category` set active = 1 where id_faq_category in ('.$list.')'); else DB::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'faq_category` set active = 0 where id_faq_category in ('.$list.')'); return $ret; } public function update($nullValues = false) { $this->level_depth = $this->calcLevelDepth(); $this->cleanPositions((int)$this->id_parent); if ($this->getDuplicatePosition()) $this->position = self::getLastPosition((int)$this->id_parent); $ret = parent::update($nullValues); self::regenerateEntireNtree(); $this->recalculateLevelDepth($this->id); $toToggle = array((int)($this->id)); $this->recursiveDelete($toToggle, (int)($this->id)); $toToggle = array_unique($toToggle); $list = implode(', ', $toToggle); if($this->active==1) DB::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'faq_category` set active = 1 where id_faq_category in ('.$list.')'); else DB::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'faq_category` set active = 0 where id_faq_category in ('.$list.')'); return $ret; } public static function getLastPosition($id_faq_category_parent) { return (Db::getInstance()->getValue('SELECT MAX(position)+1 FROM `'._DB_PREFIX_.'faq_category` WHERE `id_parent` = '.(int)($id_faq_category_parent))); } public function delete() { if ((int)($this->id) === 0 OR (int)($this->id) === 1) return false; $this->clearCache(); $toDelete = array((int)($this->id)); $this->recursiveDelete($toDelete, (int)($this->id)); $toDelete = array_unique($toDelete); $list = sizeof($toDelete) > 1 ? implode(',', array_map('intval',$toDelete)) : (int)($this->id); Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'faq_category` WHERE `id_faq_category` IN ('.$list.')'); Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'faq_category_lang` WHERE `id_faq_category` IN ('.$list.')'); self::cleanPositions($this->id_parent); $delete = parent::delete(); $faqs = DB::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'faq` WHERE id_faq_category IN ('.$list.')'); foreach($faqs as $faq){ $f = new Faq($faq['id_faq']); $f->delete(); } DB::getInstance()->delete('faq_category_cms','id_faq_category = '.$this->id); return $delete; } protected function recursiveDelete(&$toDelete, $id_faq_category) { if (!is_array($toDelete) OR !$id_faq_category) die(Tools::displayError()); $result = Db::getInstance()->ExecuteS('


		SELECT `id_faq_category`


		FROM `'._DB_PREFIX_.'faq_category`


		WHERE `id_parent` = '.(int)($id_faq_category)); foreach ($result AS $row) { $toDelete[] = (int)($row['id_faq_category']); $this->recursiveDelete($toDelete, (int)($row['id_faq_category'])); } } public static function hideFAQCategoryPosition($name) { return preg_replace('/^[0-9]+\./', '', $name); } public function recalculateLevelDepth($id_faq_category) { $categories = Db::getInstance()->ExecuteS('


			SELECT id_faq_category, id_parent, level_depth


			FROM '._DB_PREFIX_.'faq_category


			WHERE id_parent = '.(int)$id_faq_category); $level = Db::getInstance()->getRow('


			SELECT level_depth


			FROM '._DB_PREFIX_.'faq_category


			WHERE id_faq_category = '.(int)$id_faq_category); foreach ($categories as $sub_category) { Db::getInstance()->Execute('


				UPDATE '._DB_PREFIX_.'faq_category


				SET level_depth = '.(int)($level['level_depth'] + 1).'


				WHERE id_faq_category = '.(int)$sub_category['id_faq_category']); $this->recalculateLevelDepth($sub_category['id_faq_category']); } } public function getDuplicatePosition() { return Db::getInstance()->getRow('


		SELECT c.`id_faq_category` as id


		FROM `'._DB_PREFIX_.'faq_category` c


		WHERE c.`id_parent` = '.(int)($this->id_parent).'


		AND `position` = '.(int)($this->position).'


		AND c.`id_faq_category` != '.(int)($this->id)); } public static function cleanPositions($id_faq_category_parent) { $return = true; $result = Db::getInstance()->ExecuteS('


		SELECT `id_faq_category`


		FROM `'._DB_PREFIX_.'faq_category`


		WHERE `id_parent` = '.(int)($id_faq_category_parent).'


		ORDER BY `position`'); $sizeof = sizeof($result); for ($i = 0; $i < $sizeof; $i++){ $sql = '


				UPDATE `'._DB_PREFIX_.'faq_category`


				SET `position` = '.(int)($i).'


				WHERE `id_parent` = '.(int)($id_faq_category_parent).'


				AND `id_faq_category` = '.(int)($result[$i]['id_faq_category']); $return &= Db::getInstance()->Execute($sql); } return $return; } public function calcLevelDepth() { if (!$this->id_parent) return 0; $parentCategory = new FaqCategory((int)($this->id_parent)); if (!Validate::isLoadedObject($parentCategory)) die('parent category does not exist'); return $parentCategory->level_depth + 1; } public function updatePosition($way, $position) { if (!$res = Db::getInstance()->ExecuteS('


			SELECT cp.`id_faq_category`, cp.`position`, cp.`id_parent`


			FROM `'._DB_PREFIX_.'faq_category` cp


			WHERE cp.`id_parent` = '.(int)$this->id_parent.'


			ORDER BY cp.`position` ASC' )) return false; foreach ($res AS $category) if ((int)($category['id_faq_category']) == (int)($this->id)) $movedCategory = $category; if (!isset($movedCategory) || !isset($position)) return false; $query1 = '


			UPDATE `'._DB_PREFIX_.'faq_category`


			SET `position`= `position` '.($way ? '- 1' : '+ 1').'


			WHERE `position`


			'.($way ? '> '.(int)($movedCategory['position']).' AND `position` <= '.(int)($position) : '< '.(int)($movedCategory['position']).' AND `position` >= '.(int)($position)).'


			AND `id_parent`='.(int)($movedCategory['id_parent']); $query2 = '


			UPDATE `'._DB_PREFIX_.'faq_category`


			SET `position` = '.(int)($position).'


			WHERE `id_parent` = '.(int)($movedCategory['id_parent']).'


			AND `id_faq_category`='.(int)($movedCategory['id_faq_category']); $result = (Db::getInstance()->Execute($query1) AND Db::getInstance()->Execute($query2)); return $result; } public function getName($id_lang = NULL) { if (!$id_lang) { if (isset($this->name[Context::getContext()->cookie->id_lang])) $id_lang = Context::getContext()->cookie->id_lang; else $id_lang = (int)(Configuration::get('PS_LANG_DEFAULT')); } return isset($this->name[$id_lang]) ? $this->name[$id_lang] : ''; } public static function getCategoriesss(){ $cat = array(); $res = DB::getInstance()->executeS('SELECT c.id_faq_category,cl.name from '._DB_PREFIX_.'faq_category c


				join '._DB_PREFIX_.'faq_category_lang cl on (c.id_faq_category = cl.id_faq_category)


				where cl.id_lang = '.Context::getContext()->cookie->id_lang); foreach($res as $r) $cat[$r['id_faq_category']] = $r['name']; return $cat; } public static function getCategories($id_lang = false, $active = true, $order = true, $sql_filter = '', $sql_sort = '',$sql_limit = '') { if (!Validate::isBool($active)) die(Tools::displayError()); $result = Db::getInstance()->ExecuteS('


		SELECT *


		FROM `'._DB_PREFIX_.'faq_category` c


		LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl ON c.`id_faq_category` = cl.`id_faq_category`


		WHERE 1 '.$sql_filter.' '.($id_lang ? 'AND `id_lang` = '.(int)($id_lang) : '').'


		'.($active ? 'AND `active` = 1' : '').'


		'.(!$id_lang ? 'GROUP BY c.id_faq_category' : '').'


		'.($sql_sort != '' ? $sql_sort : 'ORDER BY c.`level_depth` ASC, c.`position` ASC').'


		'.($sql_limit != '' ? $sql_limit : '') ); if (!$order) return $result; $categories = array(); foreach ($result AS $row) $categories[$row['id_parent']][$row['id_faq_category']]['infos'] = $row; return $categories; } public static function regenerateEntireNtree() { $categories = Db::getInstance()->ExecuteS('SELECT id_faq_category, id_parent FROM '._DB_PREFIX_.'faq_category ORDER BY id_parent ASC, position ASC'); $categoriesArray = array(); foreach ($categories AS $category) $categoriesArray[(int)$category['id_parent']]['subcategories'][(int)$category['id_faq_category']] = 1; $n = 1; self::_subTree($categoriesArray, 1, $n); } public function regenerateEntireNtreeNonStatic(){ self::regenerateEntireNtree(); } protected static function _subTree(&$categories, $id_faq_category, &$n) { $left = (int)$n++; if (isset($categories[(int)$id_faq_category]['subcategories'])) foreach (array_keys($categories[(int)$id_faq_category]['subcategories']) AS $id_subcategory) self::_subTree($categories, (int)$id_subcategory, $n); $right = (int)$n++; Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'faq_category SET nleft = '.(int)$left.', nright = '.(int)$right.' WHERE id_faq_category = '.(int)$id_faq_category.' LIMIT 1'); } public static function getMeta($id_faq_category){ return DB::getInstance()->getRow('SELECT meta_description,meta_keywords from `'._DB_PREFIX_.'faq_category_lang`


			WHERE id_faq_category = '.$id_faq_category.' AND id_lang = '.Context::getContext()->cookie->id_lang); } public static function getChildren($id_parent, $id_lang, $active = true) { if (!Validate::isBool($active)) die(Tools::displayError()); $query = 'SELECT c.`id_faq_category`, cl.`name`, cl.`link_rewrite`


		FROM `'._DB_PREFIX_.'faq_category` c


		LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl ON (c.`id_faq_category` = cl.`id_faq_category`)


		WHERE `id_lang` = '.(int)$id_lang.'


		AND c.`id_parent` = '.(int)$id_parent.'


		'.($active ? 'AND `active` = 1' : '').'


		


		GROUP BY c.`id_faq_category`'; return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query); } public function getParentsCategories($id_lang = null) { $context = Context::getContext()->cloneContext(); if (is_null($id_lang)) $id_lang = $context->language->id; $categories = null; $id_current = $this->id; while (true) { $sql = '


			SELECT c.*, cl.*


			FROM `'._DB_PREFIX_.'faq_category` c


			LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl


				ON (c.`id_faq_category` = cl.`id_faq_category`


				AND `id_lang` = '.(int)$id_lang.')'; $sql .= '


			WHERE c.`id_faq_category` = '.(int)$id_current; $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql); if (isset($result[0])) $categories[] = $result[0]; else if (!$categories) $categories = array(); if (!$result) return $categories; $id_current = $result[0]['id_parent']; } } public static function getTopCategory($id_lang = null) { if (is_null($id_lang)) $id_lang = Context::getContext()->language->id; $id_faq_category = Db::getInstance()->getValue('


		SELECT `id_faq_category`


		FROM `'._DB_PREFIX_.'faq_category`


		WHERE `id_parent` = 0'); return new FaqCategory($id_faq_category, $id_lang); } public static function getCategoriesWithoutParent() { return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('


		SELECT DISTINCT c.*


		FROM `'._DB_PREFIX_.'faq_category` c


		LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl ON (c.`id_faq_category` = cl.`id_faq_category` AND cl.`id_lang` = '.(int)Context::getContext()->language->id.')


		WHERE `level_depth` = 1


		'); } public static function getDescriptionClean($description) { return strip_tags(stripslashes($description)); } public static function getAllCMSStructure($id_shop = false) { $categories = FAQCategory::getCMSCategories(); $id_shop = ($id_shop !== false) ? $id_shop : Context::getContext()->shop->id; foreach ($categories as $key => $value) $categories[$key]['cms_pages'] = FAQCategory::getCMSPages($value['id_cms_category'], $id_shop); return $categories; } public static function getCMSCategories($recursive = false, $parent = 0) { if ($recursive === false) { $sql = 'SELECT bcp.`id_cms_category`, bcp.`id_parent`, bcp.`level_depth`, bcp.`active`, bcp.`position`, cl.`name`, cl.`link_rewrite`


					FROM `'._DB_PREFIX_.'cms_category` bcp


					INNER JOIN `'._DB_PREFIX_.'cms_category_lang` cl


					ON (bcp.`id_cms_category` = cl.`id_cms_category`)


					WHERE cl.`id_lang` = '.(int)Context::getContext()->language->id; if ($parent) $sql .= ' AND bcp.`id_parent` = '.(int)$parent; return Db::getInstance()->executeS($sql); } else { $sql = 'SELECT bcp.`id_cms_category`, bcp.`id_parent`, bcp.`level_depth`, bcp.`active`, bcp.`position`, cl.`name`, cl.`link_rewrite`


					FROM `'._DB_PREFIX_.'cms_category` bcp


					INNER JOIN `'._DB_PREFIX_.'cms_category_lang` cl


					ON (bcp.`id_cms_category` = cl.`id_cms_category`)


					WHERE cl.`id_lang` = '.(int)Context::getContext()->language->id; if ($parent) $sql .= ' AND bcp.`id_parent` = '.(int)$parent; $results = Db::getInstance()->executeS($sql); foreach ($results as $result) { $sub_categories = FAQCategory::getCMSCategories(true, $result['id_cms_category']); if ($sub_categories && count($sub_categories) > 0) $result['sub_categories'] = $sub_categories; $categories[] = $result; } return isset($categories) ? $categories : false; } } public static function getCMSPages($id_cms_category, $id_shop = false) { $id_shop = ($id_shop !== false) ? $id_shop : Context::getContext()->shop->id; $sql = 'SELECT c.`id_cms`, cl.`meta_title`, cl.`link_rewrite`


			FROM `'._DB_PREFIX_.'cms` c


			INNER JOIN `'._DB_PREFIX_.'cms_shop` cs


			ON (c.`id_cms` = cs.`id_cms`)


			INNER JOIN `'._DB_PREFIX_.'cms_lang` cl


			ON (c.`id_cms` = cl.`id_cms`)


			WHERE c.`id_cms_category` = '.(int)$id_cms_category.'


			AND cs.`id_shop` = '.(int)$id_shop.'


			AND cl.`id_lang` = '.(int)Context::getContext()->language->id.'


			AND c.`active` = 1


			ORDER BY `position`'; return Db::getInstance()->executeS($sql); } public function getSubCategories($id_lang, $active = true) { if (!Validate::isBool($active)) die(Tools::displayError()); $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('


		SELECT c.*, cl.id_lang, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description


		FROM `'._DB_PREFIX_.'faq_category` c


		LEFT JOIN `'._DB_PREFIX_.'faq_category_lang` cl ON (c.`id_faq_category` = cl.`id_faq_category` AND `id_lang` = '.(int)$id_lang.')


		WHERE `id_parent` = '.(int)$this->id.'


		'.($active ? 'AND `active` = 1' : '').'


		GROUP BY c.`id_faq_category`


		ORDER BY `position` ASC'); foreach ($result as &$row) $row['name'] = FAQCategory::hideFAQCategoryPosition($row['name']); return $result; } public static function recurseFAQCategory($categories, $current, $id_faq_category = 1, $id_selected = 1, $is_html = 0) { $html = '<option value="'.Context::getContext()->link->getFAQCategoryLink($id_faq_category).'"'.(($id_selected == $id_faq_category) ? ' selected="selected"' : '').'>' .str_repeat('&nbsp;', $current['infos']['level_depth'] * 5) .FAQCategory::hideFAQCategoryPosition(stripslashes($current['infos']['name'])).'</option>'; if ($is_html == 0) echo $html; if (isset($categories[$id_faq_category])) foreach (array_keys($categories[$id_faq_category]) as $key) $html .= FAQCategory::recurseFAQCategory($categories, $categories[$id_faq_category][$key], $key, $id_selected, $is_html); return $html; } public static function recurseFAQCategoryOptions($categories, $current, $id_faq_category = 1, $val_name) { $options[] = array( $val_name => $id_faq_category, 'name' => str_repeat('&nbsp;', $current['infos']['level_depth'] * 5) .FAQCategory::hideFAQCategoryPosition(stripslashes($current['infos']['name'])) ); if (isset($categories[$id_faq_category])) foreach (array_keys($categories[$id_faq_category]) as $key) $options = array_merge($options, FAQCategory::recurseFAQCategoryOptions($categories, $categories[$id_faq_category][$key], $key, $val_name)); return $options; } } 