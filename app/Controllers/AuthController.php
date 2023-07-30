<?php

namespace App\Controllers;

use App\Models\Users;

class AuthController extends BaseController
{
    public function register()
    {
        // Load the form helper and validation library
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'post') {
            // Validate the user input
            $rules = [
                'username' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'password' => 'required|min_length[4]|max_length[50]',
                'password_conf' => 'matches[password]',
                'name' => 'required|min_length[4]|max_length[100]',
            ];

            if (!$this->validate($rules)) {
                // If validation fails, show the registration form with errors
                return view('register', ['validation' => $validation]);
            }

            // Insert the user data into the database
            $users = new Users();
            $users->insert([
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getPost('name')
            ]);

            // Redirect to the login page after successful registration
            return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
        }

        return view('register');
    }

    public function login()
    {
        // Load the form helper and validation library
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'post') {
            // Validate the user input
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                // If validation fails, show the login form with errors
                return view('login', ['validation' => $validation]);
            }

            // Check the user credentials against the database
            $users = new Users();
            $user = $users->where('username', $this->request->getPost('username'))->first();

            if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                // Set user session upon successful login
                $session = session();
                $session->set('logged_in', true);
                $session->set('user_id', $user['id']);
                $session->set('username', $user['username']);
                $session->set('name', $user['name']);

                // Redirect to the dashboard or home page after successful login
                return redirect()->to('/home');
            } else {
                // Show error message for invalid credentials
                $validation->setError('password', 'Invalid credentials');
                return view('login', ['validation' => $validation]);
            }
        }

        return view('login');
    }

    public function logout()
    {
        // Destroy user session and redirect to the login page
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
