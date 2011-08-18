<?php /* Smarty version 2.6.20, created on 2011-08-18 12:34:36
         compiled from submenus.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'istrue', 'submenus.html', 4, false),)), $this); ?>
<div id="conts_menu">
	<ul class="menu_lat">
	<?php if ($this->_tpl_vars['infopag']['tree']['sup_tour']): ?>
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['general_behavior'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['general_behavior']; ?>
"><?php echo $this->_config[0]['vars']['MENU_GENERAL_BEHAVIOR']!=''?$this->_config[0]['vars']['MENU_GENERAL_BEHAVIOR']:'#MENU_GENERAL_BEHAVIOR#'; ?>
 <span>2:15</span></a></li>		
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['social_sharing'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['social_sharing']; ?>
"><?php echo $this->_config[0]['vars']['MENU_SOCIAL_SHARING']!=''?$this->_config[0]['vars']['MENU_SOCIAL_SHARING']:'#MENU_SOCIAL_SHARING#'; ?>
 <span>1:25</span></a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['real_time'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['real_time']; ?>
"><?php echo $this->_config[0]['vars']['MENU_REAL_TIME']!=''?$this->_config[0]['vars']['MENU_REAL_TIME']:'#MENU_REAL_TIME#'; ?>
 <span>0:58</span></a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['import_export'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['import_export']; ?>
"><?php echo $this->_config[0]['vars']['MENU_IMPORT_EXPORT']!=''?$this->_config[0]['vars']['MENU_IMPORT_EXPORT']:'#MENU_IMPORT_EXPORT#'; ?>
 <span>1:47</span></a></li>
	<?php elseif ($this->_tpl_vars['infopag']['tree']['sup_features']): ?>
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['overview'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['overview']; ?>
"><?php echo $this->_config[0]['vars']['MENU_OVERVIEW']!=''?$this->_config[0]['vars']['MENU_OVERVIEW']:'#MENU_OVERVIEW#'; ?>
</a></li>
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['smart_group'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['smart_group']; ?>
"><?php echo $this->_config[0]['vars']['MENU_SMART_GROUP']!=''?$this->_config[0]['vars']['MENU_SMART_GROUP']:'#MENU_SMART_GROUP#'; ?>
</a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['instant_sincronization'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['instant_sincronization']; ?>
"><?php echo $this->_config[0]['vars']['MENU_INSTANT_SINCRONIZATION']!=''?$this->_config[0]['vars']['MENU_INSTANT_SINCRONIZATION']:'#MENU_INSTANT_SINCRONIZATION#'; ?>
</a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['really_search'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['really_search']; ?>
"><?php echo $this->_config[0]['vars']['MENU_REALLY_SEARCH']!=''?$this->_config[0]['vars']['MENU_REALLY_SEARCH']:'#MENU_REALLY_SEARCH#'; ?>
</a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['imports_exports'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['imports_exports']; ?>
"><?php echo $this->_config[0]['vars']['MENU_IMPORT_EXPORT']!=''?$this->_config[0]['vars']['MENU_IMPORT_EXPORT']:'#MENU_IMPORT_EXPORT#'; ?>
</a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['technical_details'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['technical_details']; ?>
"><?php echo $this->_config[0]['vars']['MENU_TECHNICAL_DETAILS']!=''?$this->_config[0]['vars']['MENU_TECHNICAL_DETAILS']:'#MENU_TECHNICAL_DETAILS#'; ?>
</a></li>	
	<?php elseif ($this->_tpl_vars['infopag']['tree']['sup_support']): ?>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['faqs'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['faqs']; ?>
"><?php echo $this->_config[0]['vars']['MENU_FAQS']!=''?$this->_config[0]['vars']['MENU_FAQS']:'#MENU_FAQS#'; ?>
</a></li>		
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['developpers'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['developpers']; ?>
"><?php echo $this->_config[0]['vars']['MENU_DEVELOPPERS']!=''?$this->_config[0]['vars']['MENU_DEVELOPPERS']:'#MENU_DEVELOPPERS#'; ?>
</a></li>	
		<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['forum'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['forum']; ?>
"><?php echo $this->_config[0]['vars']['MENU_FORUM']!=''?$this->_config[0]['vars']['MENU_FORUM']:'#MENU_FORUM#'; ?>
</a></li>		
	<?php endif; ?>
	</ul>
</div>