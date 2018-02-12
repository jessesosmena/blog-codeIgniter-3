<?php

class User_model extends CI_Model
{

	public function temp_register($enc_password, $registration_key)
	{
       
        $data = array(

            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
            'registration_key' => $registration_key
        );

        $query = $this->db->insert('temporary_user', $data);

        if($query)
        {
        	return true;
        }
        else
        {
        	return false;
        }

	}

	public function is_valid_key($registration_key)
	{
		$this->db->where('registration_key', $registration_key);

        $query = $this->db->get('temporary_user');

        if($query->num_rows() == 1)
        {
           return true;
        }
        else
        {
           return false;
        }
	}

	public function register_user($registration_key)
	{
		$this->db->where('registration_key', $registration_key);

        $temporary_user = $this->db->get('temporary_user'); 
        if($temporary_user) 
        {
         	$row = $temporary_user->row(); 

         	$userData = array( 
                
               'id' => $row->id,
               'first_name' => $row->first_name,
               'last_name' => $row->last_name,  
               'username' => $row->username,
               'email' => $row->email, 
               'password' => $row->password,
               'register_date' => $row->created_at
         	);

          
         	$add_user = $this->db->insert('users', $userData);
        }

        if($add_user) 
        { 
         	$this->db->where('registration_key', $registration_key);
         	$this->db->delete('temporary_user');
         	return $userData;
        }
        else
        {
         	return false;
        }
	}


	public function check_username_exists($username)
	{
		$query = $this->db->get_where('users', array('username' => $username));

		if(empty($query->row_array()))
		{
           return true;
		}
		else
		{
           return false;
		}
	}


    public function check_email_exists($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));

		if(empty($query->row_array()))
		{
           return true;
		}
		else
		{
           return false;
		}
	}

	public function login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if($result->num_rows() == 1)
		{
           return $result->row(0)->id; 
		}
		else
		{
           return false;
		}
	}

	public function get_users_info($email, $password)
	{
    $this->db->where('email', $email);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if($result->num_rows() == 1)
		{
           return $result->row_array(); 
		}
		else
		{
           return false;
		}
	}

  public function email_exists()
  {
    $this->db->where('email', $this->input->post('email'));

      $query = $this->db->get('users');

      if($query->num_rows() == 1)
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  public function add_to_users($ResetPassKey)
  {
        $email = $this->input->post('email');
        $user = $this->db->get('users');

         if($user)
         {

            $data = array(

            'reset_password_key' => $ResetPassKey

            );

         $this->db->where("email = '$email'");
         $query = $this->db->update('users', $data);
         
         }

         if($query)
         {
            return true;
         }
         else
         {
            return false;
         }
  }

  public function is_authenticated($ResetPassKey)
  {
      $this->db->select('reset_password_key'); 

      $this->db->where('reset_password_key', $ResetPassKey);

      $query = $this->db->get('users');

      if($query)
      {
        return $query->row(0)->reset_password_key;
      }
      else
      {
        return false;
      }
  }

  public function check_validate_email()
  {
      $this->db->where('email', $this->input->post('email'));

      $query = $this->db->get('users');

      if($query->num_rows() == 1)
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  public function update_password()
  {
      $email = $this->input->post('email');
      $key = $this->db->where('reset_password_key');
      $query = $this->db->get('users');

    if($key) 
    {
        if($query) 
        {
            $data = array(

            'password' => sha1($this->input->post('npassword'))

            );

            $this->db->where("email = '$email'");
            $newPassword = $this->db->update('users', $data);

            if($newPassword) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
          return false;
        }
    }

  }

}