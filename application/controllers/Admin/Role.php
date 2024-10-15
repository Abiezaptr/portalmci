<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Role Administration';

        // Fetch users with role_id 3, 4, or 5
        $this->db->where_in('role', [3, 4, 5]);
        $data['users'] = $this->db->get('users')->result_array();

        // Fetch permissions for each user
        foreach ($data['users'] as &$user) {
            $permissions = $this->db->get_where('permissions', ['user_id' => $user['id']])->row_array();
            $user['permissions'] = $permissions;
        }

        // Load the views
        $this->load->view('template/cms/header', $data);
        $this->load->view('admin/role_view', $data);
        $this->load->view('template/cms/footer');
    }

    public function update_permissions()
    {
        // Ambil data dari POST
        $user_id = $this->input->post('user_id');
        $permission_type = $this->input->post('permission'); // Tipe permission
        $value = $this->input->post('value');

        // Debug: Pastikan data yang diterima benar
        log_message('debug', 'User ID: ' . $user_id . ' Permission Type: ' . $permission_type . ' Value: ' . $value);

        // Cek apakah user_id valid
        if (!$user_id || !$permission_type) {
            echo json_encode(['status' => 'error', 'message' => 'User ID or Permission Type is missing.']);
            return;
        }

        // Siapkan data untuk diinsert atau diupdate
        $data = [$permission_type => $value];

        // Cek apakah data sudah ada di tabel
        $existing_permission = $this->db->get_where('permissions', ['user_id' => $user_id])->row();

        if ($existing_permission) {
            // Jika data sudah ada, lakukan update
            $this->db->where('user_id', $user_id);
            $this->db->update('permissions', $data);

            if ($this->db->affected_rows() > 0) {
                // Fetch updated permissions
                $updated_permissions = $this->db->get_where('permissions', ['user_id' => $user_id])->row_array();
                // Set updated permissions in session
                $this->session->set_userdata('permissions', $updated_permissions);

                echo json_encode(['status' => 'success', 'message' => 'Permission updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No rows updated.']);
            }
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $user_id; // Tambahkan user_id ke data
            $this->db->insert('permissions', $data);

            if ($this->db->affected_rows() > 0) {
                // Fetch updated permissions
                $updated_permissions = $this->db->get_where('permissions', ['user_id' => $user_id])->row_array();
                // Set updated permissions in session
                $this->session->set_userdata('permissions', $updated_permissions);

                echo json_encode(['status' => 'success', 'message' => 'Permission inserted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to insert permission.']);
            }
        }
    }

}
