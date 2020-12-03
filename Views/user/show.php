<?php include './Views/header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<h4 class = "py-4">Show All User</h4>
			</div>
			<div class="col-6 py-4 text-right">
				<a href="<?= url('/user/create') ?>">Create New</a>
			</div>
		</div>

		<table class = "table table-striped">
			<?php foreach ($users as $i => $user): ?>
				<tr>
					<td><?= $user->id ?></td>
					<td><?= $user->name ?></td>
					<td><?= $user->phone ?></td>
					<td><?= $user->email ?></td>
					<td><?= $user->address ?></td>
					<td>
						<a href="<?= url('user/edit/?id='.$user->id) ?>" class = "pr-2">Edit</a>
						<a href="<?= url('user/delete/?id='.$user->id) ?>">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>

	</div>

<?php include './Views/footer.php'; ?>
