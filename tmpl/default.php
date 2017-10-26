<?php
/**
 * @package     Responsive_Menu
 * @subpackage  mod_responsivemenu
 *
 * @copyright   Copyright (C) 2016 Niels van der Veer, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;
?>

<style>
/* Mobile menu */
.mmenu-bar {
	background-color:<?php echo $params->get("menutogglebackground", "#666666"); ?>;
	height:<?php echo $params->get("menutoggleheight", "45px"); ?>;
}
    
    .mmenu-bar a {
        color:<?php echo $params->get("menulabelcolor", "#ffffff"); ?>;
          line-height: <?php echo $params->get("menutoggleheight", "45px"); ?>;
    }
a.mmenu-toggle,
a.mmenu-search-toggle {
	color:<?php echo $params->get("menulabelcolor", "#ffffff"); ?>;
	line-height:<?php echo $params->get("menutoggleheight", "45px"); ?>;
}
nav.mmenu {
	background:<?php echo $params->get('mobilebackground', '#ffffff'); ?>;
	padding-top:<?php echo $params->get('menutoggleheight', '45px'); ?>;
}
nav.mmenu ul li.active {
	background-color:<?php echo $params->get('mobileactivebackground', '#f1f1f1'); ?>;
}
nav.mmenu ul li a, .menu-close {
	color:<?php echo $params->get('mobiletextcolor', '#333333'); ?>;
}

@media (min-width: <?php echo $params->get('mobilebreak', '992px'); ?>) {
	.mmenu-bar,
	.mmenu-search {
		display:none;
	}
}
@media (max-width: <?php echo $params->get('mobilebreak', '992px'); ?>) {
	<?php echo $params->get('mobiledisappear','#menu'); ?> {
		display: none;
	}
}
<?php echo $params->get('customcss'); ?>
</style>
<div class="responsive-menu">
	<div class="mmenu-bar <?php echo $params->get('menutogglefixed'); ?> <?php echo $params->get('menutoggletop'); ?>">
		<div class="mmenu-logo">
            
            
			<?php if ($params->get("logo")) : ?>
            <a href="/">
				<img src="<?php echo $params->get("logo"); ?>">
            </a>
			<?php endif;  ?>
             
            
		</div>
        <a href="#" class="mmenu-toggle">
			<i class="fal fa-bars"></i><?php if ($params->get("showmenulabel", 1)) : ?> <?php echo $params->get('menulabel', 'MENU'); ?> <?php endif; ?>
		</a>
        <?php if ($params->get("showcontacticon", 1)) : ?>
        <a href="/contact" >
			<i class="fal fa-address-book"></i>
		</a>
        <?php endif; ?>
        <?php if ($params->get("showphone", 1)) : ?>
        <a href="tel:<?php echo $params->get("phonenumber"); ?>" >
			<i class="fal fa-phone"></i>
		</a>
        <?php endif; ?>
        
		<?php if ($params->get("showsearch", 1)) : ?>
		<a href="#" class="mmenu-search-toggle">
			<i class="fal fa-search"></i> <?php if ($params->get("showsearchlabel", 1)) : ?> <?php echo $params->get("searchlabel", "Zoeken"); ?> <?php endif; ?>
		</a>
		<?php endif; ?>
       
        
	</div>
	<?php if ($params->get("showsearch", 1)) : ?>
	<div class="mmenu-search <?php echo $params->get('menutogglefixed'); ?> <?php echo $params->get('menutoggletop'); ?>">
		<?php
			$module = JModuleHelper::getModule($params->get("searchmodule", "mod_finder"));
			$attribs["style"] = "none";
			echo JModuleHelper::renderModule($module, $attribs);
		?>
        
        
        
	</div>
	<?php endif; ?>
	<nav class="mmenu">
		<ul>
			<?php
			foreach ($list as $i => &$item)
			{
				$class     = "item-" . $item->id;
				$class_sub = "";

				if ($item->id == $default_id)
				{
					$class .= ' default';
				}

				if (($item->id == $active_id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active_id))
				{
					$class .= ' current';
				}

				if (in_array($item->id, $path))
				{
					$class .= ' submenu-open active';
					$class_sub = ' submenu-open';
				}

				if ($item->deeper)
				{
					$class .= ' deeper';

					if ($params->get('mobilesubmenuopened', 0) == "1")
					{
						$class .= ' submenu-open';
					}
					elseif ($params->get('mobilesubmenuopened', 0) == "2" && in_array($item->id, $params->get("opensubmenus")))
					{
						$class .= ' submenu-open';
					}
				}

				if (!empty($class))
				{
					$class = ' class="' . trim($class) . '"';
				}

				echo '<li' . $class . '>';

				switch ($item->type)
				{
					case 'separator':
					case 'url':
					case 'component':
					case 'heading':
						require JModuleHelper::getLayoutPath('mod_responsivemenu', 'default_' . $item->type);
						break;
					default:
						require JModuleHelper::getLayoutPath('mod_responsivemenu', 'default_url');
						break;
				}

				if ($item->deeper)
				{
					echo '<a href="#" class="sub-toggle" onclick="return false"></a>';

					if ($params->get('mobilesubmenuopened', 0) == '1')
					{
						$class_sub = 'submenu-open';
					}
					elseif ($params->get('mobilesubmenuopened', 0) == "2" && in_array($item->id, $params->get("opensubmenus")))
					{
						$class_sub = 'submenu-open';
					}

					echo '<ul class="submenu ' . $class_sub . '">';
				}
				elseif ($item->shallower)
				{
					echo '</li>';
					echo str_repeat('</ul></li>', $item->level_diff);
				}
				else
				{
					echo '</li>';
				}
			}
			?>
		</ul>
	</nav>
</div>
