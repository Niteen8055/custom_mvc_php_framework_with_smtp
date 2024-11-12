<?php

/**
 * home class
 */
class Home
{
	use Controller;

	public function index()
    {
        // Ensure the form is submitted via POST method
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Fetch form data
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ];

            $contactModel = new Contact;

            // Validate the form data
            if (!$contactModel->validate($data)) {
                // If there are validation errors, return them as a response
                echo json_encode(['status' => 'error', 'message' => $contactModel->errors]);
                return;
            }

            // Check if the email already exists in the database (SQL validation)
            if ($contactModel->emailExists($data['email'])) {
                echo json_encode(['status' => 'error', 'message' => 'This email is already registered.']);
                return;
            }

            // Insert the data into the database
            if ($contactModel->insert($data)) {
                // Send email notification
                require_once 'app/mail/sendEmail.php';
                $mailStatus = sendEmail($data['name'], $data['email'], $data['subject'], $data['message']);
                
                if ($mailStatus) {
                    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.', 'mail_status' => 'Mail sent']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Mail sending failed.', 'mail_status' => 'Mail not sent']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database insertion failed.']);
            }
        } else {
            // If it's a GET request, just show the view
            $this->view('home');
        }
    }


	public function data()
	{
		$data = [];

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$user = new User;
			if ($user->validate($_POST)) {
				$user->insert($_POST);
				redirect('login');
			}

			$data['errors'] = $user->errors;
		}


		$this->view('home', $data);
	}
}
