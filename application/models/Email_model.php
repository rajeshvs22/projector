<?php
class Email_model extends CI_Model 
{
    function __construct()
    {
            parent::__construct();
    }
    
     
    
    function forgot_password_mail($email){

	$this->db->select('*');
        $this->db->from('users'); 
        $this->db->where('_EMAIL', $email); 
        $query=$this->db->get();		
        $res= $query->row_array();

        if(!empty($res))
        {  
	$this->db->select('*');
        $this->db->from('users'); 
        $this->db->where('_EMAIL', $email); 
        $this->db->where('_STATUS', '1'); 
        $query=$this->db->get();		
        $resact= $query->row_array();

        if(empty($resact))
        { 
        return 'activate';
        exit;
        }

        $user_id=$res['_ID'];
        $user_name=$res['_NAME'];          
        $passwordplain  = 'Re'.rand();
        $newpass['_PASSWORD'] = sha1($passwordplain);
        
        $this->db->where('_ID', $user_id);
        $this->db->update('users', $newpass);
        $subject = 'Reload Forgot Password';
                    $message ='<!doctype html>
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>Reload- Forgot Password Verification</title> 
                                </head>
                                <body style="margin-top:0px;">
                                <!-- Wrapper -->
                                <table width="620" border="0" cellpadding="0" cellspacing="0" align="center" >
                                <tr>
                                <td>    
                                <!-- Start Header-->
                                <table width="620" border="0" cellpadding="0" cellspacing="0" align="center">
                                <tr>
                                <td width="100%" style="">
                                <!-- Logo -->
                                <table border="0" cellpadding="0" cellspacing="0" align="left">
                                <tr>
                                <td style="padding:10px 15px" class="center">
                                <a href=""><img src="'.base_url().'images/logo.png" alt="Logo" border="0" style="width:150px" /></a>
                                </td>
                                </tr>
                                </table><!-- End Logo -->
                                <!-- Nav -->
                                <table border="0" cellpadding="0" cellspacing="0" align="right">
                                <tr>
                                <td class="center" style="font-size: 16px; color: #fff; font-weight: light; text-align: right; font-family: Georgia, Times, serif; line-height: 22px; vertical-align: middle; padding:10px 20px; font-style:italic;background-color:#0087ba;">
                                <span style="text-decoration: none; color: #fff;">Forgot Password Verification</span>
                                </td>
                                </tr>
                                </table><!-- End Nav -->
                                </td>
                                </tr>
                                </table><!-- End Header -->
                                <!-- One Column -->
                                <table width="580" border="0" cellpadding="0" cellspacing="0" align="center">
                                <tr>
                                <td style="font-size: 13px; color: #959595; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:20px; border-top:0px;padding-bottom:2px;">
                                <table>
                                <tr>                                
                                <td valign="middle" style="padding-bottom:5px;"><span href="#" style="text-decoration: none; color: #272727; font-size: 15px; color: #444; font-family:Arial, sans-serif "><b>Dear '.$user_name.',</b></span></td>                                
                                </tr>
                                <tr>                                
                                <td valign="middle" style="padding-bottom:5px;"><span href="#" style="text-decoration: none; color: #272727; font-size: 15px; color: #444; font-family:Arial, sans-serif "><b></b></span></td>                                
                                </tr>
                                <tr>
                                <td valign="middle"><span href="#" style="text-decoration: none;font-size: 15px; color: #6D6D6D; font-family:Arial, sans-serif;margin-top:15px;">Kindly check your new password '.$passwordplain.'</span>
                                </td>
                                </tr>                            
                                </table>
                                <div style="height:15px">&nbsp;</div><!-- spacer -->
                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="center" style="line-height:26px;font-family:Arial, sans-serif; margin-top:15px;">
                                <tr>
                                <td data-bgcolor="" style=" font-size: 16px; color: #0087ba; line-height:24px; border-radius:4px" height="50" valign="middle" width="300" align="center" >
                              
                                </td>
                                </tr>
                                </table>
                                <table style="height:0px">&nbsp;</table><!-- spacer -->
                                <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="text-align: center;border-top: 1px solid #0087ba;line-height:24px;">
                                <tr>
                                <td style="padding: 10px;">&copy;2017 Reload. All rights reserved</td>
                                </tr>
                                </table>
                                </td>
                                </tr>              
                                </table><!-- End One Column -->
                                <!-- 2 Column Images & Text Side by SIde -->
                                <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#202022" style="background:#202022;">
                                <tr>
                                <td style="background:#444;"></td>
                                </tr>                
                                </table><!-- End 2 Column Images & Text Side by SIde -->
                                </td>
                                </tr>
                                </table> <!-- End Wrapper -->
                                </body>
                                </html>
                                ';
                          $mail = $email;
                          $header = "From:vijaya@aryvart.com \r\n";
                          $header .= "MIME-Version: 1.0\r\n";
                          $header .= "Content-type: text/html\r\n";

                          if(mail($mail,$subject,$message,$header)){
                           return 'success'; 
                          }
                }
                else{
                           return 'fails'; 
                    }

    }    
   
 }	