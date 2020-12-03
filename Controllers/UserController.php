<?php

class UserController
{
	public function index()
	{
		$title = "Show All Users";

		$userObj = new User;

		$users = $userObj->select()->where('1 ORDER BY id DESC')->get();

		include './Views/user/show.php';
	}

	public function create()
	{
		$title = "Create new User";
		
		if (isset($_POST['submit_user'])) {
			$user = new User;

			$created = $user->create([
				'name' => $_POST['name'],
				'phone' => $_POST['phone'],
				'address' => $_POST['address'],
				'email' => $_POST['email']
			]);

			if ($created) {
				return header("Location: " . url('user/message/?success=User has been created successfully.'));
			}

			return header("Location: " . url('user/message/?error=User couldn\'t be created please try again.'));
		}

		include './Views/user/create.php';
	}

	public function edit()
	{
		$userObj = new User;
		$title = "Edit User";

		$user = $userObj->find($_GET['id']);

		if (isset($_POST['submit_user'])) {
			$user = new User;

			$updated = $user->where('id='. $_GET['id'])->update([
				'name' => $_POST['name'],
				'phone' => $_POST['phone'],
				'address' => $_POST['address'],
				'email' => $_POST['email']
			]);

			if ($updated) {
				return header("Location: " . url('user/message/?success=User has been deleted successfully.'));
			}

			return header("Location: " . url('user/message/?error=User couldn\'t be updated.'));
		}

		include './Views/user/create.php';
	}

	public function delete()
	{
		$userObj = new User;

		$deleted = $userObj->where('id=' . $_GET['id'])->delete();

		if ($deleted) {
			return header("Location: " . url('user/message/?success=User has been deleted successfully.'));
		}
		
		return header("Location: " . url('user/message/?error=User couldn\'t be deleted.'));
	}

	public function message()
	{
		$title = "Show message";

		include './Views/message.php';
	}
}
