<?php


/**
 * User class
 */
class User
{

	use Model;

	protected $table = 'landing_page';

	protected $allowedColumns = [

		'name',
		'email',
		'subject',
		'message',
	];

	public function validate($data)
	{
		$this->errors = [];

		if (empty($data['email'])) {
			$this->errors['email'] = "Email is required";
		} else
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "Email is not valid";
		}

		if (empty($data['name'])) {
			$this->errors['name'] = "name is required";
		}

		if (empty($data['subject'])) {
			$this->errors['subject'] = "subject  is required";
		}

		if (empty($data['message'])) {
			$this->errors['message'] = "message  is required";
		}

		if (empty($this->errors)) {
			return true;
		}

		return false;
	}
}
