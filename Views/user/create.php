<?php include './Views/header.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-6">
				<h4 class = "py-4">Create New User</h4>
			</div>
			<div class="col-6 py-4 text-right">
				<a href="<?= url('/user') ?>">View All</a>
			</div>
		</div>

		<form method="POST">
			<div class="form-group">
				<div class="row">
					<div class="col-3">Name</div>
					<div class="col-9">
						<input type="text" name = "name" value="<?= isset($user->name) ? $user->name : "" ?>" class = "form-control" autofocus>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-3">Phone</div>
					<div class="col-9">
						<input type="text" name = "phone" value="<?= isset($user->phone) ? $user->phone : "" ?>" class = "form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-3">Address</div>
					<div class="col-9">
						<textarea type="text" name = "address" class = "form-control"><?= isset($user->address) ? $user->address : "" ?></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-3">Email</div>
					<div class="col-9">
						<input type="email" name = "email" value="<?= isset($user->email) ? $user->email : "" ?>" class = "form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-12 text-right">
						<input type="submit" value="Submit" name = "submit_user" class = "btn btn-primary">
					</div>
				</div>
			</div>
		</form>
	</div>

<?php include './Views/footer.php'; ?>
