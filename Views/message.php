<?php include './Views/header.php'; ?>

	<div class="container">
		
		<?php if (isset($_GET['success'])): ?>
			<h4 class = "py-4">Success</h4>
			<div class="alert alert-success pb-2" role="alert">
				<?= $_GET['success'] ?>
			</div>
		<?php endif; ?>

		<?php if (isset($_GET['error'])): ?>
			<h4 class = "py-4">Error</h4>
			<div class="alert alert-danger pb-2" role="alert">
				<?= $_GET['error'] ?>
			</div>
		<?php endif; ?>

		<div class="pt-4">
			<a href="<?= url('/user') ?>">Click here to go home.</a>
		</div>

	</div>

<?php include './Views/footer.php'; ?>
