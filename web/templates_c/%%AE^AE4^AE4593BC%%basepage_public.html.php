<?php /* Smarty version 2.6.20, created on 2011-08-18 12:34:31
         compiled from basepage_public.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'basepage_public.html', 7, false),array('modifier', 'coalesce', 'basepage_public.html', 15, false),array('modifier', 'default', 'basepage_public.html', 31, false),array('modifier', 'separatxt', 'basepage_public.html', 31, false),array('modifier', 'istrue', 'basepage_public.html', 45, false),array('modifier', 'choice', 'basepage_public.html', 121, false),array('function', 'config_load', 'basepage_public.html', 8, false),)), $this); ?>
<?php echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; ?><?php echo ''; ?><?php $this->assign('_diccionari', ((is_array($_tmp=$this->_tpl_vars['infopag']['idioma'])) ? $this->_run_mod_handler('cat', true, $_tmp, '.conf') : smarty_modifier_cat($_tmp, '.conf'))); ?><?php echo ''; ?><?php echo smarty_function_config_load(array('file' => $this->_tpl_vars['_diccionari'],'section' => 'generics'), $this);?><?php echo ''; ?><?php echo smarty_function_config_load(array('file' => $this->_tpl_vars['_diccionari'],'section' => $this->_tpl_vars['infopag']['subseccio']), $this);?><?php echo ''; ?><?php echo smarty_function_config_load(array('file' => 'base.conf','section' => $this->_tpl_vars['infopag']['subseccio']), $this);?><?php echo ''; ?><?php if ($this->_config[0]['vars']['OPT_PARENT']!=''?$this->_config[0]['vars']['OPT_PARENT']:'#OPT_PARENT#'): ?><?php echo ''; ?><?php echo smarty_function_config_load(array('file' => $this->_tpl_vars['_diccionari'],'section' => $this->_config[0]['vars']['OPT_PARENT']!=''?$this->_config[0]['vars']['OPT_PARENT']:'#OPT_PARENT#'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('pagina', $this->_tpl_vars['transpag'][$this->_tpl_vars['infopag']['idioma']]); ?><?php echo ''; ?><?php $this->assign('_wr', ((is_array($_tmp=$this->_tpl_vars['infopag']['_wr'])) ? $this->_run_mod_handler('coalesce', true, $_tmp, $this->_config[0]['vars']['_wr']!=''?$this->_config[0]['vars']['_wr']:'#_wr#', '/') : smarty_modifier_coalesce($_tmp, $this->_config[0]['vars']['_wr']!=''?$this->_config[0]['vars']['_wr']:'#_wr#', '/'))); ?><?php echo ''; ?><?php $this->assign('_uwr', ((is_array($_tmp=$this->_tpl_vars['infopag']['_uwr'])) ? $this->_run_mod_handler('coalesce', true, $_tmp, $this->_config[0]['vars']['_wr']!=''?$this->_config[0]['vars']['_wr']:'#_wr#', '/') : smarty_modifier_coalesce($_tmp, $this->_config[0]['vars']['_wr']!=''?$this->_config[0]['vars']['_wr']:'#_wr#', '/'))); ?><?php echo ''; ?><?php $this->assign('smart_conts', ($this->_tpl_vars['infopag']['subseccio']).".html"); ?><?php echo ''; ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['infopag']['idioma']; ?>
" lang="<?php echo $this->_tpl_vars['infopag']['idioma']; ?>
">
<head>
  		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link type="image/x-icon" href="<?php echo $this->_tpl_vars['_wr']; ?>
favicon.ico" rel="icon" />
		<link type="image/x-icon" href="<?php echo $this->_tpl_vars['_wr']; ?>
favicon.ico" rel="shortcut icon" />
		<meta name="Description" content="<?php echo $this->_config[0]['vars']['DESCRIPCIO']!=''?$this->_config[0]['vars']['DESCRIPCIO']:'#DESCRIPCIO#'; ?>
" />
		<meta name="keywords" content="<?php echo $this->_config[0]['vars']['PARAULESCLAU']!=''?$this->_config[0]['vars']['PARAULESCLAU']:'#PARAULESCLAU#'; ?>
" />
		<meta name="robots" content="all" />
		<link href="<?php echo $this->_tpl_vars['_wr']; ?>
css/general.css" rel="stylesheet" type="text/css" />

<title><?php echo ((is_array($_tmp=@$this->_config[0]['vars']['TITLE']!=''?$this->_config[0]['vars']['TITLE']:'#TITLE#')) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_config[0]['vars']['TITOL']!=''?$this->_config[0]['vars']['TITOL']:'#TITOL#') : smarty_modifier_default($_tmp, @$this->_config[0]['vars']['TITOL']!=''?$this->_config[0]['vars']['TITOL']:'#TITOL#')); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['titol_pag'])) ? $this->_run_mod_handler('separatxt', true, $_tmp) : smarty_modifier_separatxt($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_config[0]['vars']['TITLE_CUA']!=''?$this->_config[0]['vars']['TITLE_CUA']:'#TITLE_CUA#')) ? $this->_run_mod_handler('separatxt', true, $_tmp, '. ') : smarty_modifier_separatxt($_tmp, '. ')); ?>
</title>
</head>
	<body class="lang_<?php echo $this->_tpl_vars['infopag']['idioma']; ?>
 <?php $_from = $this->_tpl_vars['infopag']['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>sec-<?php echo $this->_tpl_vars['k']; ?>
 <?php endforeach; endif; unset($_from); ?>">

	<div id="capcelera">
		<div class="constrictor clearfix">
			<h1 class="cap_logo">
				<a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['inici']; ?>
">
					<span class="notext">SKAEDA</span>
				</a>
			</h1>

			<div id="capcelera_menu">
				<ul class="menu_h menu_nav">
					<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['sup_tour'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['general_behavior']; ?>
"><?php echo $this->_config[0]['vars']['NAVS_TOUR']!=''?$this->_config[0]['vars']['NAVS_TOUR']:'#NAVS_TOUR#'; ?>
</a></li>
					<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['sup_features'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
 ><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['overview']; ?>
"><?php echo $this->_config[0]['vars']['NAVS_FEATURES']!=''?$this->_config[0]['vars']['NAVS_FEATURES']:'#NAVS_FEATURES#'; ?>
</a></li>
					<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['sup_pricing'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['pricing']; ?>
"><?php echo $this->_config[0]['vars']['NAVS_PRICING']!=''?$this->_config[0]['vars']['NAVS_PRICING']:'#NAVS_PRICING#'; ?>
</a></li>
					<li <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['tree']['sup_support'])) ? $this->_run_mod_handler('istrue', true, $_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#') : smarty_modifier_istrue($_tmp, $this->_config[0]['vars']['_CLASSACT']!=''?$this->_config[0]['vars']['_CLASSACT']:'#_CLASSACT#')); ?>
><a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['faqs']; ?>
"><?php echo $this->_config[0]['vars']['NAVS_SUPPORT']!=''?$this->_config[0]['vars']['NAVS_SUPPORT']:'#NAVS_SUPPORT#'; ?>
</a></li>
				</ul>
				
				<ul class="menu_h menu_nav2">
					<li class="login">
						<a href="https://skaeda.com"><span class="notext"><?php echo $this->_config[0]['vars']['LOGIN']!=''?$this->_config[0]['vars']['LOGIN']:'#LOGIN#'; ?>
</span></a>
					</li>
				</ul>
			</div>
		</div>
		<?php if ($this->_config[0]['vars']['OPT_SUBMENU']!=''?$this->_config[0]['vars']['OPT_SUBMENU']:'#OPT_SUBMENU#'): ?>
		<div id="capcelera_submenu">
			<div class="constrictor clearfix">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'submenus_top.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div id="main">
		<div class="constrictor clearfix">
			<div id="conts">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_config[0]['vars']['OPT_PAG_CONTS']!=''?$this->_config[0]['vars']['OPT_PAG_CONTS']:'#OPT_PAG_CONTS#')) ? $this->_run_mod_handler('istrue', true, $_tmp, '_self_', $this->_tpl_vars['smart_conts']) : smarty_modifier_istrue($_tmp, '_self_', $this->_tpl_vars['smart_conts'])), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</div>
	</div>
	<div id="peu">
		<div class="constrictor clearfix">
			<p id="peu_signup" class="notext">
				<span>Sign up in 60 seconds and choose your plan later</span>
				<a href="http://services.skaeda.com/?fun=newaccount"><span>Try it for free</span></a>
			</p>

			<div class="llista_links">
				<dl>
					<dt><?php echo $this->_config[0]['vars']['PEU_PRODUCT']!=''?$this->_config[0]['vars']['PEU_PRODUCT']:'#PEU_PRODUCT#'; ?>
</dt>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['inici']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_HOME']!=''?$this->_config[0]['vars']['PEU_HOME']:'#PEU_HOME#'; ?>
</a>  </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['general_behavior']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_TOUR']!=''?$this->_config[0]['vars']['PEU_TOUR']:'#PEU_TOUR#'; ?>
</a> </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['overview']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_FEATURES']!=''?$this->_config[0]['vars']['PEU_FEATURES']:'#PEU_FEATURES#'; ?>
</a>  </dd>
				</dl>

				<dl>
					<dt><?php echo $this->_config[0]['vars']['PEU_SUPPORT']!=''?$this->_config[0]['vars']['PEU_SUPPORT']:'#PEU_SUPPORT#'; ?>
</dt>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['forum']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_FORUM']!=''?$this->_config[0]['vars']['PEU_FORUM']:'#PEU_FORUM#'; ?>
</a>  </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['developpers']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_DEVELOPERS']!=''?$this->_config[0]['vars']['PEU_DEVELOPERS']:'#PEU_DEVELOPERS#'; ?>
</a> </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['faqs']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_HELPCENTER']!=''?$this->_config[0]['vars']['PEU_HELPCENTER']:'#PEU_HELPCENTER#'; ?>
</a>  </dd>
				</dl>

				<dl>
					<dt><?php echo $this->_config[0]['vars']['PEU_COMPANY']!=''?$this->_config[0]['vars']['PEU_COMPANY']:'#PEU_COMPANY#'; ?>
</dt>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['press']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_PRESS']!=''?$this->_config[0]['vars']['PEU_PRESS']:'#PEU_PRESS#'; ?>
</a>  </dd>	
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['about']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_SOBRE_EMPRESA']!=''?$this->_config[0]['vars']['PEU_SOBRE_EMPRESA']:'#PEU_SOBRE_EMPRESA#'; ?>
</a></dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['contact']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_CONTACTE']!=''?$this->_config[0]['vars']['PEU_CONTACTE']:'#PEU_CONTACTE#'; ?>
</a> </dd>
				</dl>


				<dl>
					<dt><?php echo $this->_config[0]['vars']['PEU_NETWORK']!=''?$this->_config[0]['vars']['PEU_NETWORK']:'#PEU_NETWORK#'; ?>
</dt>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['blog']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_BLOG']!=''?$this->_config[0]['vars']['PEU_BLOG']:'#PEU_BLOG#'; ?>
 </a> </dd>
					<dd> <a href="#" ><?php echo $this->_config[0]['vars']['PEU_TWITTER']!=''?$this->_config[0]['vars']['PEU_TWITTER']:'#PEU_TWITTER#'; ?>
</a>  </dd>
					<dd> <a href="#" ><?php echo $this->_config[0]['vars']['PEU_FACEBOOK']!=''?$this->_config[0]['vars']['PEU_FACEBOOK']:'#PEU_FACEBOOK#'; ?>
</a>  </dd>
				</dl>

				<dl>
					<dt><?php echo $this->_config[0]['vars']['PEU_MORE']!=''?$this->_config[0]['vars']['PEU_MORE']:'#PEU_MORE#'; ?>
</dt>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['segurity']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_SEGURITAT']!=''?$this->_config[0]['vars']['PEU_SEGURITAT']:'#PEU_SEGURITAT#'; ?>
</a>  </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['privacy_policy']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_PRIVACIDAD']!=''?$this->_config[0]['vars']['PEU_PRIVACIDAD']:'#PEU_PRIVACIDAD#'; ?>
</a>  </dd>
					<dd> <a href="<?php echo $this->_tpl_vars['_wr']; ?>
<?php echo $this->_tpl_vars['pagina']['terms_service']; ?>
" ><?php echo $this->_config[0]['vars']['PEU_SERVICIO']!=''?$this->_config[0]['vars']['PEU_SERVICIO']:'#PEU_SERVICIO#'; ?>
</a>  </dd>
				</dl>
			</div>
			<div id="peu_extres">
				<div  class="lang_select">
					<select name="idiomes">
						<option value="en" <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['idioma'])) ? $this->_run_mod_handler('choice', true, $_tmp, 'en', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#') : smarty_modifier_choice($_tmp, 'en', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#')); ?>
><?php echo $this->_config[0]['vars']['ENGLISH']!=''?$this->_config[0]['vars']['ENGLISH']:'#ENGLISH#'; ?>
</option>	
						<option value="ca" <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['idioma'])) ? $this->_run_mod_handler('choice', true, $_tmp, 'ca', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#') : smarty_modifier_choice($_tmp, 'ca', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#')); ?>
><?php echo $this->_config[0]['vars']['CATALA']!=''?$this->_config[0]['vars']['CATALA']:'#CATALA#'; ?>
</option>	
						<option value="es" <?php echo ((is_array($_tmp=$this->_tpl_vars['infopag']['idioma'])) ? $this->_run_mod_handler('choice', true, $_tmp, 'es', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#') : smarty_modifier_choice($_tmp, 'es', $this->_config[0]['vars']['_FRSEL']!=''?$this->_config[0]['vars']['_FRSEL']:'#_FRSEL#')); ?>
><?php echo $this->_config[0]['vars']['ESPANOL']!=''?$this->_config[0]['vars']['ESPANOL']:'#ESPANOL#'; ?>
</option>				
					</select>
				</div>
							<a href="http://www.flux.cat" class="logo_peu_dreta notext"><span>Flux</span></a>
			</div>
		</div>
	</div>




</body>
</html>