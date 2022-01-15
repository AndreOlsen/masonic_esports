<?php
/**
 * The template for displaying the footer
 *
 * @package Masonic
 */
//$footer_divider_url = get_stylesheet_directory_uri() . '/assets/images/waves_bottom.svg';
?>			

		</main>
		
		<svg width="100%" height="100%" id="svg" viewBox="0 0 1440 330" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="shape-divider">
			<path d="M 0,400 C 0,400 0,100 0,100 C 70.9007214015802,96.79079354173824 141.8014428031604,93.58158708347648 201,94 C 260.1985571968396,94.41841291652352 307.6949501889386,98.46444520783236 384,100 C 460.3050498110614,101.53555479216764 565.4187564410855,100.5606320851941 636,106 C 706.5812435589145,111.4393679148059 742.6300240467193,123.29302645139127 812,125 C 881.3699759532807,126.70697354860873 984.0611473720371,118.26726210924082 1062,116 C 1139.938852627963,113.73273789075918 1193.1253864651324,117.63792511164549 1252,116 C 1310.8746135348676,114.36207488835451 1375.4373067674337,107.18103744417726 1440,100 C 1440,100 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="#951b8166"></path>
			<path d="M 0,400 C 0,400 0,200 0,200 C 61.06149089659911,184.5833047062865 122.12298179319822,169.166609412573 190,175 C 257.8770182068018,180.833390587427 332.56956372380625,207.91686705599452 402,216 C 471.43043627619375,224.08313294400548 535.5987633115767,213.16592236344897 615,214 C 694.4012366884233,214.83407763655103 789.0353830298867,227.41944349020955 855,225 C 920.9646169701133,222.58055650979045 958.2597045688765,205.1563036757128 1026,205 C 1093.7402954311235,204.8436963242872 1191.9257986946068,221.9553418069392 1266,224 C 1340.0742013053932,226.0446581930608 1390.0371006526966,213.0223290965304 1440,200 C 1440,200 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="#57009b88"></path>
			<path d="M 0,400 C 0,400 0,300 0,300 C 52.993473033321905,305.70594297492266 105.98694606664381,311.4118859498454 170,312 C 234.0130539333562,312.5881140501546 309.04568876674676,308.05839917554107 384,303 C 458.95431123325324,297.94160082445893 533.830298866369,292.3545173479904 613,293 C 692.169701133631,293.6454826520096 775.6331157677772,300.5235314324974 846,309 C 916.3668842322228,317.4764685675026 973.6372380625214,327.5513569220199 1038,319 C 1102.3627619374786,310.4486430779801 1173.8179319821365,283.27104087942286 1242,277 C 1310.1820680178635,270.72895912057714 1375.0910340089317,285.3644795602886 1440,300 C 1440,300 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="#0c1320ff"></path>
		</svg>
			
		<footer class="site-footer">
				
			<nav class="footer-menus">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-menu-left',
							'container' 	  => 'nav',
							'container_class' => 'menu-left',
						)
					);

					wp_nav_menu(
						array(
							'theme_location'  => 'footer-menu-right',
							'container' 	  => 'nav',
							'container_class' => 'menu-right',
						)
					);
				?>

					
				<?php if ( is_active_sidebar('socials_widget_area')) : ?>
					<div class="socials">
						<?php dynamic_sidebar('socials_widget_area'); ?>
					</div>
				<?php endif; ?>
			</nav>
				
			<section class="copyrights">
				<p>&#169; <?php echo date("Y"); ?> MASONIC All Rights Reserved</p>
			</section>
		</footer><!-- .site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
