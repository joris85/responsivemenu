<?php
/**
 * @package     Responsive_Menu
 * @subpackage  mod_responsivemenu
 *
 * @copyright   Copyright (C) 2016 Niels van der Veer, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$list		= ModResponsiveMenuHelper::getList($params);
$base		= ModResponsiveMenuHelper::getBase($params);
$active		= ModResponsiveMenuHelper::getActive($params);
$default    = ModResponsiveMenuHelper::getDefault();
$active_id 	= $active->id;
$path		= $base->tree;

$showAll	= $params->get('showAllChildren', 1);
$class_sfx	= htmlspecialchars($params->get('class_sfx'));

if ($params->get('loadcss'))
{
	JHtml::stylesheet("mod_responsivemenu/responsivemenu.css", false, true);
	JHtml::script("mod_responsivemenu/responsivemenu.js", false, true);
}

if (count($list))
{
	require JModuleHelper::getLayoutPath('mod_responsivemenu', $params->get('layout', 'default'));
}
