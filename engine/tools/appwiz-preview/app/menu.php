<?php
/**
* ZnetDK, Starter Web Application for rapid & easy development
* See official website http://www.znetdk.fr 
* Copyright (C) 2015 Pascal MARTINEZ (contact@znetdk.fr)
* License GNU GPL http://www.gnu.org/licenses/gpl-3.0.html GNU GPL
* --------------------------------------------------------------------
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
* --------------------------------------------------------------------
* Menu definition of the Application Wizard preview
*
* File version: 1.1
* Last update: 08/22/2018 
*/
namespace app;
class Menu implements \iMenu {

    static public function initAppMenuItems() {
        \MenuManager::addMenuItem(null, 'preview', LA_MENU_PREVIEW, 'fa-home');
        \MenuManager::addMenuItem(null, 'try_themes', LA_MENU_THEMES, 'fa-television');
        \MenuManager::addMenuItem(null, 'check_widgets', LA_MENU_WIDGETS, 'fa-gamepad');
        \MenuManager::addMenuItem(null, 'menux', LA_MENU_MENUX, 'fa-folder-open-o');
        \MenuManager::addMenuItem('menux', 'submenu1', LA_MENU_SUBMENU1, 'fa-folder-o');
        \MenuManager::addMenuItem('menux', 'submenu2', LA_MENU_SUBMENU2, 'fa-folder-open-o');
        \MenuManager::addMenuItem('submenu2', 'submenu21', LA_MENU_SUBMENU21, 'fa-folder-o');
        \MenuManager::addMenuItem('submenu2', 'submenu22', LA_MENU_SUBMENU22, 'fa-folder-o');
        \MenuManager::addMenuItem('menux', 'submenu3', LA_MENU_SUBMENU3, 'fa-folder-o');
    }

}