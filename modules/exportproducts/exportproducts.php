<?php
/**
  * Export Products
  * @category export
  *
  * @author Oavea - Oavea.com
  * @copyright Oavea / PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 2.4.0
  */

class ExportProducts extends Module
{
	public function __construct()
	{
		$this->name = 'exportproducts';
		$this->tab = 'administration';
		$this->version = '2.6.0';
		$this->displayName = 'Export Products';
		$this->author = 'Oavea - oavea.com';
		$this->description = 'A module to export all products to csv matching the Prestashop import template.';

		parent::__construct();
	}

	public function install()
	{
		$this->installController('AdminExportProducts', 'Export Products');
		return parent::install();

	}

	private function installController($controllerName, $name) {
        $tab_admin_order_id = Tab::getIdFromClassName ('AdminTools') ? Tab::getIdFromClassName ('AdminTools') : Tab::getIdFromClassName ('AdminAdvancedParameters');
        $tab = new Tab();
        $tab->class_name = $controllerName;
        $tab->id_parent = $tab_admin_order_id;
        $tab->module = $this->name;
        $languages = Language::getLanguages(false);
        foreach($languages as $lang){
            $tab->name[$lang['id_lang']] = $name;
        }
    	$tab->save();
	}

	public function uninstall()
	{
		$this->uninstallController('AdminExportProducts');
		return parent::uninstall();
	}

	public function uninstallController($controllerName) {
		$tab_controller_main_id = TabCore::getIdFromClassName($controllerName);
		$tab_controller_main = new Tab($tab_controller_main_id);
		$tab_controller_main->delete();
	}

}
