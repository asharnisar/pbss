<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="<?php echo asset_css('style1.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_css('jquery.tagit.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_css('tagit.ui-zendesk.css');?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo asset_css('flick-jquery-ui.css');?>">
<link href="<?php echo asset_css('chosen.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_css('flexigrid.pack.css');?>" rel="stylesheet" type="text/css" />
<script src="<?php echo asset_js('jquery-1.9.1.js');?>"></script>
<script src="<?php echo asset_js('1.10.3-jquery-ui.js');?>"></script>
<script src="<?php echo asset_js('chosen.jquery.js');?>"></script>
<!--<script src="<?php echo admin_asset_js('jquery-1.6.4.min.js');?>" type="text/javascript"></script>
<script src="<?php echo asset_js('jquery-ui-1.8.6.custom.min.js');?>" type="text/javascript"></script>-->
<script src="<?php echo asset_js('tag-it.js');?>" type="text/javascript"></script>
<script src="<?php echo asset_js('flexigrid.pack.js');?>" type="text/javascript"></script>
<script src="<?php echo asset_js('common.js');?>" type="text/javascript"></script>
</head>

<body>
<div class="top-bar">
<div class="wrapper">
<div class="top-profile-box">
<div class="thumb"><img src="<?php echo asset_img("top-profile-img.jpg");?>" alt="image" /></div>
<h1><?php echo ucfirst($this->session->userdata['username']);?></h1>
<div class="top-set-icon" onclick="toogle_div();"><img src="<?php echo asset_img("setting-icon.jpg");?>" alt="setting" /></div>
<div class="top-set-menu" id="branches" style="display:none;">
<div class="tooltip-arrow"></div>
<ul>
<li class="btm-brd"><a href="<?php echo base_url();?>admin">Admin Panel</a></li>
<li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="logo-bar">
<div class="wrapper">
<div class="logo"><a href="#"><img src="<?php echo asset_img("logo.png");?>" alt="Tugboat" border="0" /></a></div>
</div>
</div>
