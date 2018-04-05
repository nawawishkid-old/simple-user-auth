<?php
$pages = [
	'dashboard' => 'Dashboard',
	'settings' => 'Settings'
];
?>
<div class="row no-gutters p-3">
	<div class="col-12 col-md-8 p-3">
		<?php include_once empty( $_GET['page'] ) ? 'dashboard.php' : $_GET['page'] . '.php'; ?>
	</div>
	<div class="col-12 col-md-4 p-3">
		<nav>
			<ul class="list-group" style="list-style: none;">
				<?php
					$has_page = isset( $_GET['page'] );
					
					foreach ( $pages as $id => $name ) {
						if ( ! $has_page && $id === 'dashboard' ) {
							$class = 'active';
						} elseif ( $has_page && $id === $_GET['page'] ) {
							$class = 'active';
						} else {
							$class = '';
						}

						echo '<li><a href="?page=' . $id . '" class="list-group-item list-group-item-action ' . $class . '">' . $name . '</a></li>';
					}
				?>
			</ul>
		</nav>
	</div>
</div>