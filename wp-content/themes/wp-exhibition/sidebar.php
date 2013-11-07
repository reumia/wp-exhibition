<?
if(mbt_is_there_sidebar(array('sidebar-left', 'sidebar-center', 'sidebar-right'))) :
?>
<!--[if lte IE 7]><div class=ie7-grid><![endif]-->
<aside class="sidebar-wrapper">
	<div class="gw sidebar">
		<div class="g one-third sidebar__column">
			<div class="g__inner">
				<ul class="sidebar__one"><? dynamic_sidebar( 'sidebar-left' ); ?></ul>
			</div>
		</div>
		<div class="g one-third sidebar__column">
			<div class="g__inner">
				<ul class="sidebar__one"><? dynamic_sidebar( 'sidebar-center' ); ?></ul>
			</div>
		</div>
		<div class="g one-third sidebar__column">
			<div class="g__inner">
				<ul class="sidebar__one"><? dynamic_sidebar( 'sidebar-right' ); ?></ul>
			</div>
		</div>
	</div>
</aside>
<!--[if lte IE 7]></div><![endif]-->
<?
endif; // is_there_sidebar
?>