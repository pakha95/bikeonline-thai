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


 class FAQ extends ObjectModel { public $question; public $answer; public $id_faq_category; public $position; public $active; public $date_add; public $date_upd; public static $definition = array( 'table' => 'faq', 'primary' => 'id_faq', 'multilang' => true, 'fields' => array( 'id_faq_category' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt','required'=>true), 'position' => array('type' => self::TYPE_INT), 'active' => array('type' => self::TYPE_BOOL), 'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'), 'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'), 'answer' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 3999999999999), 'question' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 255), ), ); public function __construct( $id = null, $id_lang = null, $id_shop = null ) { Shop::addTableAssociation('faq', array( 'type'=> 'shop' )); parent::__construct( $id, $id_lang, $id_shop ); } public function add($autodate = true, $null_values = false) { $this->position = FAQ::getLastPosition((int)$this->id_faq_category); return parent::add($autodate, true); } public function update($null_values = false) { if (parent::update($null_values)) return $this->cleanPositions($this->id_faq_category); return false; } public function delete() { if (parent::delete()) return $this->cleanPositions($this->id_faq_category); return false; } public static function getLinks($id_lang, $selection = null, $active = true, Link $link = null) { if (!$link) $link = new Link; $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('


		SELECT c.id_faq, cl.link_rewrite, cl.meta_title


		FROM '._DB_PREFIX_.'faq c


		LEFT JOIN '._DB_PREFIX_.'faq_lang cl ON (c.id_faq = cl.id_faq AND cl.id_lang = '.(int)$id_lang.')


		'.Shop::addSqlAssociation('faq', 'c').'


		WHERE 1


		'.(($selection !== null) ? ' AND c.id_faq IN ('.implode(',', array_map('intval', $selection)).')' : ''). ($active ? ' AND c.`active` = 1 ' : ''). 'GROUP BY c.id_faq


		ORDER BY c.`position`'); $links = array(); if ($result) foreach ($result as $row) { $row['link'] = $link->getFAQLink((int)$row['id_faq'], $row['link_rewrite']); $links[] = $row; } return $links; } public static function listFaq($id_lang = null, $id_block = false, $active = true) { if (empty($id_lang)) $id_lang = (int)Configuration::get('PS_LANG_DEFAULT'); return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('


		SELECT c.id_faq, l.meta_title


		FROM  '._DB_PREFIX_.'faq c


		JOIN '._DB_PREFIX_.'faq_lang l ON (c.id_faq = l.id_faq)


		'.Shop::addSqlAssociation('faq', 'c').'


		'.(($id_block) ? 'JOIN '._DB_PREFIX_.'block_faq b ON (c.id_faq = b.id_faq)' : '').'


		WHERE l.id_lang = '.(int)$id_lang.(($id_block) ? ' AND b.id_block = '.(int)$id_block : '').($active ? ' AND c.`active` = 1 ' : '').'


		GROUP BY c.id_faq


		ORDER BY c.`position`'); } public function updatePosition($way, $position) { if (!$res = Db::getInstance()->executeS('


			SELECT cp.`id_faq`, cp.`position`, cp.`id_faq_category`


			FROM `'._DB_PREFIX_.'faq` cp


			WHERE cp.`id_faq_category` = '.(int)$this->id_faq_category.'


			ORDER BY cp.`position` ASC' )) return false; foreach ($res as $faq) if ((int)$faq['id_faq'] == (int)$this->id) $moved_faq = $faq; if (!isset($moved_faq) || !isset($position)) return false; return (Db::getInstance()->execute('


			UPDATE `'._DB_PREFIX_.'faq`


			SET `position`= `position` '.($way ? '- 1' : '+ 1').'


			WHERE `position`


			'.($way ? '> '.(int)$moved_faq['position'].' AND `position` <= '.(int)$position : '< '.(int)$moved_faq['position'].' AND `position` >= '.(int)$position).'


			AND `id_faq_category`='.(int)$moved_faq['id_faq_category']) && Db::getInstance()->execute('


			UPDATE `'._DB_PREFIX_.'faq`


			SET `position` = '.(int)$position.'


			WHERE `id_faq` = '.(int)$moved_faq['id_faq'].'


			AND `id_faq_category`='.(int)$moved_faq['id_faq_category'])); } public static function cleanPositions($id_category) { $sql = '


		SELECT `id_faq`


		FROM `'._DB_PREFIX_.'faq`


		WHERE `id_faq_category` = '.(int)$id_category.'


		ORDER BY `position`'; $result = Db::getInstance()->executeS($sql); for ($i = 0, $total = count($result); $i < $total; ++$i) { $sql = 'UPDATE `'._DB_PREFIX_.'faq`


					SET `position` = '.(int)$i.'


					WHERE `id_faq_category` = '.(int)$id_category.'


						AND `id_faq` = '.(int)$result[$i]['id_faq']; Db::getInstance()->execute($sql); } return true; } public static function getLastPosition($id_category) { $sql = '


		SELECT MAX(position) + 1


		FROM `'._DB_PREFIX_.'faq`


		WHERE `id_faq_category` = '.(int)$id_category; return (Db::getInstance()->getValue($sql)); } public static function getFAQPages($id_lang = null, $id_faq_category = null, $active = true, $id_shop = null, $limit = null, $query = null) { $sql = new DbQuery(); $sql->select('*'); $sql->from('faq', 'c'); if ($id_lang) $sql->leftJoin('faq_lang', 'l', 'c.id_faq = l.id_faq AND l.id_lang = '.(int)$id_lang); if ($id_shop) $sql->innerJoin('faq_shop', 'cs', 'c.id_faq = cs.id_faq AND cs.id_shop = '.(int)$id_shop); if ($active) $sql->where('c.active = 1'); if ($id_faq_category) $sql->where('c.id_faq_category = '.(int)$id_faq_category); $sql->orderBy('position'); if ($limit) $sql->limit($limit); return Db::getInstance()->executeS($sql); } public static function getUrlRewriteInformations($id_faq) { $sql = 'SELECT l.`id_lang`, c.`link_rewrite`


				FROM `'._DB_PREFIX_.'faq_lang` AS c


				LEFT JOIN  `'._DB_PREFIX_.'lang` AS l ON c.`id_lang` = l.`id_lang`


				WHERE c.`id_faq` = '.(int)$id_faq.'


				AND l.`active` = 1'; return Db::getInstance()->executeS($sql); } } 