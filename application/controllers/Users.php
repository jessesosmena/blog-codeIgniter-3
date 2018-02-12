<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function register()
	{
		$data['title'] = "Sign Up";

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_email_exists');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password]');
    $this->form_validation->set_message('is_unique', 'That email address already exists');

		if($this->form_validation->run() === FALSE)
		{
           $this->load->view('templates/header');
           $this->load->view('users/register', $data);
           $this->load->view('templates/footer');
		}
		else
		{

      //generate a random key
           $registration_key = md5(uniqid());
            
            /*
            $config = Array(
           'protocol' => 'smtp',
           'smtp_host' => 'ssl://smtp.gmail.com',
           'smtp_port' => 465, //or 587
           'smtp_timeout' => 7,
           'smtp_user' => 'diximojesse@gmail.com', //your gmail account
           'smtp_pass' => '', //your gmail password
           'mailtype'  => 'html', 
           'charset'   => 'iso-8859-1',
           'wordwrap' => TRUE,
           'newline' => "\r\n"
           );
           */

           //send email
            
           $this->load->library('email');
           $this->email->from('diximojesse@gmail.com', 'Blog in CI3');
           $this->email->to($this->input->post('email'));
           $this->email->subject('Email Confirmation Link');
           $this->email->set_mailtype("html");

           $message = "<div style='background:teal; padding:50px 50px; border-radius:20px;
           <div style='font-size:30px;font-weight:bold;color:white;'>
             <p style='font-size:20px;color:#fff;font-weight:bold'>Thank you for your registration please click the link below to complete your registration</p>
            
           <br /><br />
           <a style='-webkit-border-radius: 4px;
           -moz-border-radius: 4px;
           border-radius: 4px;
           border: solid 1px #1A4575;
           text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
           -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           background: #3A68A1;
           color: #fee1cc;
           text-decoration: none;
           padding: 8px 12px;
           text-decoration: none;
           font-size: larger;
           }'
           href='".base_url()."users/register_user/$registration_key'>Click Here</a>
           </div>
      
           </div>";

           $this->email->message($message);

           if($this->email->send()){
              
              $enc_password = sha1($this->input->post('password'));

              $this->user_model->temp_register($enc_password, $registration_key); // encrypted password

              $this->session->set_flashdata('temporary_registered', 'Confirmation Link was sent to your email to complete your registration');
              redirect('posts');

           }else{
               
              $this->session->set_flashdata('registration_failed', 'Registration failed please try again!');
              redirect('posts');

           }      
		}

	}

	public function check_username_exists($username)
	{
       $this->form_validation->set_message('check_username_exists', 'That username is already taken');

       if($this->user_model->check_username_exists($username))
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
       $this->form_validation->set_message('check_email_exists', 'Email is already taken');

       if($this->user_model->check_email_exists($email))
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
    if($this->user_model->is_valid_key($registration_key)) 
    {
        if($user_id = $this->user_model->register_user($registration_key))
        {
            if($user_id)
            {
                 //Create session
                 $user_data = array(
                     
                     'user_id' => $user_id['id'],
                     'email' => $user_id['email'],
                     'first_name' => $user_id['first_name'],
                     'last_name' => $user_id['last_name'],
                     'email' => $user_id['email'],
                     'username' => $user_id['username'],
                     'created_at' => $user_id['register_date'],
                     'logged_in' => true  
                 );

                 $this->session->set_userdata($user_data);

                 $this->session->set_flashdata('user_loggedin', 'You are Logged In ');
                 redirect('posts');
            }
            else
            {
               $this->session->set_flashdata('login_failed', 'Login is invalid');
                 redirect('users/login');
            } 
        }
    } 
  }


	public function login()
	{
		$data['title'] = "Login";

		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run() === FALSE)
		{
           $this->load->view('templates/header');
           $this->load->view('users/login', $data);
           $this->load->view('templates/footer');
		}
		else
		{
           $email = $this->input->post('email');

           $password = sha1($this->input->post('password'));

           $user_id = $this->user_model->login($email, $password); 
           $user_info = $this->user_model->get_users_info($email, $password);

            if($user_id)
            {
           	  
           	     $user_data = array(
                     
                     'user_id' => $user_id,
                     'email' => $email,
                     'first_name' => $user_info['first_name'],
                     'last_name' => $user_info['last_name'],
                     'email' => $user_info['email'],
                     'username' => $user_info['username'],
                     'created_at' => $user_info['register_date'],
                     'logged_in' => true  
           	     );

           	     $this->session->set_userdata($user_data);

                 $this->session->set_flashdata('user_loggedin', 'You are Logged In ');
                 redirect('posts');
            }
            else
            {
            	 $this->session->set_flashdata('login_failed', 'Login is invalid');
                 redirect('users/login');
            }  
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');

		$this->session->set_flashdata('user_loggedout', 'You are now Logged Out');
		redirect('users/login');
	}

  public function forgot()
  {
    $data['title'] = "Forgot Password";

    $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_email_exists');
  
    if($this->form_validation->run() === FALSE)
    {
           $this->load->view('templates/header');
           $this->load->view('users/forgot', $data);
           $this->load->view('templates/footer');
    }
    else
    {
      //generate a random key
           $ResetPassKey = md5(uniqid());

            $config = Array(
           'protocol' => 'smtp',
           'smtp_host' => 'ssl://smtp.gmail.com',
           'smtp_port' => 465, //or 587
           'smtp_timeout' => 7,
           'smtp_user' => 'diximojesse@gmail.com', //your gmail account
           'smtp_pass' => 'butyok233', //your gmail password
           'mailtype'  => 'html', 
           'charset'   => 'iso-8859-1',
           'wordwrap' => TRUE,
           'newline' => "\r\n"
           );

           //send email
  
           $this->load->library('email');
           $this->email->from('diximojesse@gmail.com', 'Blog in CodeIgniter3');
           $this->email->to($this->input->post('email'));
           $this->email->subject('Reset Password Link');
           $this->email->set_mailtype("html");

           $message = "<div style='background:teal; padding:50px 50px; border-radius:20px;
           <div style='font-size:30px;font-weight:bold;color:white;'>
             <p style='font-size:20px;color:#fff;font-weight:bold'>Click the link below to reset your password.</p>
            
           <br /><br />
           <a style='-webkit-border-radius: 4px;
           -moz-border-radius: 4px;
           border-radius: 4px;
           border: solid 1px #1A4575;
           text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
           -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
           background: #3A68A1;
           color: #fee1cc;
           text-decoration: none;
           padding: 8px 12px;
           text-decoration: none;
           font-size: larger;
           }'
           href='".base_url()."users/reset_password/$ResetPassKey'>Click Here</a>
           </div>
      
           </div>";

           $this->email->message($message);

           if($this->email->send()){
              
              $this->user_model->add_to_users($ResetPassKey); 

              $this->session->set_flashdata('forgot_pass_success', 'Reset Password link was sent to your email');
              redirect('posts');

           }else{
               
              $this->session->set_flashdata('forgot_pass_failed', 'There was an error please try again!');
              redirect('posts');
           }      
    }
  }

  public function email_exists()
  {
    if($this->user_model->email_exists())
      {
        return true;
      }
      else
      {    
        $this->form_validation->set_message('email_exists', '<p class="text-danger error">Please enter a valid email</p>.'); 
        return false;
      }
  }

  public function reset_password($ResetPassKey)
  {
      $data['title'] = "Reset Password";

      $DBResetKey = $this->user_model->is_authenticated($ResetPassKey);

      if($DBResetKey != $ResetPassKey)
      {
          $this->session->set_flashdata('reset_pass_failed', 'There was an error please try again!');
          redirect('users/forgot');
      }
      else
      {
          $this->session->set_flashdata('reset_pass_success', 'You can now reset your password');
          $this->load->view('templates/header');
          $this->load->view('users/reset_password', $data);
          $this->load->view('templates/footer');
      }
  }

  public function reset_password_validation()
  {
      $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_validate_email');
      $this->form_validation->set_rules('npassword', 'New Password', 'required|trim');
      $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[npassword]');

      if($this->form_validation->run())
      {
          $this->session->set_flashdata('reset_pass_update_success', 'Your password has been updated');
          redirect('users/login');
      }
      else
      {
          $this->session->set_flashdata('reset_pass_update_failed', 'There was an error please try again!');
          $this->load->view('templates/header');
          $this->load->view('users/forgot');
          $this->load->view('templates/footer');
      }
  }

  public function check_validate_email()
  {
    if($this->user_model->check_validate_email())
    {
        if($this->user_model->update_password())
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
      $this->form_validation->set_message('check_validate_email', '<p class="text-danger error">Please enter a valid email</p>.'); //sends error message
    }
  }

  public function profile()
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      $this->load->view('templates/header');
      $this->load->view('users/profile');
      $this->load->view('templates/footer');
    }
  }

}