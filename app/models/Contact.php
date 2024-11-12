<?php

class Contact
{
    use Model;

    public $table = 'landing_page';
    protected $allowedColumns = ['name', 'email', 'subject', 'message'];
    public $errors = [];  // To store validation errors

    // Method to validate form data
    public function validate($data)
    {
        $this->errors = [];

        // Validate name
        if (empty($data['name'])) {
            $this->errors['name'] = "Name is required";
        }

        // Validate email
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format";
        }

        // Validate subject
        if (empty($data['subject'])) {
            $this->errors['subject'] = "Subject is required";
        }

        // Validate message
        if (empty($data['message'])) {
            $this->errors['message'] = "Message is required";
        }

        // Return true if no validation errors, otherwise return false
        return empty($this->errors);
    }

    // Method to check if email exists
    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE email = :email";
        $result = $this->query($query, ['email' => $email]);

        // Return true if the email exists
        return $result[0]->count > 0;
    }
}
