<?php /* Smarty version 2.6.20, created on 2011-08-18 12:34:36
         compiled from overview.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'overview.html', 8, false),)), $this); ?>
﻿<div class="conts_2cols">
	<div class="conts_col1">
		<h2><?php echo $this->_config[0]['vars']['NAVS_FEATURES']!=''?$this->_config[0]['vars']['NAVS_FEATURES']:'#NAVS_FEATURES#'; ?>
</h2>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'submenus.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class="cos">
		<div id="bloc_llista" class="bloc_overview">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['infopag']['subseccio'])) ? $this->_run_mod_handler('cat', true, $_tmp, '.lang.', $this->_tpl_vars['infopag']['idioma'], '.html') : smarty_modifier_cat($_tmp, '.lang.', $this->_tpl_vars['infopag']['idioma'], '.html')), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>