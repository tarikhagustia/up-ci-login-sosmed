<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use League\OAuth2\Client\Provider\Google;

class Oauth extends CI_Controller
{
    /**
     * @links : https://developers.google.com/identity/protocols/oauth2/openid-connect#registeringyourapp
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function google()
    {
        $provider = new Google([
            'clientId'     => '663610916817-crgme4mcpaqn1ui01pifohp90qqd976j.apps.googleusercontent.com',
            'clientSecret' => 'evqVcG_fws11qJQvqogBcWSV',
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

                    var_dump($input);

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
}
