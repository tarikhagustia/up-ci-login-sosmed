<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Facebook;

class Oauth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->config('oauth');
    }

    /**
     * @links : https://developers.google.com/identity/protocols/oauth2/openid-connect#registeringyourapp
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function google()
    {
        $provider = new Google([
            'clientId'     => $this->config->item('google')['client_id'],
            'clientSecret' => $this->config->item('google')['client_secret'],
            'redirectUri'  => base_url('oauth/google')
        ]);

        if (!empty($_GET['error'])) {

            // Got an error, probably user denied access
            exit('Got error: '.htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));

        } elseif (empty($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            // $_SESSION['oauth2state'] = $provider->getState();
            $this->session->set_userdata('oauth2state', $provider->getState());
            header('Location: '.$authUrl);
            exit;

        } elseif (empty($_GET['state']) || ($_GET['state'] !== $this->session->oauth2state)) {

            // State is invalid, possible CSRF attack in progress
            // unset($_SESSION['oauth2state']);
            $this->session->unset_userdata('oauth2state');
            exit('Invalid state');

        } else {

            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Optional: Now you have a token you can look up a users profile data
            try {

                // We got an access token, let's now get the owner details
                $ownerDetails = $provider->getResourceOwner($token);
                $this->load->model('User_model');
                $name = $ownerDetails->getName();
                $email = $ownerDetails->getEmail();
                $profilePicture = $ownerDetails->getAvatar();

                // Check User if exist
                if ($this->User_model->checkUser($email)) {

                    // Force login user by their email
                    $this->User_model->forceLogin($email);

                    // Redirect to homepage
                    redirect('/');
                } else {
                    // User not found in database, register and force login
                    $input = [
                        'daftar_id'         => null,
                        'daftar_email'      => $email,
                        'verify_code'       => random_int(10, 999999),
                        'daftar_process'    => 'Pending',
                        'daftar_status'     => 'Active',
                        'daftar_c_ip'       => '',
                        'daftar_c_device'   => '',
                        'daftar_c_platfrom' => 'google',
                        'daftar_u_ip'       => '',
                        'daftar_u_device'   => '',
                        'daftar_u_platfrom' => '',
                        'daftar_u_date'     => '',
                        'daftar_platfrom'   => "google",
                        'daftar_sandi'      => '',
                        'daftar_c_by'       => $email,
                        'daftar_c_date'     => date('Y-m-d H:i:s'),
                        'daftar_u_by'       => $email
                    ];


                    $this->User_model->createUser($input);
                    // Force login user by their email
                    $this->User_model->forceLogin($email);

                    // Redirect to homepage
                    redirect('/');

                }

            } catch (Exception $e) {

                // Failed to get user details
                exit('Something went wrong: '.$e->getMessage());

            }

            // // Use this to interact with an API on the users behalf
            // echo $token->getToken();
            //
            // // Use this to get a new access token if the old one expires
            // echo $token->getRefreshToken();
            //
            // // Unix timestamp at which the access token expires
            // echo $token->getExpires();
        }
    }


    public function facebook()
    {
        $provider = new Facebook([
            'clientId'        => $this->config->item('facebook')['client_id'],
            'clientSecret'    => $this->config->item('facebook')['client_secret'],
            'redirectUri'     => base_url('oauth/facebook'),
            'graphApiVersion' => 'v7.0',
        ]);

        if (!isset($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;

// Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $this->session->oauth2state)) {

            $this->session->unset_userdata('oauth2state');
            echo 'Invalid state.';
            exit;

        }

// Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

// Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $provider->getResourceOwner($token);

            // Use these details to create a new profile
            printf('Hello %s!', $user->getFirstName());

            // Insert ke Database
            $this->load->model('User_model');
            $name = $user->getName();
            $email =  $user->getEmail();
            $profilePicture = $user->getPictureUrl();

            // Check User if exist
            if ($this->User_model->checkUser($email)) {

                // Force login user by their email
                $this->User_model->forceLogin($email);

                // Redirect to homepage
                redirect('/');
            } else {
                // User not found in database, register and force login
                $input = [
                    'daftar_id'         => null,
                    'daftar_email'      => $email,
                    'verify_code'       => random_int(10, 999999),
                    'daftar_process'    => 'Pending',
                    'daftar_status'     => 'Active',
                    'daftar_c_ip'       => '',
                    'daftar_c_device'   => '',
                    'daftar_c_platfrom' => 'facebook',
                    'daftar_u_ip'       => '',
                    'daftar_u_device'   => '',
                    'daftar_u_platfrom' => '',
                    'daftar_u_date'     => '',
                    'daftar_platfrom'   => "facebook",
                    'daftar_sandi'      => '',
                    'daftar_c_by'       => $email,
                    'daftar_c_date'     => date('Y-m-d H:i:s'),
                    'daftar_u_by'       => $email
                ];


                $this->User_model->createUser($input);
                // Force login user by their email
                $this->User_model->forceLogin($email);

                // Redirect to homepage
                redirect('/');

            }

        } catch (\Exception $e) {

            // Failed to get user details
            exit('Oh dear...');
        }
    }

    public function instagram()
    {
        $provider = new League\OAuth2\Client\Provider\Instagram([
            'clientId'          => $this->config->item('instagram')['client_id'],
            'clientSecret'      => $this->config->item('instagram')['client_secret'],
            'redirectUri'       => base_url('oauth/instagram'),
            'host'              => 'https://api.instagram.com',  // Optional, defaults to https://api.instagram.com
            'graphHost'         => 'https://graph.instagram.com' // Optional, defaults to https://graph.instagram.com
        ]);

        if (!isset($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $this->session->set_userdata('oauth2state', $provider->getState());
            header('Location: '.$authUrl);
            exit;

// Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $this->session->oauth2state)) {

            $this->session->unset_userdata('oauth2state');
            exit('Invalid state');

        } else {

            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Optional: Now you have a token you can look up a users profile data
            try {

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);

                // Use these details to create a new profile
                printf('Hello %s!', $user->getNickname());

            } catch (Exception $e) {

                // Failed to get user details
                exit('Oh dear...');
            }

            // Use this to interact with an API on the users behalf
            echo $token->getToken();
        }
    }

}
