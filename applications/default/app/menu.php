<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website http://www.znetdk.fr
 * ------------------------------------------------------------
 * Custom navigation menu of the application
 * YOU CAN FREELY CUSTOMIZE THE CONTENT OF THIS FILE
 */
namespace app;
class Menu implements \iMenu {

    static public function initAppMenuItems() {
        \MenuManager::addMenuItem(NULL, 'check_connection', LA_MENU_HOME, 'fa-home');
        \MenuManager::addMenuItem(NULL, 'try_themes', LA_MENU_THEMES, 'fa-television');
        \MenuManager::addMenuItem(NULL, 'check_widgets', LA_MENU_WIDGETS, 'fa-gamepad');
        \MenuManager::addMenuItem(NULL, '_authorization', LC_MENU_AUTHORIZATION, 'fa-unlock-alt');
        \MenuManager::addMenuItem('_authorization', 'users', LC_MENU_AUTHORIZ_USERS, 'fa-user');
        \MenuManager::addMenuItem('_authorization', 'profiles', LC_MENU_AUTHORIZ_PROFILES, 'fa-key');

        \MenuManager::addMenuItem(NULL, 'bancos', 'Bancos');
    }

}