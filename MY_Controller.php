<?php
/**
 * -----------------------------IMPORTANT-------------------------------
 * Programmer should NOT change or add any code without having a better
 * understanding how MY_CONTROLLER and Its methods been used
 * ---------------------------------------------------------------------
 *
 * My_Controller will be used for all the CRUD operations in the system.
 *
 * All the other models should be extend form My_Model
 * Most of the common operations been written in the My_Model so that
 * programmer can easily call methods in My_Model Class for all most
 * all Database Communication and minimize the coding in their projects.
 *
 */
class MY_Controller extends CI_Controller
{
    function __construct(){
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name').'dsfdsf';
    }
    /**
     * this function will be called to send emails with
     *
     * @param  Integer      $perPage    feild name of the databse which reqired to be displayed in the value section in dropdown list.
     * @param  Integer      $pageNumber feild name of the databse which reqired to be displayed in the value section in dropdown list.
     * @param  STDObject    $where      if additional query required it should be provided as STDObject example Array('country_name)'=>'Sri Lanka')
     * @param  Text         $AsOrder    if additional query required it should be provided as STDObject example Array('country_name)'=>'Sri Lanka')
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return row / all rows in the specific table
     */
    public function sendEmail($to, $subject, $message, $fromEmail = 'noreply@mail.com' , $fromName = "Test Notification")
    {
        //$this->load->library('email', $this->emailConfig);
        // 'crmdemo@openarconline.com';
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($fromEmail, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * this function will be called to send MASS emails
     *
     * @param  Integer      $perPage    feild name of the databse which reqired to be displayed in the value section in dropdown list.
     * @param  Integer      $pageNumber feild name of the databse which reqired to be displayed in the value section in dropdown list.
     * @param  STDObject    $where      if additional query required it should be provided as STDObject example Array('country_name)'=>'Sri Lanka')
     * @param  Text         $AsOrder    if additional query required it should be provided as STDObject example Array('country_name)'=>'Sri Lanka')
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return row / all rows in the specific table
     */
    public function sendMassEmail($to, $subject, $message, $fromEmail = "noreply@mail.com", $fromName = "Test Notification")
    {
        foreach($to as $recipient)
        {
            if($this->sendEmail($recipient, $subject, $message, $fromEmail, $fromName)){
                //echo 'Email Send';
            }else{
                //echo 'NOT Send';
            }
        }
    }
    public function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }
        else {
            $array = $object;
        }
        return $array;
    }
}