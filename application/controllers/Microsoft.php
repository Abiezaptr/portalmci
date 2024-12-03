<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php'; // Sertakan autoloader Composer
use GuzzleHttp\Client;

class Microsoft extends CI_Controller
{

    private $clientId = 'CLIENT_ID'; // Ganti dengan CLIENT_ID Anda
    private $clientSecret = 'CLIENT_SECRET'; // Ganti dengan CLIENT_SECRET Anda
    private $redirectUri = 'REDIRECT_URI'; // Sesuaikan dengan REDIRECT_URI Anda
    private $authorityUrl = 'https://login.microsoftonline.com/common';
    private $resource = 'https://graph.microsoft.com/';

    public function __construct()
    {
        parent::__construct();
        // Memastikan session sudah tersedia
        $this->load->library('session');
        $this->load->database();
    }

    /**
     * Langkah 1: Redirect pengguna ke halaman login Microsoft
     */
    public function index()
    {
        $state = bin2hex(random_bytes(16)); // Generate state parameter untuk keamanan
        $this->session->set_userdata('auth_state', $state);

        $authUrl = $this->authorityUrl . '/oauth2/v2.0/authorize?' . http_build_query([
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
            'response_mode' => 'query',
            'scope' => 'openid User.Read email profile offline_access',
            'state' => $state,
        ]);

        // Redirect ke Microsoft login page
        redirect($authUrl);
    }

    /**
     * Langkah 2: Tangani Redirect Uri (Authorized)
     */
    public function authorized()
    {
        $code = $this->input->get('code');
        $state = $this->input->get('state');

        // Validasi state untuk keamanan
        if ($state !== $this->session->userdata('auth_state')) {
            show_error('Invalid state parameter', 403);
            return;
        }

        // Tukar authorization code dengan access token
        try {
            // Membuat instance GuzzleHttp Client
            $client = new Client();

            $response = $client->post($this->authorityUrl . '/oauth2/v2.0/token', [
                'form_params' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->redirectUri,
                    'code' => $code,
                ],
            ]);

            $tokenData = json_decode($response->getBody(), true);

            // Gunakan access token untuk mendapatkan data pengguna
            $userResponse = $client->get($this->resource . 'v1.0/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenData['access_token'],
                ],
            ]);

            $userData = json_decode($userResponse->getBody(), true);

            // Ambil givenName dari data pengguna Microsoft
            $givenName = $userData['givenName'];
            $microsoftID = $userData['id'];
            $jobTitle = isset($userData['jobTitle']) ? $userData['jobTitle'] : '';
            $mail = $userData['mail'];

            // Set timezone
            date_default_timezone_set('Asia/Jakarta');

            // Password default
            $password = md5('123'); // Default password

            // Cek apakah pengguna sudah terdaftar
            $user = $this->db->get_where('users', ['microsoft_id' => $microsoftID])->row();

            if ($user) {
                // Jika pengguna sudah terdaftar, perbarui data mereka jika diperlukan
                $dataToUpdate = [
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->db->where('id', $user->id)->update('users', $dataToUpdate);
                $userId = $user->id;
                $role = $user->role;
                $userEmail = $user->email;
            } else {
                // Jika pengguna belum terdaftar, buat pengguna baru
                $newUser = [
                    'username' => $givenName, // Menggunakan givenName
                    'email' => $mail,
                    'password' => $password, // Menyimpan password yang sudah di-hash
                    'microsoft_id' => $microsoftID,
                    'job_title' => $jobTitle,
                    'role' => 2, // Default role
                    'status' => 'NONAKTIF', // Default status
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->db->insert('users', $newUser);
                $userId = $this->db->insert_id();
                $role = 2; // Default role
                $userEmail = $mail;
            }

            // Set session data
            $this->session->set_userdata([
                'id' => $userId,
                'username' => $givenName, // Menggunakan givenName
                'email' => $mail,
                'job_title' => $jobTitle,
                'role' => $role,
                'logged_in' => TRUE
            ]);

            // ** Fetch and set user permissions into session **
            $permissions = $this->db->get_where('permissions', ['user_id' => $userId])->row_array();
            $this->session->set_userdata('permissions', $permissions);

            // // Log the login attempt
            // $this->log_login($userId, $mail, 'Success');

            // Redirect to home
            redirect('home');
        } catch (Exception $e) {
            show_error('Error while fetching access token or user data: ' . $e->getMessage(), 500);
        }
    }
}
