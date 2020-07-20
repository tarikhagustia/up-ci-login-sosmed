<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function createUser($data)
    {
        return $this->db->insert('daftar', $data);
    }

    /**
     * Check user if exist by email
     * @param $email
     * @return bool
     */
    public function checkUser($email)
    {
        $data = $this->db->get_where('daftar', [
           'daftar_email' => $email
        ]);

        return $data->row_array();
    }

    public function checkUserById($id)
    {
        $data = $this->db->get_where('daftar', [
            'daftar_id' => $id
        ]);

        return $data->row_array();
    }

    public function login($email, $password)
    {
        $email = strtolower($email);
        $row = $this->createUser($email);
        if (!$row)
        {
            return false;
        }

        // Password Check
        $id_users = $row['id_users'];
        $pass = $row['passwd'];
        $rolesku = $row['privillages'];;
        $direct_link = $row['direct_link'];
        $users_lang = $row['users_lang'];

        if (!password_verify($password, $pass)) {
            return false;
        }else{

            //create session
            $sid = session_id();
            $newdata = array(
                // 'username'	=> $username,
                'userku'	=> $id_users,
                'rolesku'	=> $rolesku,
                'sesid'		=> $sid,
                'users_lang'=> $users_lang,
            );
            $this->session->set_userdata($newdata);

            $browser = $_SERVER['HTTP_USER_AGENT'];
            //
            // $sql = "UPDATE users SET last_stamp='".strtotime($config['dateku'])."',last_status='online',last_ip='".$config['ipku']."',last_session='$sid' WHERE users_email='".$mail."' AND users_status='Active';";
            // $query = $this->db->query($sql);

            //input user_log
            // $sql = "INSERT INTO users_log (id_users_log, users_id, privillages, ip, device, log_date,
			// 			        		logged, browser,browser_session)
			// 							VALUES(NULL, '".$mail."', '".$rolesku."', '".$config['ipku']."', '".$config['compku']."', '".$config['dateku']."','IN','$browser','$sid');";
            // $query = $this->db->query($sql);
            // redirect($data['domainku'].$direct_link);
            return true;
        }
    }

    public function forceLogin($email)
    {
        $email = strtolower($email);
        $row = $this->checkUser($email);
        if (!$row)
        {
            return false;
        }

        //create session
        $sid = session_id();
        $newdata = array(
            // 'username'	=> $username,
            'userku'	=> $row['daftar_id'],
            'email' => $row['daftar_email']
        );
        $this->session->set_userdata($newdata);

        $browser = $_SERVER['HTTP_USER_AGENT'];
        //
        // $sql = "UPDATE users SET last_stamp='".strtotime($config['dateku'])."',last_status='online',last_ip='".$config['ipku']."',last_session='$sid' WHERE users_email='".$mail."' AND users_status='Active';";
        // $query = $this->db->query($sql);

        //input user_log
        // $sql = "INSERT INTO users_log (id_users_log, users_id, privillages, ip, device, log_date,
        // 			        		logged, browser,browser_session)
        // 							VALUES(NULL, '".$mail."', '".$rolesku."', '".$config['ipku']."', '".$config['compku']."', '".$config['dateku']."','IN','$browser','$sid');";
        // $query = $this->db->query($sql);
        // redirect($data['domainku'].$direct_link);
        return true;
    }
}
