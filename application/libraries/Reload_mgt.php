<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reload_mgt {
    
    var $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    public function getPackageDuration(){
        
        return array('' => '-Select-','2'=>'1 year');
    }
    
    public function getPaymentMode(){
        
        return array('' => '-Select-','1'=>'DD','2'=>'Bank Transaction','3'=>'Cash');
    }
    
    public function backend_search($search , $createdOn , $likeArray = array()){
        
        $from = '';
        $to = '';
        
        $CI =   &get_instance();
         
        if(isset($search['datepickerDateFrom']) && $search['datepickerDateFrom'] != ''){
            $from = date('Y-m-d' , strtotime( str_replace('/', '-', $search['datepickerDateFrom']) ));
        }
        if(isset($search['datepickerDateTo']) && $search['datepickerDateTo'] != ''){
            $to = date('Y-m-d' , strtotime( str_replace('/', '-', $search['datepickerDateTo']) ));
        }
       

        if($from != '' && $to != ''){
            $f = $from.' 00:00:00';
            $t = $to.' 23:59:59';
            $CI->db->where($createdOn .' >=', $f );   
            $CI->db->where($createdOn .' <=', $t );

        }else if($from != ''){
            $f = $from.' 00:00:00';
            $t = $from.' 23:59:59';
            $CI->db->where($createdOn .' >=', $f );   
            $CI->db->where($createdOn .' <=', $t );

        }else if($to != ''){
            $f = $to.' 00:00:00';
            $t = $to.' 23:59:59';
            $CI->db->where($createdOn .' >=', $f );   
            $CI->db->where($createdOn .' <=', $t );
        }
        
       $like = '';
       if(isset($search['keyword']) && $search['keyword'] != '')
        {
           if(!empty($likeArray)){
               $flag = true;
               foreach ($likeArray as $value) {
                   if($flag){
                        $like .= $value ." LIKE '%".trim($search['keyword'])."%' ";
                   }else{
                       $like .= " OR ". $value ." LIKE '%".trim($search['keyword'])."%' ";
                   }
                   $flag = false;
                }
                $CI->db->where('('.$like.')');
           }
        }
    }
    
    
    public function createFolder($path){
        
        $dirPath = $path;
        
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755);
        }
    }
    
    public function check_id($id,$childTabel,$find){
        $CI = get_instance();
        $CI->db->from($childTabel);
        $CI->db->where($find, $id);

        $count = $CI->db->count_all_results();

        if ($count > 0)
        {
         return true;
        }
        else
        {
         return false;
        }
    }
    
    public function get_count($id,$tabelName,$find){
        $CI = get_instance();
        $CI->db->from($tabelName);
        $CI->db->where($find, $id);

        $count = $CI->db->count_all_results();

        if ($count > 0)
        {
         return true;
        }
        else
        {
         return false;
        }
    }
    
    public function delete_row($id,$tabelName,$find){
        $CI = get_instance();
        $CI->db->where($find, $id);
        $CI->db->delete($tabelName);
    }
    
    public function getClassNumber($class){
        $class = strtolower($class);
        
        $classArr = $this->classNumberArray();
        
        return $classArr[$class];
    }
    

    
    
    public function getResidentioalList(){
        
        return array('' => '-Select-','Apartment/Condo'=>'Apartment/Condo' ,'Landed House' => 'Landed House' , 'HDB' => 'HDB');
    }
    public function getPreferenceGender(){
        
        return array('' => '-Select-','Any'=>'Any' ,'Male' => 'Male' , 'Female' => 'Female');
    }
    public function getGender(){
        
        return array('' => '-Select-','Male' => 'Male' , 'Female' => 'Female');
    }
    public function getlessonPerMonth(){
        
        return array('' => '-Select-','4' => '4' , '8' => '8', '12' => '12', '16' => '16', '20' => '20');
    }
    public function getlessonPerHour(){
        
        return array('' => '-Select-','1.5' => '1.5' , '2' => '2', '2.5' => '2.5', '3' => '3');
    }
    public function getPreferenceTutorQualification(){
        return array('' => '-Select-','1' => 'Undergraduate' , '2' => 'Graduate', '3' => 'NIE Trainee', '4' => 'MOE Trained');
    }
    public function getKnowUsStudent(){
        return array(
                    '' => '-Select-',
                    'You Are Our Existing Client' => " I'm your existing client"    ,
                    'Referred By Someone' => 'Referred By Someone',
                    'Newspapers' => 'Newspapers',
                    'Flyers' => 'Flyers',
                    'Facebook' => 'Facebook',
                    'Yahoo' => 'Yahoo',
                    'Google' => 'Google ',
                    'Bing' => 'Bing',
                    'Others' => 'Others'
                );
    }
    

    

    /*
     * 
    */
    function search_html(
            $location_level_list,
            $location_level_id,
            $subject_group_list,
            $location_group_id,
            $subject_level_list,
            $subject_level_id,
            $location_group_list,
            $subject_group_id,
            $race_list,
            $race_id,
            $gender_list,
            $gender_id
            ){
        $location_level = form_dropdown('location_level_id', $location_level_list, set_value('location_level_id', $location_level_id), 'id="location_level_id" class=" col-md-12"  data-toggle="select2"  data-allow-clear="true"');
        $location_group = form_dropdown('location_group_id', $location_group_list, set_value('location_group_id', $location_group_id), 'id="location_group_id" class="col-md-12 selectpicker" ');
        $subject_level  = form_dropdown('subject_level_id', $subject_level_list,set_value('subject_level_id', $subject_level_id), 'id="subject_level_id" class=" col-md-12"  data-toggle="select2"  data-allow-clear="true"');
        $subject_group  = form_dropdown('subject_group_id', $subject_group_list,set_value('subject_group_id', $subject_group_id), 'id="subject_group_id" class=" col-md-12 selectpicker"  ');
        $race           = form_dropdown('race_id', $race_list, set_value('race_id', $race_id), 'id="race_id" class=" col-md-12"  data-toggle="select2"  data-allow-clear="true"');
        $gender_list1   = form_dropdown('gender_id', $gender_list, set_value('gender_id', $gender_id), 'id="gender_id" class=" col-md-12"  data-toggle="select2"  data-allow-clear="true"');
        
        ?>
        <form action="<?php echo current_url(); ?>" method="post" id="search" name="search">
            <div class="row">      
                <div class="form-group col-md-4">
                        <label for="location_level_id" class="col-md-2 control-label">Location</label>
                        <div class="col-md-8" style="padding: 0px;">
                            <div class="row"><?php echo $location_level; ?></div>
                        </div>
                </div>
                <div class="form-group  col-md-4">
                    <label for="subject_level_id" class="col-md-2 control-label">Subject</label>
                    <div class="col-md-8" style="padding: 0px;">
                        <div class="row"><?php echo $subject_level; ?></div>
                    </div>
                </div>
                <div class="form-group  col-md-4">
                    <label for="race_id" class="col-md-2 control-label">Race</label>
                    <div class="col-md-8" style="padding: 0px;">
                        <div class="row"><?php echo $race; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group  col-md-4">
                    <label for="location_group" class="col-md-2 control-label">Location Group</label>
                    <div class="col-md-8" style="padding: 0px;">
                        <div class="row"><?php echo $location_group; ?></div>
                    </div>
                </div>
                <div class="form-group  col-md-4">
                    <label for="subject_group" class="col-md-2 control-label">Subject Group</label>
                    <div class="col-md-8" style="padding: 0px;">
                        <div class="row"><?php echo $subject_group; ?></div>
                    </div>
                </div>
                <div class="form-group  col-md-4">
                    <label for="gender_id" class="col-md-2 control-label">Gender</label>
                    <div class="col-md-8" style="padding: 0px;">
                        <div class="row"><?php echo $gender_list1; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group  col-md-4">

                </div>
                <div class="form-group  col-md-4">

                </div>
                <div class="form-group  col-md-4"  style="text-align: right;">
                    <input type="submit" name="submit" value="Search" id="search_but" class="btn btn-primary"/>
                    <input type="reset" name="reset" value="reset" id="reset" class="btn btn-primary" style="margin-right: 20px; margin-left: 20px;" />
                </div>
            </div>
        </form>
        <?php
    }
  function render_mens_html() {
?>
                                    <div class="table-responsive">
                                       <table class="table table-striped table-bordered table-hover">
                                          <thead>
                                             <tr>
                                                <th rowspan="2"></th>
                                                <th class="th-dim" colspan="2"> Chest <i class="icon-question-sign"></i> </th>
                                                <th class="th-dim" colspan="2"> Waist <i class="icon-question-sign"></i> </th>
                                                <th class="th-dim" colspan="2"> Neck <i class="icon-question-sign"></i> </th>
                                                <th class="th-dim" colspan="2"> Sleeve <i class="icon-question-sign"></i> </th>
                                             </tr>
                                             <tr>
                                                <th class="th-unit">Centimeters</th>
                                                <th class="th-unit">Inches</th>
                                                <th class="th-unit">Centimeters</th>
                                                <th class="th-unit">Inches</th>
                                                <th class="th-unit">Centimeters</th>
                                                <th class="th-unit">Inches</th>
                                                <th class="th-unit">Centimeters</th>
                                                <th class="th-unit">Inches</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td> 
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="XS" display-name="XS" type="checkbox"> XS </label> 
                                                </td>
                                                <td>76 - 81 (cm)</td>
                                                <td>30" - 32"</td>
                                                <td>61 - 66 (cm)</td>
                                                <td>24" - 26"</td>
                                                <td>33 - 34 (cm)</td>
                                                <td>13" - 13.5"</td>
                                                <td>79 - 81 (cm)</td>
                                                <td>31" - 32"</td>
                                             </tr>
                                             <tr>
                                                <td> 
                                                   <label> 
                                                   <input class="sizes-row-checkbox" name="S" display-name="S" type="checkbox"> S </label> 
                                                </td>
                                                <td>86 - 91 (cm)</td>
                                                <td>34" - 36"</td>
                                                <td>71 - 76 (cm)</td>
                                                <td>28" - 30"</td>
                                                <td>36 - 37 (cm)</td>
                                                <td>14" - 14.5"</td>
                                                <td>81 - 84 (cm)</td>
                                                <td>32" - 33"</td>
                                             </tr>
                                             <tr>
                                                <td>  
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="M" display-name="M" type="checkbox"> M </label> 
                                                </td>
                                                <td>97 - 102 (cm)</td>
                                                <td>38" - 40"</td>
                                                <td>81 - 86 (cm)</td>
                                                <td>32" - 34"</td>
                                                <td>38 - 39 (cm)</td>
                                                <td>15" - 15.5"</td>
                                                <td>84 - 86 (cm)</td>
                                                <td>33" - 34"</td>
                                             </tr>
                                             <tr>
                                                <td>  
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="L" display-name="L" type="checkbox"> L </label> 
                                                </td>
                                                <td>107 - 112 (cm)</td>
                                                <td>42" - 44"</td>
                                                <td>91 - 97 (cm)</td>
                                                <td>36" - 38"</td>
                                                <td>41 - 42 (cm)</td>
                                                <td>16" - 16.5"</td>
                                                <td>86 - 89 (cm)</td>
                                                <td>34" - 35"</td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="XL" display-name="XL" type="checkbox"> XL </label> 
                                                </td>
                                                <td>117 - 122 (cm)</td>
                                                <td>46" - 48"</td>
                                                <td>102 - 107 (cm)</td>
                                                <td>40" - 42"</td>
                                                <td>43 - 44 (cm)</td>
                                                <td>17" - 17.5"</td>
                                                <td>89 - 91 (cm)</td>
                                                <td>35" - 36"</td>
                                             </tr>
                                             <tr>
                                                <td> 
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="XXL" display-name="XXL" type="checkbox"> XXL </label> 
                                                </td>
                                                <td>127 - 132 (cm)</td>
                                                <td>50" - 52"</td>
                                                <td>112 - 117 (cm)</td>
                                                <td>44" - 46"</td>
                                                <td>46 - 47 (cm)</td>
                                                <td>18" - 18.5"</td>
                                                <td>91 - 94 (cm)</td>
                                                <td>36" - 37"</td>
                                             </tr>
                                             <tr>
                                                <td> 
                                                   <label> <input class="sizes-row-checkbox" name="XXXL" display-name="XXXL" type="checkbox"> XXXL </label> 
                                                </td>
                                                <td>137 - 142 (cm)</td>
                                                <td>54" - 56"</td>
                                                <td>122 - 127 (cm)</td>
                                                <td>48" - 50"</td>
                                                <td>48 - 50 (cm)</td>
                                                <td>19" - 19.5"</td>
                                                <td>94 - 97 (cm)</td>
                                                <td>37" - 38"</td>
                                             </tr>
                                             <tr>
                                                <td>  <label> <input class="sizes-row-checkbox" name="XXXXL" display-name="XXXXL" type="checkbox"> XXXXL </label> 
                                                </td>
                                                <td>147 - 152 (cm)</td>
                                                <td>58" - 60"</td>
                                                <td>132 - 137 (cm)</td>
                                                <td>52" - 54"</td>
                                                <td>51 - 52 (cm)</td>
                                                <td>20" - 20.5"</td>
                                                <td>97 - 99 (cm)</td>
                                                <td>38" - 39"</td>
                                             </tr>
                                             <tr>
                                                <td> 
                                                   <label>
                                                   <input class="sizes-row-checkbox" name="XXXXXL" display-name="XXXXXL" type="checkbox"> XXXXXL </label> 
                                                </td>
                                                <td>157 - 163 (cm)</td>
                                                <td>62" - 64"</td>
                                                <td>142 - 147 (cm)</td>
                                                <td>56" - 58"</td>
                                                <td>53 - 55 (cm)</td>
                                                <td>21" - 21.5"</td>
                                                <td>99 - 102 (cm)</td>
                                                <td>39" - 40"</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
<?php

  }
  function render_womens_html() {

    ?>
<table class="table table-striped table-bordered table-hover"> <thead> <tr> <th rowspan="2"></th>  <th class="th-dim" colspan="2"> Bust/Chest <i class="icon-question-sign"></i> </th>  <th class="th-dim" colspan="2"> Waist <i class="icon-question-sign"></i> </th>  <th class="th-dim" colspan="2"> Hip <i class="icon-question-sign"></i> </th>  </tr> <tr>  <th class="th-unit">Centimeters</th> <th class="th-unit">Inches</th>  <th class="th-unit">Centimeters</th> <th class="th-unit">Inches</th>  <th class="th-unit">Centimeters</th> <th class="th-unit">Inches</th>  </tr></thead> <tbody>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="XXS" display-name="XXS" type="checkbox"> XXS </label>  </td>  <td>80 - 83 (cm)</td> <td>31.5" - 32.5"</td>  <td>60 - 62 (cm)</td> <td>23.5" - 24.5"</td>  <td>86 - 89 (cm)</td> <td>34" - 35"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="XS" display-name="XS" type="checkbox"> XS </label>  </td>  <td>83 - 85 (cm)</td> <td>32.5" - 33.5"</td>  <td>62 - 65 (cm)</td> <td>24.5" - 25.5"</td>  <td>89 - 91 (cm)</td> <td>35" - 36"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="S" display-name="S" type="checkbox"> S </label>  </td>  <td>85 - 88 (cm)</td> <td>33.5" - 34.5"</td>  <td>65 - 67 (cm)</td> <td>25.5" - 26.5"</td>  <td>91 - 94 (cm)</td> <td>36" - 37"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="M" display-name="M" type="checkbox"> M </label>  </td>  <td>90 - 93 (cm)</td> <td>35.5" - 36.5"</td>  <td>70 - 72 (cm)</td> <td>27.5" - 28.5"</td>  <td>97 - 99 (cm)</td> <td>38" - 39"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="L" display-name="L" type="checkbox"> L </label>  </td>  <td>97 - 100 (cm)</td> <td>38" - 39.5"</td>  <td>76 - 80 (cm)</td> <td>30" - 31.5"</td>  <td>103 - 107 (cm)</td> <td>40.5" - 42"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="XL" display-name="XL" type="checkbox"> XL </label>  </td>  <td>104 - 109 (cm)</td> <td>41" - 43"</td>  <td>84 - 88 (cm)</td> <td>33" - 34.5"</td>  <td>110 - 116 (cm)</td> <td>43.5" - 45.5"</td>  </tr>   <tr> <td>  <label> <input class="sizes-row-checkbox" name="XXL" display-name="XXL" type="checkbox"> XXL </label>  </td>  <td>110 - 116 (cm)</td> <td>43.5" - 45.5"</td>  <td>91 - 95 (cm)</td> <td>36" - 37.5"</td>  <td>116 - 123 (cm)</td> <td>45.5" - 48.5"</td>  </tr>  </tbody> </table>
    <?php
  }

  function render_infrant_child_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>

                                                                                                                                                           
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>

                                                                                                                                                           
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>

                                                                                                                                                           
                                    </div>                                    
                                 </div>
    <?php 
  }

  function rendar_infrant_child_shoes_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                                                                                              
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                                                                                                
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                                                                                                                                          
                                    </div>                                    
                                 </div>
    <?php 
  }
  function rendar_numbers_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>                                       
                                                                                                                                                         
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>                                       

                                                                                                                                                           
                                    </div>                                    
                                 </div>
    <?php 
  }

  function rendar_bras_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>                                                                              
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>                                                                                                                   
                                                                                                                                                         
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  

                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>                                                                            

                                                                                                                                                           
                                    </div>                                    
                                 </div>
    <?php 
  }


  function render_men_shoe_html()
  {

    ?>
    <table class="table table-striped table-bordered table-hover"> <thead>  <tr> <th colspan="2"></th> <th colspan="2" class="th-dim"> Length of Foot </th> </tr> <tr> <th>US Size</th> <th>European</th> <th class="th-unit">Inches</th> <th class="th-unit">Centimeters</th> </tr>  </thead> <tbody>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="6" display-name="6" type="checkbox"> 6 </label> </td>  <td>39</td>  <td>9.25"</td>  <td>23.5 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="6.5" display-name="6.5" type="checkbox"> 6.5 </label> </td>  <td>39</td>  <td>9.5"</td>  <td>24.1 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="7" display-name="7" type="checkbox"> 7 </label> </td>  <td>40</td>  <td>9.625"</td>  <td>24.4 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="7.5" display-name="7.5" type="checkbox"> 7.5 </label> </td>  <td>40 - 41</td>  <td>9.75"</td>  <td>24.8 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="8" display-name="8" type="checkbox"> 8 </label> </td>  <td>41</td>  <td>9.9375"</td>  <td>25.4 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="8.5" display-name="8.5" type="checkbox"> 8.5 </label> </td>  <td>41 - 42</td>  <td>10.125"</td>  <td>25.7 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="9" display-name="9" type="checkbox"> 9 </label> </td>  <td>42</td>  <td>10.25"</td>  <td>26 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="9.5" display-name="9.5" type="checkbox"> 9.5 </label> </td>  <td>42 - 43</td>  <td>10.4375"</td>  <td>26.7 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="10" display-name="10" type="checkbox"> 10 </label> </td>  <td>43</td>  <td>10.5625"</td>  <td>27 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="10.5" display-name="10.5" type="checkbox"> 10.5 </label> </td>  <td>43 - 44</td>  <td>10.75"</td>  <td>27.3 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="11" display-name="11" type="checkbox"> 11 </label> </td>  <td>44</td>  <td>10.9375"</td>  <td>27.9 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="11.5" display-name="11.5" type="checkbox"> 11.5 </label> </td>  <td>44 - 45</td>  <td>11.125"</td>  <td>28.3 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="12" display-name="12" type="checkbox"> 12 </label> </td>  <td>45</td>  <td>11.25"</td>  <td>28.6 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="13" display-name="13" type="checkbox"> 13 </label> </td>  <td>46</td>  <td>11.5625"</td>  <td>29.4 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="14" display-name="14" type="checkbox"> 14 </label> </td>  <td>47</td>  <td>11.875"</td>  <td>30.2 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="15" display-name="15" type="checkbox"> 15 </label> </td>  <td>48</td>  <td>12.1875"</td>  <td>31 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="16" display-name="16" type="checkbox"> 16 </label> </td>  <td>49</td>  <td>12.5"</td>  <td>31.8 (cm)</td>   </tr>  </tbody> </table>
    <?php
  }

  function render_womens_shoe_html() {

    ?>
<table class="table table-striped table-bordered table-hover"> <thead>  <tr> <th colspan="2"></th> <th colspan="2" class="th-dim"> Length of Foot </th> </tr> <tr> <th>US Size</th> <th>European</th> <th class="th-unit">Inches</th> <th class="th-unit">Centimeters</th> </tr>  </thead> <tbody>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="4" display-name="4" type="checkbox"> 4 </label> </td>  <td>35</td>  <td>8.1875"</td>  <td>20.8 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="4.5" display-name="4.5" type="checkbox"> 4.5 </label> </td>  <td>35</td>  <td>8.375"</td>  <td>21.3 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="5" display-name="5" type="checkbox"> 5 </label> </td>  <td>35 - 36</td>  <td>8.5"</td>  <td>21.6 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="5.5" display-name="5.5" type="checkbox"> 5.5 </label> </td>  <td>36</td>  <td>8.75"</td>  <td>22.2 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="6" display-name="6" type="checkbox"> 6 </label> </td>  <td>36 - 37</td>  <td>8.875"</td>  <td>22.5 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="6.5" display-name="6.5" type="checkbox"> 6.5 </label> </td>  <td>37</td>  <td>9.0625"</td>  <td>23 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="7" display-name="7" type="checkbox"> 7 </label> </td>  <td>37 - 38</td>  <td>9.25"</td>  <td>23.5 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="7.5" display-name="7.5" type="checkbox"> 7.5 </label> </td>  <td>38</td>  <td>9.375"</td>  <td>23.8 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="8" display-name="8" type="checkbox"> 8 </label> </td>  <td>38 - 39</td>  <td>9.5"</td>  <td>24.1 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="8.5" display-name="8.5" type="checkbox"> 8.5 </label> </td>  <td>39</td>  <td>9.6875"</td>  <td>24.6 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="9" display-name="9" type="checkbox"> 9 </label> </td>  <td>39 - 40</td>  <td>9.875"</td>  <td>25.1 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="9.5" display-name="9.5" type="checkbox"> 9.5 </label> </td>  <td>40</td>  <td>10"</td>  <td>25.4 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="10" display-name="10" type="checkbox"> 10 </label> </td>  <td>40 - 41</td>  <td>10.1875"</td>  <td>25.9 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="10.5" display-name="10.5" type="checkbox"> 10.5 </label> </td>  <td>41</td>  <td>10.3125"</td>  <td>26.2 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="11" display-name="11" type="checkbox"> 11 </label> </td>  <td>41 - 42</td>  <td>10.5"</td>  <td>26.7 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="11.5" display-name="11.5" type="checkbox"> 11.5 </label> </td>  <td>42</td>  <td>10.6875"</td>  <td>27.1 (cm)</td>   </tr>  <tr>  <td> <label> <input class="sizes-row-checkbox" name="12" display-name="12" type="checkbox"> 12 </label> </td>  <td>42 - 43</td>  <td>10.875"</td>  <td>27.6 (cm)</td>   </tr>  </tbody> </table>
    <?php 
  }

    function rendar_shoes_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>                                                                              
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>  
                                                                                                                 
                                                                                                                                                         
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  

                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                                                                                                  

                                                                                                                                                           
                                    </div>                                    
                                 </div>
    <?php 
  }
 function rendar_macbooks_html() {
    ?>
                                 <div class="shipped">
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  

                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>                                                                            
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  

                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                                                                                                 
                                                                                                                                                         
                                    </div>
                                    <div class="col-md-4">
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>  

                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">21</label>
                                       </div>
                                       <div class="checkbox">
                                          <label><input type="checkbox" value="">Newborn</label>
                                       </div>

                                                                                                                  

                                                                                                                                                           
                                    </div>                                    
                                 </div>
    <?php 
  }

 /*
 *
 *Color Code
 */   
 public function get_color_code(){
      $color = Array
(
    '1' => Array
        (
            'color_name' => 'cloudy blue',
            'color_code' => 'rgb(172, 194, 217)'
        ),

    '2' => Array
        (
            'color_name' => 'dark pastel green
            ','color_code' => 'rgb(86, 174, 87)'
        ),

    '3' => Array
        (
            'color_name' => 'dust
            ','color_code' => 'rgb(178, 153, 110)'
        ),

    '4' => Array
        (
            'color_name' => 'electric lime
            ','color_code' => 'rgb(168, 255, 4)'
        ),

    '5' => Array
        (
            'color_name' => 'fresh green
            ','color_code' => 'rgb(105, 216, 79)'
        ),

    '6' => Array
        (
            'color_name' => 'light eggplant
            ','color_code' => 'rgb(137, 69, 133)'
        ),

    '7' => Array
        (
            'color_name' => 'nasty green
            ','color_code' => 'rgb(112, 178, 63)'
        ),

    '8' => Array
        (
            'color_name' => 'really light blue
            ','color_code' => 'rgb(212, 255, 255)'
        ),

    '9' => Array
        (
            'color_name' => 'tea
            ','color_code' => 'rgb(101, 171, 124)'
        ),

    '10' => Array
        (
            'color_name' => 'warm purple
            ','color_code' => 'rgb(149, 46, 143)'
        ),

    '11' => Array
        (
            'color_name' => 'yellowish tan
            ','color_code' => 'rgb(252, 252, 129)'
        ),

    '12' => Array
        (
            'color_name' => 'cement
            ','color_code' => 'rgb(165, 163, 145)'
        ),

    '13' => Array
        (
            'color_name' => 'dark grass green
            ','color_code' => 'rgb(56, 128, 4)'
        ),

    '14' => Array
        (
            'color_name' => 'dusty teal
            ','color_code' => 'rgb(76, 144, 133)'
        ),

    '15' => Array
        (
            'color_name' => 'grey teal
            ','color_code' => 'rgb(94, 155, 138)'
        ),

    '16' => Array
        (
            'color_name' => 'macaroni and cheese
            ','color_code' => 'rgb(239, 180, 53)'
        ),

    '17' => Array
        (
            'color_name' => 'pinkish tan
            ','color_code' => 'rgb(217, 155, 130)'
        ),

    '18' => Array
        (
            'color_name' => 'spruce
            ','color_code' => 'rgb(10, 95, 56)'
        ),

    '19' => Array
        (
            'color_name' => 'strong blue
            ','color_code' => 'rgb(12, 6, 247)'
        ),

    '20' => Array
        (
            'color_name' => 'toxic green
            ','color_code' => 'rgb(97, 222, 42)'
        ),

    '21' => Array
        (
            'color_name' => 'windows blue
            ','color_code' => 'rgb(55, 120, 191)'
        ),

    '22' => Array
        (
            'color_name' => 'blue blue
            ','color_code' => 'rgb(34, 66, 199)'
        ),

    '23' => Array
        (
            'color_name' => 'blue with a hint of purple
            ','color_code' => 'rgb(83, 60, 198)'
        ),

    '24' => Array
        (
            'color_name' => 'booger
            ','color_code' => 'rgb(155, 181, 60)'
        ),

    '25' => Array
        (
            'color_name' => 'bright sea green
            ','color_code' => 'rgb(5, 255, 166)'
        ),

    '26' => Array
        (
            'color_name' => 'dark green blue
            ','color_code' => 'rgb(31, 99, 87)'
        ),

    '27' => Array
        (
            'color_name' => 'deep turquoise
            ','color_code' => 'rgb(1, 115, 116)'
        ),

    '28' => Array
        (
            'color_name' => 'green teal
            ','color_code' => 'rgb(12, 181, 119)'
        ),

    '29' => Array
        (
            'color_name' => 'strong pink
            ','color_code' => 'rgb(255, 7, 137)'
        ),

    '30' => Array
        (
            'color_name' => 'bland
            ','color_code' => 'rgb(175, 168, 139)'
        ),

    '31' => Array
        (
            'color_name' => 'deep aqua
            ','color_code' => 'rgb(8, 120, 127)'
        ),

    '32' => Array
        (
            'color_name' => 'lavender pink
            ','color_code' => 'rgb(221, 133, 215)'
        ),

    '33' => Array
        (
            'color_name' => 'light moss green
            ','color_code' => 'rgb(166, 200, 117)'
        ),

    '34' => Array
        (
            'color_name' => 'light seafoam green
            ','color_code' => 'rgb(167, 255, 181)'
        ),

    '35' => Array
        (
            'color_name' => 'olive yellow
            ','color_code' => 'rgb(194, 183, 9)'
        ),

    '36' => Array
        (
            'color_name' => 'pig pink
            ','color_code' => 'rgb(231, 142, 165)'
        ),

    '37' => Array
        (
            'color_name' => 'deep lilac
            ','color_code' => 'rgb(150, 110, 189)'
        ),

    '38' => Array
        (
            'color_name' => 'desert
            ','color_code' => 'rgb(204, 173, 96)'
        ),

    '39' => Array
        (
            'color_name' => 'dusty lavender
            ','color_code' => 'rgb(172, 134, 168)'
        ),

    '40' => Array
        (
            'color_name' => 'purpley grey
            ','color_code' => 'rgb(148, 126, 148)'
        ),

    '41' => Array
        (
            'color_name' => 'purply
            ','color_code' => 'rgb(152, 63, 178)'
        ),

    '42' => Array
        (
            'color_name' => 'candy pink
            ','color_code' => 'rgb(255, 99, 233)'
        ),

    '43' => Array
        (
            'color_name' => 'light pastel green
            ','color_code' => 'rgb(178, 251, 165)'
        ),

    '44' => Array
        (
            'color_name' => 'boring green
            ','color_code' => 'rgb(99, 179, 101)'
        ),

    '45' => Array
        (
            'color_name' => 'kiwi green
            ','color_code' => 'rgb(142, 229, 63)'
        ),

    '46' => Array
        (
            'color_name' => 'light grey green
            ','color_code' => 'rgb(183, 225, 161)'
        ),

    '47' => Array
        (
            'color_name' => 'orange pink
            ','color_code' => 'rgb(255, 111, 82)'
        ),

    '48' => Array
        (
            'color_name' => 'tea green
            ','color_code' => 'rgb(189, 248, 163)'
        ),

    '49' => Array
        (
            'color_name' => 'very light brown
            ','color_code' => 'rgb(211, 182, 131)'
        ),

    '50' => Array
        (
            'color_name' => 'egg shell
            ','color_code' => 'rgb(255, 252, 196)'
        ),

    '51' => Array
        (
            'color_name' => 'eggplant purple
            ','color_code' => 'rgb(67, 5, 65)'
        ),

    '52' => Array
        (
            'color_name' => 'powder pink
            ','color_code' => 'rgb(255, 178, 208)'
        ),

    '53' => Array
        (
            'color_name' => 'reddish grey
            ','color_code' => 'rgb(153, 117, 112)'
        ),

    '54' => Array
        (
            'color_name' => 'baby shit brown
            ','color_code' => 'rgb(173, 144, 13)'
        ),

    '55' => Array
        (
            'color_name' => 'liliac
            ','color_code' => 'rgb(196, 142, 253)'
        ),

    '56' => Array
        (
            'color_name' => 'stormy blue
            ','color_code' => 'rgb(80, 123, 156)'
        ),

    '57' => Array
        (
            'color_name' => 'ugly brown
            ','color_code' => 'rgb(125, 113, 3)'
        ),

    '58' => Array
        (
            'color_name' => 'custard
            ','color_code' => 'rgb(255, 253, 120)'
        ),

    '59' => Array
        (
            'color_name' => 'darkish pink
            ','color_code' => 'rgb(218, 70, 125)'
        ),

    '60' => Array
        (
            'color_name' => 'deep brown
            ','color_code' => 'rgb(65, 2, 0)'
        ),

    '61' => Array
        (
            'color_name' => 'greenish beige
            ','color_code' => 'rgb(201, 209, 121)'
        ),

    '62' => Array
        (
            'color_name' => 'manilla
            ','color_code' => 'rgb(255, 250, 134)'
        ),

    '63' => Array
        (
            'color_name' => 'off blue
            ','color_code' => 'rgb(86, 132, 174)'
        ),

    '64' => Array
        (
            'color_name' => 'battleship grey
            ','color_code' => 'rgb(107, 124, 133)'
        ),

    '65' => Array
        (
            'color_name' => 'browny green
            ','color_code' => 'rgb(111, 108, 10)'
        ),

    '66' => Array
        (
            'color_name' => 'bruise
            ','color_code' => 'rgb(126, 64, 113)'
        ),

    '67' => Array
        (
            'color_name' => 'kelley green
            ','color_code' => 'rgb(0, 147, 55)'
        ),

    '68' => Array
        (
            'color_name' => 'sickly yellow
            ','color_code' => 'rgb(208, 228, 41)'
        ),

    '69' => Array
        (
            'color_name' => 'sunny yellow
            ','color_code' => 'rgb(255, 249, 23)'
        ),

    '70' => Array
        (
            'color_name' => 'azul
            ','color_code' => 'rgb(29, 93, 236)'
        ),

    '71' => Array
        (
            'color_name' => 'darkgreen
            ','color_code' => 'rgb(5, 73, 7)'
        ),

    '72' => Array
        (
            'color_name' => 'green/yellow
            ','color_code' => 'rgb(181, 206, 8)'
        ),

    '73' => Array
        (
            'color_name' => 'lichen
            ','color_code' => 'rgb(143, 182, 123)'
        ),

    '74' => Array
        (
            'color_name' => 'light light green
            ','color_code' => 'rgb(200, 255, 176)'
        ),

    '75' => Array
        (
            'color_name' => 'pale gold
            ','color_code' => 'rgb(253, 222, 108)'
        ),

    '76' => Array
        (
            'color_name' => 'sun yellow
            ','color_code' => 'rgb(255, 223, 34)'
        ),

    '77' => Array
        (
            'color_name' => 'tan green
            ','color_code' => 'rgb(169, 190, 112)'
        ),

    '78' => Array
        (
            'color_name' => 'burple
            ','color_code' => 'rgb(104, 50, 227)'
        ),

    '79' => Array
        (
            'color_name' => 'butterscotch
            ','color_code' => 'rgb(253, 177, 71)'
        ),

    '80' => Array
        (
            'color_name' => 'toupe
            ','color_code' => 'rgb(199, 172, 125)'
        ),

    '81' => Array
        (
            'color_name' => 'dark cream
            ','color_code' => 'rgb(255, 243, 154)'
        ),

    '82' => Array
        (
            'color_name' => 'indian red
            ','color_code' => 'rgb(133, 14, 4)'
        ),

    '83' => Array
        (
            'color_name' => 'light lavendar
            ','color_code' => 'rgb(239, 192, 254)'
        ),

    '84' => Array
        (
            'color_name' => 'poison green
            ','color_code' => 'rgb(64, 253, 20)'
        ),

    '85' => Array
        (
            'color_name' => 'baby puke green
            ','color_code' => 'rgb(182, 196, 6)'
        ),

    '86' => Array
        (
            'color_name' => 'bright yellow green
            ','color_code' => 'rgb(157, 255, 0)'
        ),

    '87' => Array
        (
            'color_name' => 'charcoal grey
            ','color_code' => 'rgb(60, 65, 66)'
        ),

    '88' => Array
        (
            'color_name' => 'squash
            ','color_code' => 'rgb(242, 171, 21)'
        ),

    '89' => Array
        (
            'color_name' => 'cinnamon
            ','color_code' => 'rgb(172, 79, 6)'
        ),

    '90' => Array
        (
            'color_name' => 'light pea green
            ','color_code' => 'rgb(196, 254, 130)'
        ),

    '91' => Array
        (
            'color_name' => 'radioactive green
            ','color_code' => 'rgb(44, 250, 31)'
        ),

    '92' => Array
        (
            'color_name' => 'raw sienna
            ','color_code' => 'rgb(154, 98, 0)'
        ),

    '93' => Array
        (
            'color_name' => 'baby purple
            ','color_code' => 'rgb(202, 155, 247)'
        ),

    '94' => Array
        (
            'color_name' => 'cocoa
            ','color_code' => 'rgb(135, 95, 66)'
        ),

    '95' => Array
        (
            'color_name' => 'light royal blue
            ','color_code' => 'rgb(58, 46, 254)'
        ),

    '96' => Array
        (
            'color_name' => 'orangeish
            ','color_code' => 'rgb(253, 141, 73)'
        ),

    '97' => Array
        (
            'color_name' => 'rust brown
            ','color_code' => 'rgb(139, 49, 3)'
        ),

    '98' => Array
        (
            'color_name' => 'sand brown
            ','color_code' => 'rgb(203, 165, 96)'
        ),

    '99' => Array
        (
            'color_name' => 'swamp
            ','color_code' => 'rgb(105, 131, 57)'
        ),

    '100' => Array
        (
            'color_name' => 'tealish green
            ','color_code' => 'rgb(12, 220, 115)'
        ),

    '101' => Array
        (
            'color_name' => 'burnt siena
            ','color_code' => 'rgb(183, 82, 3)'
        ),

    '102' => Array
        (
            'color_name' => 'camo
            ','color_code' => 'rgb(127, 143, 78)'
        ),

    '103' => Array
        (
            'color_name' => 'dusk blue
            ','color_code' => 'rgb(38, 83, 141)'
        ),

    '104' => Array
        (
            'color_name' => 'fern
            ','color_code' => 'rgb(99, 169, 80)'
        ),

    '105' => Array
        (
            'color_name' => 'old rose
            ','color_code' => 'rgb(200, 127, 137)'
        ),

    '106' => Array
        (
            'color_name' => 'pale light green
            ','color_code' => 'rgb(177, 252, 153)'
        ),

    '107' => Array
        (
            'color_name' => 'peachy pink
            ','color_code' => 'rgb(255, 154, 138)'
        ),

    '108' => Array
        (
            'color_name' => 'rosy pink
            ','color_code' => 'rgb(246, 104, 142)'
        ),

    '109' => Array
        (
            'color_name' => 'light bluish green
            ','color_code' => 'rgb(118, 253, 168)'
        ),

    '110' => Array
        (
            'color_name' => 'light bright green
            ','color_code' => 'rgb(83, 254, 92)'
        ),

    '111' => Array
        (
            'color_name' => 'light neon green
            ','color_code' => 'rgb(78, 253, 84)'
        ),

    '112' => Array
        (
            'color_name' => 'light seafoam
            ','color_code' => 'rgb(160, 254, 191)'
        ),

    '113' => Array
        (
            'color_name' => 'tiffany blue
            ','color_code' => 'rgb(123, 242, 218)'
        ),

    '114' => Array
        (
            'color_name' => 'washed out green
            ','color_code' => 'rgb(188, 245, 166)'
        ),

    '115' => Array
        (
            'color_name' => 'browny orange
            ','color_code' => 'rgb(202, 107, 2)'
        ),

    '116' => Array
        (
            'color_name' => 'nice blue
            ','color_code' => 'rgb(16, 122, 176)'
        ),

    '117' => Array
        (
            'color_name' => 'sapphire
            ','color_code' => 'rgb(33, 56, 171)'
        ),

    '118' => Array
        (
            'color_name' => 'greyish teal
            ','color_code' => 'rgb(113, 159, 145)'
        ),

    '119' => Array
        (
            'color_name' => 'orangey yellow
            ','color_code' => 'rgb(253, 185, 21)'
        ),

    '120' => Array
        (
            'color_name' => 'parchment
            ','color_code' => 'rgb(254, 252, 175)'
        ),

    '121' => Array
        (
            'color_name' => 'straw
            ','color_code' => 'rgb(252, 246, 121)'
        ),

    '122' => Array
        (
            'color_name' => 'very dark brown
            ','color_code' => 'rgb(29, 2, 0)'
        ),

    '123' => Array
        (
            'color_name' => 'terracota
            ','color_code' => 'rgb(203, 104, 67)'
        ),

    '124' => Array
        (
            'color_name' => 'ugly blue
            ','color_code' => 'rgb(49, 102, 138)'
        ),

    '125' => Array
        (
            'color_name' => 'clear blue
            ','color_code' => 'rgb(36, 122, 253)'
        ),

    '126' => Array
        (
            'color_name' => 'creme
            ','color_code' => 'rgb(255, 255, 182)'
        ),

    '127' => Array
        (
            'color_name' => 'foam green
            ','color_code' => 'rgb(144, 253, 169)'
        ),

    '128' => Array
        (
            'color_name' => 'grey/green
            ','color_code' => 'rgb(134, 161, 125)'
        ),

    '129' => Array
        (
            'color_name' => 'light gold
            ','color_code' => 'rgb(253, 220, 92)'
        ),

    '130' => Array
        (
            'color_name' => 'seafoam blue
            ','color_code' => 'rgb(120, 209, 182)'
        ),

    '131' => Array
        (
            'color_name' => 'topaz
            ','color_code' => 'rgb(19, 187, 175)'
        ),

    '132' => Array
        (
            'color_name' => 'violet pink
            ','color_code' => 'rgb(251, 95, 252)'
        ),

    '133' => Array
        (
            'color_name' => 'wintergreen
            ','color_code' => 'rgb(32, 249, 134)'
        ),

    '134' => Array
        (
            'color_name' => 'yellow tan
            ','color_code' => 'rgb(255, 227, 110)'
        ),

    '135' => Array
        (
            'color_name' => 'dark fuchsia
            ','color_code' => 'rgb(157, 7, 89)'
        ),

    '136' => Array
        (
            'color_name' => 'indigo blue
            ','color_code' => 'rgb(58, 24, 177)'
        ),

    '137' => Array
        (
            'color_name' => 'light yellowish green
            ','color_code' => 'rgb(194, 255, 137)'
        ),

    '138' => Array
        (
            'color_name' => 'pale magenta
            ','color_code' => 'rgb(215, 103, 173)'
        ),

    '139' => Array
        (
            'color_name' => 'rich purple
            ','color_code' => 'rgb(114, 0, 88)'
        ),

    '140' => Array
        (
            'color_name' => 'sunflower yellow
            ','color_code' => 'rgb(255, 218, 3)'
        ),

    '141' => Array
        (
            'color_name' => 'green/blue
            ','color_code' => 'rgb(1, 192, 141)'
        ),

    '142' => Array
        (
            'color_name' => 'leather
            ','color_code' => 'rgb(172, 116, 52)'
        ),

    '143' => Array
        (
            'color_name' => 'racing green
            ','color_code' => 'rgb(1, 70, 0)'
        ),

    '144' => Array
        (
            'color_name' => 'vivid purple
            ','color_code' => 'rgb(153, 0, 250)'
        ),

    '145' => Array
        (
            'color_name' => 'dark royal blue
            ','color_code' => 'rgb(2, 6, 111)'
        ),

    '146' => Array
        (
            'color_name' => 'hazel
            ','color_code' => 'rgb(142, 118, 24)'
        ),

    '147' => Array
        (
            'color_name' => 'muted pink
            ','color_code' => 'rgb(209, 118, 143)'
        ),

    '148' => Array
        (
            'color_name' => 'booger green
            ','color_code' => 'rgb(150, 180, 3)'
        ),

    '149' => Array
        (
            'color_name' => 'canary
            ','color_code' => 'rgb(253, 255, 99)'
        ),

    '150' => Array
        (
            'color_name' => 'cool grey
            ','color_code' => 'rgb(149, 163, 166)'
        ),

    '151' => Array
        (
            'color_name' => 'dark taupe
            ','color_code' => 'rgb(127, 104, 78)'
        ),

    '152' => Array
        (
            'color_name' => 'darkish purple
            ','color_code' => 'rgb(117, 25, 115)'
        ),

    '153' => Array
        (
            'color_name' => 'true green
            ','color_code' => 'rgb(8, 148, 4)'
        ),

    '154' => Array
        (
            'color_name' => 'coral pink
            ','color_code' => 'rgb(255, 97, 99)'
        ),

    '155' => Array
        (
            'color_name' => 'dark sage
            ','color_code' => 'rgb(89, 133, 86)'
        ),

    '156' => Array
        (
            'color_name' => 'dark slate blue
            ','color_code' => 'rgb(33, 71, 97)'
        ),

    '157' => Array
        (
            'color_name' => 'flat blue
            ','color_code' => 'rgb(60, 115, 168)'
        ),

    '158' => Array
        (
            'color_name' => 'mushroom
            ','color_code' => 'rgb(186, 158, 136)'
        ),

    '159' => Array
        (
            'color_name' => 'rich blue
            ','color_code' => 'rgb(2, 27, 249)'
        ),

    '160' => Array
        (
            'color_name' => 'dirty purple
            ','color_code' => 'rgb(115, 74, 101)'
        ),

    '161' => Array
        (
            'color_name' => 'greenblue
            ','color_code' => 'rgb(35, 196, 139)'
        ),

    '162' => Array
        (
            'color_name' => 'icky green
            ','color_code' => 'rgb(143, 174, 34)'
        ),

    '163' => Array
        (
            'color_name' => 'light khaki
            ','color_code' => 'rgb(230, 242, 162)'
        ),

    '164' => Array
        (
            'color_name' => 'warm blue
            ','color_code' => 'rgb(75, 87, 219)'
        ),

    '165' => Array
        (
            'color_name' => 'dark hot pink
            ','color_code' => 'rgb(217, 1, 102)'
        ),

    '166' => Array
        (
            'color_name' => 'deep sea blue
            ','color_code' => 'rgb(1, 84, 130)'
        ),

    '167' => Array
        (
            'color_name' => 'carmine
            ','color_code' => 'rgb(157, 2, 22)'
        ),

    '168' => Array
        (
            'color_name' => 'dark yellow green
            ','color_code' => 'rgb(114, 143, 2)'
        ),

    '169' => Array
        (
            'color_name' => 'pale peach
            ','color_code' => 'rgb(255, 229, 173)'
        ),

    '170' => Array
        (
            'color_name' => 'plum purple
            ','color_code' => 'rgb(78, 5, 80)'
        ),

    '171' => Array
        (
            'color_name' => 'golden rod
            ','color_code' => 'rgb(249, 188, 8)'
        ),

    '172' => Array
        (
            'color_name' => 'neon red
            ','color_code' => 'rgb(255, 7, 58)'
        ),

    '173' => Array
        (
            'color_name' => 'old pink
            ','color_code' => 'rgb(199, 121, 134)'
        ),

    '174' => Array
        (
            'color_name' => 'very pale blue
            ','color_code' => 'rgb(214, 255, 254)'
        ),

    '175' => Array
        (
            'color_name' => 'blood orange
            ','color_code' => 'rgb(254, 75, 3)'
        ),

    '176' => Array
        (
            'color_name' => 'grapefruit
            ','color_code' => 'rgb(253, 89, 86)'
        ),

    '177' => Array
        (
            'color_name' => 'sand yellow
            ','color_code' => 'rgb(252, 225, 102)'
        ),

    '178' => Array
        (
            'color_name' => 'clay brown
            ','color_code' => 'rgb(178, 113, 61)'
        ),

    '179' => Array
        (
            'color_name' => 'dark blue grey
            ','color_code' => 'rgb(31, 59, 77)'
        ),

    '180' => Array
        (
            'color_name' => 'flat green
            ','color_code' => 'rgb(105, 157, 76)'
        ),

    '181' => Array
        (
            'color_name' => 'light green blue
            ','color_code' => 'rgb(86, 252, 162)'
        ),

    '182' => Array
        (
            'color_name' => 'warm pink
            ','color_code' => 'rgb(251, 85, 129)'
        ),

    '183' => Array
        (
            'color_name' => 'dodger blue
            ','color_code' => 'rgb(62, 130, 252)'
        ),

    '184' => Array
        (
            'color_name' => 'gross green
            ','color_code' => 'rgb(160, 191, 22)'
        ),

    '185' => Array
        (
            'color_name' => 'ice
            ','color_code' => 'rgb(214, 255, 250)'
        ),

    '186' => Array
        (
            'color_name' => 'metallic blue
            ','color_code' => 'rgb(79, 115, 142)'
        ),

    '187' => Array
        (
            'color_name' => 'pale salmon
            ','color_code' => 'rgb(255, 177, 154)'
        ),

    '188' => Array
        (
            'color_name' => 'sap green
            ','color_code' => 'rgb(92, 139, 21)'
        ),

    '189' => Array
        (
            'color_name' => 'algae
            ','color_code' => 'rgb(84, 172, 104)'
        ),

    '190' => Array
        (
            'color_name' => 'bluey grey
            ','color_code' => 'rgb(137, 160, 176)'
        ),

    '191' => Array
        (
            'color_name' => 'greeny grey
            ','color_code' => 'rgb(126, 160, 122)'
        ),

    '192' => Array
        (
            'color_name' => 'highlighter green
            ','color_code' => 'rgb(27, 252, 6)'
        ),

    '193' => Array
        (
            'color_name' => 'light light blue
            ','color_code' => 'rgb(202, 255, 251)'
        ),

    '194' => Array
        (
            'color_name' => 'light mint
            ','color_code' => 'rgb(182, 255, 187)'
        ),

    '195' => Array
        (
            'color_name' => 'raw umber
            ','color_code' => 'rgb(167, 94, 9)'
        ),

    '196' => Array
        (
            'color_name' => 'vivid blue
            ','color_code' => 'rgb(21, 46, 255)'
        ),

    '197' => Array
        (
            'color_name' => 'deep lavender
            ','color_code' => 'rgb(141, 94, 183)'
        ),

    '198' => Array
        (
            'color_name' => 'dull teal
            ','color_code' => 'rgb(95, 158, 143)'
        ),

    '199' => Array
        (
            'color_name' => 'light greenish blue
            ','color_code' => 'rgb(99, 247, 180)'
        ),

    '200' => Array
        (
            'color_name' => 'mud green
            ','color_code' => 'rgb(96, 102, 2)'
        ),

    '201' => Array
        (
            'color_name' => 'pinky
            ','color_code' => 'rgb(252, 134, 170)'
        ),

    '202' => Array
        (
            'color_name' => 'red wine
            ','color_code' => 'rgb(140, 0, 52)'
        ),

    '203' => Array
        (
            'color_name' => 'shit green
            ','color_code' => 'rgb(117, 128, 0)'
        ),

    '204' => Array
        (
            'color_name' => 'tan brown
            ','color_code' => 'rgb(171, 126, 76)'
        ),

    '205' => Array
        (
            'color_name' => 'darkblue
            ','color_code' => 'rgb(3, 7, 100)'
        ),

    '206' => Array
        (
            'color_name' => 'rosa
            ','color_code' => 'rgb(254, 134, 164)'
        ),

    '207' => Array
        (
            'color_name' => 'lipstick
            ','color_code' => 'rgb(213, 23, 78)'
        ),

    '208' => Array
        (
            'color_name' => 'pale mauve
            ','color_code' => 'rgb(254, 208, 252)'
        ),

    '209' => Array
        (
            'color_name' => 'claret
            ','color_code' => 'rgb(104, 0, 24)'
        ),

    '210' => Array
        (
            'color_name' => 'dandelion
            ','color_code' => 'rgb(254, 223, 8)'
        ),

    '211' => Array
        (
            'color_name' => 'orangered
            ','color_code' => 'rgb(254, 66, 15)'
        ),

    '212' => Array
        (
            'color_name' => 'poop green
            ','color_code' => 'rgb(111, 124, 0)'
        ),

    '213' => Array
        (
            'color_name' => 'ruby
            ','color_code' => 'rgb(202, 1, 71)'
        ),

    '214' => Array
        (
            'color_name' => 'dark
            ','color_code' => 'rgb(27, 36, 49)'
        ),

    '215' => Array
        (
            'color_name' => 'greenish turquoise
            ','color_code' => 'rgb(0, 251, 176)'
        ),

    '216' => Array
        (
            'color_name' => 'pastel red
            ','color_code' => 'rgb(219, 88, 86)'
        ),

    '217' => Array
        (
            'color_name' => 'piss yellow
            ','color_code' => 'rgb(221, 214, 24)'
        ),

    '218' => Array
        (
            'color_name' => 'bright cyan
            ','color_code' => 'rgb(65, 253, 254)'
        ),

    '219' => Array
        (
            'color_name' => 'dark coral
            ','color_code' => 'rgb(207, 82, 78)'
        ),

    '220' => Array
        (
            'color_name' => 'algae green
            ','color_code' => 'rgb(33, 195, 111)'
        ),

    '221' => Array
        (
            'color_name' => 'darkish red
            ','color_code' => 'rgb(169, 3, 8)'
        ),

    '222' => Array
        (
            'color_name' => 'reddy brown
            ','color_code' => 'rgb(110, 16, 5)'
        ),

    '223' => Array
        (
            'color_name' => 'blush pink
            ','color_code' => 'rgb(254, 130, 140)'
        ),

    '224' => Array
        (
            'color_name' => 'camouflage green
            ','color_code' => 'rgb(75, 97, 19)'
        ),

    '225' => Array
        (
            'color_name' => 'lawn green
            ','color_code' => 'rgb(77, 164, 9)'
        ),

    '226' => Array
        (
            'color_name' => 'putty
            ','color_code' => 'rgb(190, 174, 138)'
        ),

    '227' => Array
        (
            'color_name' => 'vibrant blue
            ','color_code' => 'rgb(3, 57, 248)'
        ),

    '228' => Array
        (
            'color_name' => 'dark sand
            ','color_code' => 'rgb(168, 143, 89)'
        ),

    '229' => Array
        (
            'color_name' => 'purple/blue
            ','color_code' => 'rgb(93, 33, 208)'
        ),

    '230' => Array
        (
            'color_name' => 'saffron
            ','color_code' => 'rgb(254, 178, 9)'
        ),

    '231' => Array
        (
            'color_name' => 'twilight
            ','color_code' => 'rgb(78, 81, 139)'
        ),

    '232' => Array
        (
            'color_name' => 'warm brown
            ','color_code' => 'rgb(150, 78, 2)'
        ),

    '233' => Array
        (
            'color_name' => 'bluegrey
            ','color_code' => 'rgb(133, 163, 178)'
        ),

    '234' => Array
        (
            'color_name' => 'bubble gum pink
            ','color_code' => 'rgb(255, 105, 175)'
        ),

    '235' => Array
        (
            'color_name' => 'duck egg blue
            ','color_code' => 'rgb(195, 251, 244)'
        ),

    '236' => Array
        (
            'color_name' => 'greenish cyan
            ','color_code' => 'rgb(42, 254, 183)'
        ),

    '237' => Array
        (
            'color_name' => 'petrol
            ','color_code' => 'rgb(0, 95, 106)'
        ),

    '238' => Array
        (
            'color_name' => 'royal
            ','color_code' => 'rgb(12, 23, 147)'
        ),

    '239' => Array
        (
            'color_name' => 'butter
            ','color_code' => 'rgb(255, 255, 129)'
        ),

    '240' => Array
        (
            'color_name' => 'dusty orange
            ','color_code' => 'rgb(240, 131, 58)'
        ),

    '241' => Array
        (
            'color_name' => 'off yellow
            ','color_code' => 'rgb(241, 243, 63)'
        ),

    '242' => Array
        (
            'color_name' => 'pale olive green
            ','color_code' => 'rgb(177, 210, 123)'
        ),

    '243' => Array
        (
            'color_name' => 'orangish
            ','color_code' => 'rgb(252, 130, 74)'
        ),

    '244' => Array
        (
            'color_name' => 'leaf
            ','color_code' => 'rgb(113, 170, 52)'
        ),

    '245' => Array
        (
            'color_name' => 'light blue grey
            ','color_code' => 'rgb(183, 201, 226)'
        ),

    '246' => Array
        (
            'color_name' => 'dried blood
            ','color_code' => 'rgb(75, 1, 1)'
        ),

    '247' => Array
        (
            'color_name' => 'lightish purple
            ','color_code' => 'rgb(165, 82, 230)'
        ),

    '248' => Array
        (
            'color_name' => 'rusty red
            ','color_code' => 'rgb(175, 47, 13)'
        ),

    '249' => Array
        (
            'color_name' => 'lavender blue
            ','color_code' => 'rgb(139, 136, 248)'
        ),

    '250' => Array
        (
            'color_name' => 'light grass green
            ','color_code' => 'rgb(154, 247, 100)'
        ),

    '251' => Array
        (
            'color_name' => 'light mint green
            ','color_code' => 'rgb(166, 251, 178)'
        ),

    '252' => Array
        (
            'color_name' => 'sunflower
            ','color_code' => 'rgb(255, 197, 18)'
        ),

    '253' => Array
        (
            'color_name' => 'velvet
            ','color_code' => 'rgb(117, 8, 81)'
        ),

    '254' => Array
        (
            'color_name' => 'brick orange
            ','color_code' => 'rgb(193, 74, 9)'
        ),

    '255' => Array
        (
            'color_name' => 'lightish red
            ','color_code' => 'rgb(254, 47, 74)'
        ),

    '256' => Array
        (
            'color_name' => 'pure blue
            ','color_code' => 'rgb(2, 3, 226)'
        ),

    '257' => Array
        (
            'color_name' => 'twilight blue
            ','color_code' => 'rgb(10, 67, 122)'
        ),

    '258' => Array
        (
            'color_name' => 'violet red
            ','color_code' => 'rgb(165, 0, 85)'
        ),

    '259' => Array
        (
            'color_name' => 'yellowy brown
            ','color_code' => 'rgb(174, 139, 12)'
        ),

    '260' => Array
        (
            'color_name' => 'carnation
            ','color_code' => 'rgb(253, 121, 143)'
        ),

    '261' => Array
        (
            'color_name' => 'muddy yellow
            ','color_code' => 'rgb(191, 172, 5)'
        ),

    '262' => Array
        (
            'color_name' => 'dark seafoam green
            ','color_code' => 'rgb(62, 175, 118)'
        ),

    '263' => Array
        (
            'color_name' => 'deep rose
            ','color_code' => 'rgb(199, 71, 103)'
        ),

    '264' => Array
        (
            'color_name' => 'dusty red
            ','color_code' => 'rgb(185, 72, 78)'
        ),

    '265' => Array
        (
            'color_name' => 'grey/blue
            ','color_code' => 'rgb(100, 125, 142)'
        ),

    '266' => Array
        (
            'color_name' => 'lemon lime
            ','color_code' => 'rgb(191, 254, 40)'
        ),

    '267' => Array
        (
            'color_name' => 'purple/pink
            ','color_code' => 'rgb(215, 37, 222)'
        ),

    '268' => Array
        (
            'color_name' => 'brown yellow
            ','color_code' => 'rgb(178, 151, 5)'
        ),

    '269' => Array
        (
            'color_name' => 'purple brown
            ','color_code' => 'rgb(103, 58, 63)'
        ),

    '270' => Array
        (
            'color_name' => 'wisteria
            ','color_code' => 'rgb(168, 125, 194)'
        ),

    '271' => Array
        (
            'color_name' => 'banana yellow
            ','color_code' => 'rgb(250, 254, 75)'
        ),

    '272' => Array
        (
            'color_name' => 'lipstick red
            ','color_code' => 'rgb(192, 2, 47)'
        ),

    '273' => Array
        (
            'color_name' => 'water blue
            ','color_code' => 'rgb(14, 135, 204)'
        ),

    '274' => Array
        (
            'color_name' => 'brown grey
            ','color_code' => 'rgb(141, 132, 104)'
        ),

    '275' => Array
        (
            'color_name' => 'vibrant purple
            ','color_code' => 'rgb(173, 3, 222)'
        ),

    '276' => Array
        (
            'color_name' => 'baby green
            ','color_code' => 'rgb(140, 255, 158)'
        ),

    '277' => Array
        (
            'color_name' => 'barf green
            ','color_code' => 'rgb(148, 172, 2)'
        ),

    '278' => Array
        (
            'color_name' => 'eggshell blue
            ','color_code' => 'rgb(196, 255, 247)'
        ),

    '279' => Array
        (
            'color_name' => 'sandy yellow
            ','color_code' => 'rgb(253, 238, 115)'
        ),

    '280' => Array
        (
            'color_name' => 'cool green
            ','color_code' => 'rgb(51, 184, 100)'
        ),

    '281' => Array
        (
            'color_name' => 'pale
            ','color_code' => 'rgb(255, 249, 208)'
        ),

    '282' => Array
        (
            'color_name' => 'blue/grey
            ','color_code' => 'rgb(117, 141, 163)'
        ),

    '283' => Array
        (
            'color_name' => 'hot magenta
            ','color_code' => 'rgb(245, 4, 201)'
        ),

    '284' => Array
        (
            'color_name' => 'greyblue
            ','color_code' => 'rgb(119, 161, 181)'
        ),

    '285' => Array
        (
            'color_name' => 'purpley
            ','color_code' => 'rgb(135, 86, 228)'
        ),

    '286' => Array
        (
            'color_name' => 'baby shit green
            ','color_code' => 'rgb(136, 151, 23)'
        ),

    '287' => Array
        (
            'color_name' => 'brownish pink
            ','color_code' => 'rgb(194, 126, 121)'
        ),

    '288' => Array
        (
            'color_name' => 'dark aquamarine
            ','color_code' => 'rgb(1, 115, 113)'
        ),

    '289' => Array
        (
            'color_name' => 'diarrhea
            ','color_code' => 'rgb(159, 131, 3)'
        ),

    '290' => Array
        (
            'color_name' => 'light mustard
            ','color_code' => 'rgb(247, 213, 96)'
        ),

    '291' => Array
        (
            'color_name' => 'pale sky blue
            ','color_code' => 'rgb(189, 246, 254)'
        ),

    '292' => Array
        (
            'color_name' => 'turtle green
            ','color_code' => 'rgb(117, 184, 79)'
        ),

    '293' => Array
        (
            'color_name' => 'bright olive
            ','color_code' => 'rgb(156, 187, 4)'
        ),

    '294' => Array
        (
            'color_name' => 'dark grey blue
            ','color_code' => 'rgb(41, 70, 91)'
        ),

    '295' => Array
        (
            'color_name' => 'greeny brown
            ','color_code' => 'rgb(105, 96, 6)'
        ),

    '296' => Array
        (
            'color_name' => 'lemon green
            ','color_code' => 'rgb(173, 248, 2)'
        ),

    '297' => Array
        (
            'color_name' => 'light periwinkle
            ','color_code' => 'rgb(193, 198, 252)'
        ),

    '298' => Array
        (
            'color_name' => 'seaweed green
            ','color_code' => 'rgb(53, 173, 107)'
        ),

    '299' => Array
        (
            'color_name' => 'sunshine yellow
            ','color_code' => 'rgb(255, 253, 55)'
        ),

    '300' => Array
        (
            'color_name' => 'ugly purple
            ','color_code' => 'rgb(164, 66, 160)'
        ),

    '301' => Array
        (
            'color_name' => 'medium pink
            ','color_code' => 'rgb(243, 97, 150)'
        ),

    '302' => Array
        (
            'color_name' => 'puke brown
            ','color_code' => 'rgb(148, 119, 6)'
        ),

    '303' => Array
        (
            'color_name' => 'very light pink
            ','color_code' => 'rgb(255, 244, 242)'
        ),

    '304' => Array
        (
            'color_name' => 'viridian
            ','color_code' => 'rgb(30, 145, 103)'
        ),

    '305' => Array
        (
            'color_name' => 'bile
            ','color_code' => 'rgb(181, 195, 6)'
        ),

    '306' => Array
        (
            'color_name' => 'faded yellow
            ','color_code' => 'rgb(254, 255, 127)'
        ),

    '307' => Array
        (
            'color_name' => 'very pale green
            ','color_code' => 'rgb(207, 253, 188)'
        ),

    '308' => Array
        (
            'color_name' => 'vibrant green
            ','color_code' => 'rgb(10, 221, 8)'
        ),

    '309' => Array
        (
            'color_name' => 'bright lime
            ','color_code' => 'rgb(135, 253, 5)'
        ),

    '310' => Array
        (
            'color_name' => 'spearmint
            ','color_code' => 'rgb(30, 248, 118)'
        ),

    '311' => Array
        (
            'color_name' => 'light aquamarine
            ','color_code' => 'rgb(123, 253, 199)'
        ),

    '312' => Array
        (
            'color_name' => 'light sage
            ','color_code' => 'rgb(188, 236, 172)'
        ),

    '313' => Array
        (
            'color_name' => 'yellowgreen
            ','color_code' => 'rgb(187, 249, 15)'
        ),

    '314' => Array
        (
            'color_name' => 'baby poo
            ','color_code' => 'rgb(171, 144, 4)'
        ),

    '315' => Array
        (
            'color_name' => 'dark seafoam
            ','color_code' => 'rgb(31, 181, 122)'
        ),

    '316' => Array
        (
            'color_name' => 'deep teal
            ','color_code' => 'rgb(0, 85, 90)'
        ),

    '317' => Array
        (
            'color_name' => 'heather
            ','color_code' => 'rgb(164, 132, 172)'
        ),

    '318' => Array
        (
            'color_name' => 'rust orange
            ','color_code' => 'rgb(196, 85, 8)'
        ),

    '319' => Array
        (
            'color_name' => 'dirty blue
            ','color_code' => 'rgb(63, 130, 157)'
        ),

    '320' => Array
        (
            'color_name' => 'fern green
            ','color_code' => 'rgb(84, 141, 68)'
        ),

    '321' => Array
        (
            'color_name' => 'bright lilac
            ','color_code' => 'rgb(201, 94, 251)'
        ),

    '322' => Array
        (
            'color_name' => 'weird green
            ','color_code' => 'rgb(58, 229, 127)'
        ),

    '323' => Array
        (
            'color_name' => 'peacock blue
            ','color_code' => 'rgb(1, 103, 149)'
        ),

    '324' => Array
        (
            'color_name' => 'avocado green
            ','color_code' => 'rgb(135, 169, 34)'
        ),

    '325' => Array
        (
            'color_name' => 'faded orange
            ','color_code' => 'rgb(240, 148, 77)'
        ),

    '326' => Array
        (
            'color_name' => 'grape purple
            ','color_code' => 'rgb(93, 20, 81)'
        ),

    '327' => Array
        (
            'color_name' => 'hot green
            ','color_code' => 'rgb(37, 255, 41)'
        ),

    '328' => Array
        (
            'color_name' => 'lime yellow
            ','color_code' => 'rgb(208, 254, 29)'
        ),

    '329' => Array
        (
            'color_name' => 'mango
            ','color_code' => 'rgb(255, 166, 43)'
        ),

    '330' => Array
        (
            'color_name' => 'shamrock
            ','color_code' => 'rgb(1, 180, 76)'
        ),

    '331' => Array
        (
            'color_name' => 'bubblegum
            ','color_code' => 'rgb(255, 108, 181)'
        ),

    '332' => Array
        (
            'color_name' => 'purplish brown
            ','color_code' => 'rgb(107, 66, 71)'
        ),

    '333' => Array
        (
            'color_name' => 'vomit yellow
            ','color_code' => 'rgb(199, 193, 12)'
        ),

    '334' => Array
        (
            'color_name' => 'pale cyan
            ','color_code' => 'rgb(183, 255, 250)'
        ),

    '335' => Array
        (
            'color_name' => 'key lime
            ','color_code' => 'rgb(174, 255, 110)'
        ),

    '336' => Array
        (
            'color_name' => 'tomato red
            ','color_code' => 'rgb(236, 45, 1)'
        ),

    '337' => Array
        (
            'color_name' => 'lightgreen
            ','color_code' => 'rgb(118, 255, 123)'
        ),

    '338' => Array
        (
            'color_name' => 'merlot
            ','color_code' => 'rgb(115, 0, 57)'
        ),

    '339' => Array
        (
            'color_name' => 'night blue
            ','color_code' => 'rgb(4, 3, 72)'
        ),

    '340' => Array
        (
            'color_name' => 'purpleish pink
            ','color_code' => 'rgb(223, 78, 200)'
        ),

    '341' => Array
        (
            'color_name' => 'apple
            ','color_code' => 'rgb(110, 203, 60)'
        ),

    '342' => Array
        (
            'color_name' => 'baby poop green
            ','color_code' => 'rgb(143, 152, 5)'
        ),

    '343' => Array
        (
            'color_name' => 'green apple
            ','color_code' => 'rgb(94, 220, 31)'
        ),

    '344' => Array
        (
            'color_name' => 'heliotrope
            ','color_code' => 'rgb(217, 79, 245)'
        ),

    '345' => Array
        (
            'color_name' => 'yellow/green
            ','color_code' => 'rgb(200, 253, 61)'
        ),

    '346' => Array
        (
            'color_name' => 'almost black
            ','color_code' => 'rgb(7, 13, 13)'
        ),

    '347' => Array
        (
            'color_name' => 'cool blue
            ','color_code' => 'rgb(73, 132, 184)'
        ),

    '348' => Array
        (
            'color_name' => 'leafy green
            ','color_code' => 'rgb(81, 183, 59)'
        ),

    '349' => Array
        (
            'color_name' => 'mustard brown
            ','color_code' => 'rgb(172, 126, 4)'
        ),

    '350' => Array
        (
            'color_name' => 'dusk
            ','color_code' => 'rgb(78, 84, 129)'
        ),

    '351' => Array
        (
            'color_name' => 'dull brown
            ','color_code' => 'rgb(135, 110, 75)'
        ),

    '352' => Array
        (
            'color_name' => 'frog green
            ','color_code' => 'rgb(88, 188, 8)'
        ),

    '353' => Array
        (
            'color_name' => 'vivid green
            ','color_code' => 'rgb(47, 239, 16)'
        ),

    '354' => Array
        (
            'color_name' => 'bright light green
            ','color_code' => 'rgb(45, 254, 84)'
        ),

    '355' => Array
        (
            'color_name' => 'fluro green
            ','color_code' => 'rgb(10, 255, 2)'
        ),

    '356' => Array
        (
            'color_name' => 'kiwi
            ','color_code' => 'rgb(156, 239, 67)'
        ),

    '357' => Array
        (
            'color_name' => 'seaweed
            ','color_code' => 'rgb(24, 209, 123)'
        ),

    '358' => Array
        (
            'color_name' => 'navy green
            ','color_code' => 'rgb(53, 83, 10)'
        ),

    '359' => Array
        (
            'color_name' => 'ultramarine blue
            ','color_code' => 'rgb(24, 5, 219)'
        ),

    '360' => Array
        (
            'color_name' => 'iris
            ','color_code' => 'rgb(98, 88, 196)'
        ),

    '361' => Array
        (
            'color_name' => 'pastel orange
            ','color_code' => 'rgb(255, 150, 79)'
        ),

    '362' => Array
        (
            'color_name' => 'yellowish orange
            ','color_code' => 'rgb(255, 171, 15)'
        ),

    '363' => Array
        (
            'color_name' => 'perrywinkle
            ','color_code' => 'rgb(143, 140, 231)'
        ),

    '364' => Array
        (
            'color_name' => 'tealish
            ','color_code' => 'rgb(36, 188, 168)'
        ),

    '365' => Array
        (
            'color_name' => 'dark plum
            ','color_code' => 'rgb(63, 1, 44)'
        ),

    '366' => Array
        (
            'color_name' => 'pear
            ','color_code' => 'rgb(203, 248, 95)'
        ),

    '367' => Array
        (
            'color_name' => 'pinkish orange
            ','color_code' => 'rgb(255, 114, 76)'
        ),

    '368' => Array
        (
            'color_name' => 'midnight purple
            ','color_code' => 'rgb(40, 1, 55)'
        ),

    '369' => Array
        (
            'color_name' => 'light urple
            ','color_code' => 'rgb(179, 111, 246)'
        ),

    '370' => Array
        (
            'color_name' => 'dark mint
            ','color_code' => 'rgb(72, 192, 114)'
        ),

    '371' => Array
        (
            'color_name' => 'greenish tan
            ','color_code' => 'rgb(188, 203, 122)'
        ),

    '372' => Array
        (
            'color_name' => 'light burgundy
            ','color_code' => 'rgb(168, 65, 91)'
        ),

    '373' => Array
        (
            'color_name' => 'turquoise blue
            ','color_code' => 'rgb(6, 177, 196)'
        ),

    '374' => Array
        (
            'color_name' => 'ugly pink
            ','color_code' => 'rgb(205, 117, 132)'
        ),

    '375' => Array
        (
            'color_name' => 'sandy
            ','color_code' => 'rgb(241, 218, 122)'
        ),

    '376' => Array
        (
            'color_name' => 'electric pink
            ','color_code' => 'rgb(255, 4, 144)'
        ),

    '377' => Array
        (
            'color_name' => 'muted purple
            ','color_code' => 'rgb(128, 91, 135)'
        ),

    '378' => Array
        (
            'color_name' => 'mid green
            ','color_code' => 'rgb(80, 167, 71)'
        ),

    '379' => Array
        (
            'color_name' => 'greyish
            ','color_code' => 'rgb(168, 164, 149)'
        ),

    '380' => Array
        (
            'color_name' => 'neon yellow
            ','color_code' => 'rgb(207, 255, 4)'
        ),

    '381' => Array
        (
            'color_name' => 'banana
            ','color_code' => 'rgb(255, 255, 126)'
        ),

    '382' => Array
        (
            'color_name' => 'carnation pink
            ','color_code' => 'rgb(255, 127, 167)'
        ),

    '383' => Array
        (
            'color_name' => 'tomato
            ','color_code' => 'rgb(239, 64, 38)'
        ),

    '384' => Array
        (
            'color_name' => 'sea
            ','color_code' => 'rgb(60, 153, 146)'
        ),

    '385' => Array
        (
            'color_name' => 'muddy brown
            ','color_code' => 'rgb(136, 104, 6)'
        ),

    '386' => Array
        (
            'color_name' => 'turquoise green
            ','color_code' => 'rgb(4, 244, 137)'
        ),

    '387' => Array
        (
            'color_name' => 'buff
            ','color_code' => 'rgb(254, 246, 158)'
        ),

    '388' => Array
        (
            'color_name' => 'fawn
            ','color_code' => 'rgb(207, 175, 123)'
        ),

    '389' => Array
        (
            'color_name' => 'muted blue
            ','color_code' => 'rgb(59, 113, 159)'
        ),

    '390' => Array
        (
            'color_name' => 'pale rose
            ','color_code' => 'rgb(253, 193, 197)'
        ),

    '391' => Array
        (
            'color_name' => 'dark mint green
            ','color_code' => 'rgb(32, 192, 115)'
        ),

    '392' => Array
        (
            'color_name' => 'amethyst
            ','color_code' => 'rgb(155, 95, 192)'
        ),

    '393' => Array
        (
            'color_name' => 'blue/green
            ','color_code' => 'rgb(15, 155, 142)'
        ),

    '394' => Array
        (
            'color_name' => 'chestnut
            ','color_code' => 'rgb(116, 40, 2)'
        ),

    '395' => Array
        (
            'color_name' => 'sick green
            ','color_code' => 'rgb(157, 185, 44)'
        ),

    '396' => Array
        (
            'color_name' => 'pea
            ','color_code' => 'rgb(164, 191, 32)'
        ),

    '397' => Array
        (
            'color_name' => 'rusty orange
            ','color_code' => 'rgb(205, 89, 9)'
        ),

    '398' => Array
        (
            'color_name' => 'stone
            ','color_code' => 'rgb(173, 165, 135)'
        ),

    '399' => Array
        (
            'color_name' => 'rose red
            ','color_code' => 'rgb(190, 1, 60)'
        ),

    '400' => Array
        (
            'color_name' => 'pale aqua
            ','color_code' => 'rgb(184, 255, 235)'
        ),

    '401' => Array
        (
            'color_name' => 'deep orange
            ','color_code' => 'rgb(220, 77, 1)'
        ),

    '402' => Array
        (
            'color_name' => 'earth
            ','color_code' => 'rgb(162, 101, 62)'
        ),

    '403' => Array
        (
            'color_name' => 'mossy green
            ','color_code' => 'rgb(99, 139, 39)'
        ),

    '404' => Array
        (
            'color_name' => 'grassy green
            ','color_code' => 'rgb(65, 156, 3)'
        ),

    '405' => Array
        (
            'color_name' => 'pale lime green
            ','color_code' => 'rgb(177, 255, 101)'
        ),

    '406' => Array
        (
            'color_name' => 'light grey blue
            ','color_code' => 'rgb(157, 188, 212)'
        ),

    '407' => Array
        (
            'color_name' => 'pale grey
            ','color_code' => 'rgb(253, 253, 254)'
        ),

    '408' => Array
        (
            'color_name' => 'asparagus
            ','color_code' => 'rgb(119, 171, 86)'
        ),

    '409' => Array
        (
            'color_name' => 'blueberry
            ','color_code' => 'rgb(70, 65, 150)'
        ),

    '410' => Array
        (
            'color_name' => 'purple red
            ','color_code' => 'rgb(153, 1, 71)'
        ),

    '411' => Array
        (
            'color_name' => 'pale lime
            ','color_code' => 'rgb(190, 253, 115)'
        ),

    '412' => Array
        (
            'color_name' => 'greenish teal
            ','color_code' => 'rgb(50, 191, 132)'
        ),

    '413' => Array
        (
            'color_name' => 'caramel
            ','color_code' => 'rgb(175, 111, 9)'
        ),

    '414' => Array
        (
            'color_name' => 'deep magenta
            ','color_code' => 'rgb(160, 2, 92)'
        ),

    '415' => Array
        (
            'color_name' => 'light peach
            ','color_code' => 'rgb(255, 216, 177)'
        ),

    '416' => Array
        (
            'color_name' => 'milk chocolate
            ','color_code' => 'rgb(127, 78, 30)'
        ),

    '417' => Array
        (
            'color_name' => 'ocher
            ','color_code' => 'rgb(191, 155, 12)'
        ),

    '418' => Array
        (
            'color_name' => 'off green
            ','color_code' => 'rgb(107, 163, 83)'
        ),

    '419' => Array
        (
            'color_name' => 'purply pink
            ','color_code' => 'rgb(240, 117, 230)'
        ),

    '420' => Array
        (
            'color_name' => 'lightblue
            ','color_code' => 'rgb(123, 200, 246)'
        ),

    '421' => Array
        (
            'color_name' => 'dusky blue
            ','color_code' => 'rgb(71, 95, 148)'
        ),

    '422' => Array
        (
            'color_name' => 'golden
            ','color_code' => 'rgb(245, 191, 3)'
        ),

    '423' => Array
        (
            'color_name' => 'light beige
            ','color_code' => 'rgb(255, 254, 182)'
        ),

    '424' => Array
        (
            'color_name' => 'butter yellow
            ','color_code' => 'rgb(255, 253, 116)'
        ),

    '425' => Array
        (
            'color_name' => 'dusky purple
            ','color_code' => 'rgb(137, 91, 123)'
        ),

    '426' => Array
        (
            'color_name' => 'french blue
            ','color_code' => 'rgb(67, 107, 173)'
        ),

    '427' => Array
        (
            'color_name' => 'ugly yellow
            ','color_code' => 'rgb(208, 193, 1)'
        ),

    '428' => Array
        (
            'color_name' => 'greeny yellow
            ','color_code' => 'rgb(198, 248, 8)'
        ),

    '429' => Array
        (
            'color_name' => 'orangish red
            ','color_code' => 'rgb(244, 54, 5)'
        ),

    '430' => Array
        (
            'color_name' => 'shamrock green
            ','color_code' => 'rgb(2, 193, 77)'
        ),

    '431' => Array
        (
            'color_name' => 'orangish brown
            ','color_code' => 'rgb(178, 95, 3)'
        ),

    '432' => Array
        (
            'color_name' => 'tree green
            ','color_code' => 'rgb(42, 126, 25)'
        ),

    '433' => Array
        (
            'color_name' => 'deep violet
            ','color_code' => 'rgb(73, 6, 72)'
        ),

    '434' => Array
        (
            'color_name' => 'gunmetal
            ','color_code' => 'rgb(83, 98, 103)'
        ),

    '435' => Array
        (
            'color_name' => 'blue/purple
            ','color_code' => 'rgb(90, 6, 239)'
        ),

    '436' => Array
        (
            'color_name' => 'cherry
            ','color_code' => 'rgb(207, 2, 52)'
        ),

    '437' => Array
        (
            'color_name' => 'sandy brown
            ','color_code' => 'rgb(196, 166, 97)'
        ),

    '438' => Array
        (
            'color_name' => 'warm grey
            ','color_code' => 'rgb(151, 138, 132)'
        ),

    '439' => Array
        (
            'color_name' => 'dark indigo
            ','color_code' => 'rgb(31, 9, 84)'
        ),

    '440' => Array
        (
            'color_name' => 'midnight
            ','color_code' => 'rgb(3, 1, 45)'
        ),

    '441' => Array
        (
            'color_name' => 'bluey green
            ','color_code' => 'rgb(43, 177, 121)'
        ),

    '442' => Array
        (
            'color_name' => 'grey pink
            ','color_code' => 'rgb(195, 144, 155)'
        ),

    '443' => Array
        (
            'color_name' => 'soft purple
            ','color_code' => 'rgb(166, 111, 181)'
        ),

    '444' => Array
        (
            'color_name' => 'blood
            ','color_code' => 'rgb(119, 0, 1)'
        ),

    '445' => Array
        (
            'color_name' => 'brown red
            ','color_code' => 'rgb(146, 43, 5)'
        ),

    '446' => Array
        (
            'color_name' => 'medium grey
            ','color_code' => 'rgb(125, 127, 124)'
        ),

    '447' => Array
        (
            'color_name' => 'berry
            ','color_code' => 'rgb(153, 15, 75)'
        ),

    '448' => Array
        (
            'color_name' => 'poo
            ','color_code' => 'rgb(143, 115, 3)'
        ),

    '449' => Array
        (
            'color_name' => 'purpley pink
            ','color_code' => 'rgb(200, 60, 185)'
        ),

    '450' => Array
        (
            'color_name' => 'light salmon
            ','color_code' => 'rgb(254, 169, 147)'
        ),

    '451' => Array
        (
            'color_name' => 'snot
            ','color_code' => 'rgb(172, 187, 13)'
        ),

    '452' => Array
        (
            'color_name' => 'easter purple
            ','color_code' => 'rgb(192, 113, 254)'
        ),

    '453' => Array
        (
            'color_name' => 'light yellow green
            ','color_code' => 'rgb(204, 253, 127)'
        ),

    '454' => Array
        (
            'color_name' => 'dark navy blue
            ','color_code' => 'rgb(0, 2, 46)'
        ),

    '455' => Array
        (
            'color_name' => 'drab
            ','color_code' => 'rgb(130, 131, 68)'
        ),

    '456' => Array
        (
            'color_name' => 'light rose
            ','color_code' => 'rgb(255, 197, 203)'
        ),

    '457' => Array
        (
            'color_name' => 'rouge
            ','color_code' => 'rgb(171, 18, 57)'
        ),

    '458' => Array
        (
            'color_name' => 'purplish red
            ','color_code' => 'rgb(176, 5, 75)'
        ),

    '459' => Array
        (
            'color_name' => 'slime green
            ','color_code' => 'rgb(153, 204, 4)'
        ),

    '460' => Array
        (
            'color_name' => 'baby poop
            ','color_code' => 'rgb(147, 124, 0)'
        ),

    '461' => Array
        (
            'color_name' => 'irish green
            ','color_code' => 'rgb(1, 149, 41)'
        ),

    '462' => Array
        (
            'color_name' => 'pink/purple
            ','color_code' => 'rgb(239, 29, 231)'
        ),

    '463' => Array
        (
            'color_name' => 'dark navy
            ','color_code' => 'rgb(0, 4, 53)'
        ),

    '464' => Array
        (
            'color_name' => 'greeny blue
            ','color_code' => 'rgb(66, 179, 149)'
        ),

    '465' => Array
        (
            'color_name' => 'light plum
            ','color_code' => 'rgb(157, 87, 131)'
        ),

    '466' => Array
        (
            'color_name' => 'pinkish grey
            ','color_code' => 'rgb(200, 172, 169)'
        ),

    '467' => Array
        (
            'color_name' => 'dirty orange
            ','color_code' => 'rgb(200, 118, 6)'
        ),

    '468' => Array
        (
            'color_name' => 'rust red
            ','color_code' => 'rgb(170, 39, 4)'
        ),

    '469' => Array
        (
            'color_name' => 'pale lilac
            ','color_code' => 'rgb(228, 203, 255)'
        ),

    '470' => Array
        (
            'color_name' => 'orangey red
            ','color_code' => 'rgb(250, 66, 36)'
        ),

    '471' => Array
        (
            'color_name' => 'primary blue
            ','color_code' => 'rgb(8, 4, 249)'
        ),

    '472' => Array
        (
            'color_name' => 'kermit green
            ','color_code' => 'rgb(92, 178, 0)'
        ),

    '473' => Array
        (
            'color_name' => 'brownish purple
            ','color_code' => 'rgb(118, 66, 78)'
        ),

    '474' => Array
        (
            'color_name' => 'murky green
            ','color_code' => 'rgb(108, 122, 14)'
        ),

    '475' => Array
        (
            'color_name' => 'wheat
            ','color_code' => 'rgb(251, 221, 126)'
        ),

    '476' => Array
        (
            'color_name' => 'very dark purple
            ','color_code' => 'rgb(42, 1, 52)'
        ),

    '477' => Array
        (
            'color_name' => 'bottle green
            ','color_code' => 'rgb(4, 74, 5)'
        ),

    '478' => Array
        (
            'color_name' => 'watermelon
            ','color_code' => 'rgb(253, 70, 89)'
        ),

    '479' => Array
        (
            'color_name' => 'deep sky blue
            ','color_code' => 'rgb(13, 117, 248)'
        ),

    '480' => Array
        (
            'color_name' => 'fire engine red
            ','color_code' => 'rgb(254, 0, 2)'
        ),

    '481' => Array
        (
            'color_name' => 'yellow ochre
            ','color_code' => 'rgb(203, 157, 6)'
        ),

    '482' => Array
        (
            'color_name' => 'pumpkin orange
            ','color_code' => 'rgb(251, 125, 7)'
        ),

    '483' => Array
        (
            'color_name' => 'pale olive
            ','color_code' => 'rgb(185, 204, 129)'
        ),

    '484' => Array
        (
            'color_name' => 'light lilac
            ','color_code' => 'rgb(237, 200, 255)'
        ),

    '485' => Array
        (
            'color_name' => 'lightish green
            ','color_code' => 'rgb(97, 225, 96)'
        ),

    '486' => Array
        (
            'color_name' => 'carolina blue
            ','color_code' => 'rgb(138, 184, 254)'
        ),

    '487' => Array
        (
            'color_name' => 'mulberry
            ','color_code' => 'rgb(146, 10, 78)'
        ),

    '488' => Array
        (
            'color_name' => 'shocking pink
            ','color_code' => 'rgb(254, 2, 162)'
        ),

    '489' => Array
        (
            'color_name' => 'auburn
            ','color_code' => 'rgb(154, 48, 1)'
        ),

    '490' => Array
        (
            'color_name' => 'bright lime green
            ','color_code' => 'rgb(101, 254, 8)'
        ),

    '491' => Array
        (
            'color_name' => 'celadon
            ','color_code' => 'rgb(190, 253, 183)'
        ),

    '492' => Array
        (
            'color_name' => 'pinkish brown
            ','color_code' => 'rgb(177, 114, 97)'
        ),

    '493' => Array
        (
            'color_name' => 'poo brown
            ','color_code' => 'rgb(136, 95, 1)'
        ),

    '494' => Array
        (
            'color_name' => 'bright sky blue
            ','color_code' => 'rgb(2, 204, 254)'
        ),

    '495' => Array
        (
            'color_name' => 'celery
            ','color_code' => 'rgb(193, 253, 149)'
        ),

    '496' => Array
        (
            'color_name' => 'dirt brown
            ','color_code' => 'rgb(131, 101, 57)'
        ),

    '497' => Array
        (
            'color_name' => 'strawberry
            ','color_code' => 'rgb(251, 41, 67)'
        ),

    '498' => Array
        (
            'color_name' => 'dark lime
            ','color_code' => 'rgb(132, 183, 1)'
        ),

    '499' => Array
        (
            'color_name' => 'copper
            ','color_code' => 'rgb(182, 99, 37)'
        ),

    '500' => Array
        (
            'color_name' => 'medium brown
            ','color_code' => 'rgb(127, 81, 18)'
        ),

    '501' => Array
        (
            'color_name' => 'muted green
            ','color_code' => 'rgb(95, 160, 82)'
        ),

    '502' => Array
        (
            'color_name' => 'robin"s egg
            ','color_code' => 'rgb(109, 237, 253)',
        ),

    '503' => Array
        (
            'color_name' => 'bright aqua
            ','color_code' => 'rgb(11, 249, 234)'
        ),

    '504' => Array
        (
            'color_name' => 'bright lavender
            ','color_code' => 'rgb(199, 96, 255)'
        ),

    '505' => Array
        (
            'color_name' => 'ivory
            ','color_code' => 'rgb(255, 255, 203)'
        ),

    '506' => Array
        (
            'color_name' => 'very light purple
            ','color_code' => 'rgb(246, 206, 252)'
        ),

    '507' => Array
        (
            'color_name' => 'light navy
            ','color_code' => 'rgb(21, 80, 132)'
        ),

    '508' => Array
        (
            'color_name' => 'pink red
            ','color_code' => 'rgb(245, 5, 79)'
        ),

    '509' => Array
        (
            'color_name' => 'olive brown
            ','color_code' => 'rgb(100, 84, 3)'
        ),

    '510' => Array
        (
            'color_name' => 'poop brown
            ','color_code' => 'rgb(122, 89, 1)'
        ),

    '511' => Array
        (
            'color_name' => 'mustard green
            ','color_code' => 'rgb(168, 181, 4)'
        ),

    '512' => Array
        (
            'color_name' => 'ocean green
            ','color_code' => 'rgb(61, 153, 115)'
        ),

    '513' => Array
        (
            'color_name' => 'very dark blue
            ','color_code' => 'rgb(0, 1, 51)'
        ),

    '514' => Array
        (
            'color_name' => 'dusty green
            ','color_code' => 'rgb(118, 169, 115)'
        ),

    '515' => Array
        (
            'color_name' => 'light navy blue
            ','color_code' => 'rgb(46, 90, 136)'
        ),

    '516' => Array
        (
            'color_name' => 'minty green
            ','color_code' => 'rgb(11, 247, 125)'
        ),

    '517' => Array
        (
            'color_name' => 'adobe
            ','color_code' => 'rgb(189, 108, 72)'
        ),

    '518' => Array
        (
            'color_name' => 'barney
            ','color_code' => 'rgb(172, 29, 184)'
        ),

    '519' => Array
        (
            'color_name' => 'jade green
            ','color_code' => 'rgb(43, 175, 106)'
        ),

    '520' => Array
        (
            'color_name' => 'bright light blue
            ','color_code' => 'rgb(38, 247, 253)'
        ),

    '521' => Array
        (
            'color_name' => 'light lime
            ','color_code' => 'rgb(174, 253, 108)'
        ),

    '522' => Array
        (
            'color_name' => 'dark khaki
            ','color_code' => 'rgb(155, 143, 85)'
        ),

    '523' => Array
        (
            'color_name' => 'orange yellow
            ','color_code' => 'rgb(255, 173, 1)'
        ),

    '524' => Array
        (
            'color_name' => 'ocre
            ','color_code' => 'rgb(198, 156, 4)'
        ),

    '525' => Array
        (
            'color_name' => 'maize
            ','color_code' => 'rgb(244, 208, 84)'
        ),

    '526' => Array
        (
            'color_name' => 'faded pink
            ','color_code' => 'rgb(222, 157, 172)'
        ),

    '527' => Array
        (
            'color_name' => 'british racing green
            ','color_code' => 'rgb(5, 72, 13)'
        ),

    '528' => Array
        (
            'color_name' => 'sandstone
            ','color_code' => 'rgb(201, 174, 116)'
        ),

    '529' => Array
        (
            'color_name' => 'mud brown
            ','color_code' => 'rgb(96, 70, 15)'
        ),

    '530' => Array
        (
            'color_name' => 'light sea green
            ','color_code' => 'rgb(152, 246, 176)'
        ),

    '531' => Array
        (
            'color_name' => 'robin egg blue
            ','color_code' => 'rgb(138, 241, 254)'
        ),

    '532' => Array
        (
            'color_name' => 'aqua marine
            ','color_code' => 'rgb(46, 232, 187)'
        ),

    '533' => Array
        (
            'color_name' => 'dark sea green
            ','color_code' => 'rgb(17, 135, 93)'
        ),

    '534' => Array
        (
            'color_name' => 'soft pink
            ','color_code' => 'rgb(253, 176, 192)'
        ),

    '535' => Array
        (
            'color_name' => 'orangey brown
            ','color_code' => 'rgb(177, 96, 2)'
        ),

    '536' => Array
        (
            'color_name' => 'cherry red
            ','color_code' => 'rgb(247, 2, 42)'
        ),

    '537' => Array
        (
            'color_name' => 'burnt yellow
            ','color_code' => 'rgb(213, 171, 9)'
        ),

    '538' => Array
        (
            'color_name' => 'brownish grey
            ','color_code' => 'rgb(134, 119, 95)'
        ),

    '539' => Array
        (
            'color_name' => 'camel
            ','color_code' => 'rgb(198, 159, 89)'
        ),

    '540' => Array
        (
            'color_name' => 'purplish grey
            ','color_code' => 'rgb(122, 104, 127)'
        ),

    '541' => Array
        (
            'color_name' => 'marine
            ','color_code' => 'rgb(4, 46, 96)'
        ),

    '542' => Array
        (
            'color_name' => 'greyish pink
            ','color_code' => 'rgb(200, 141, 148)'
        ),

    '543' => Array
        (
            'color_name' => 'pale turquoise
            ','color_code' => 'rgb(165, 251, 213)'
        ),

    '544' => Array
        (
            'color_name' => 'pastel yellow
            ','color_code' => 'rgb(255, 254, 113)'
        ),

    '545' => Array
        (
            'color_name' => 'bluey purple
            ','color_code' => 'rgb(98, 65, 199)'
        ),

    '546' => Array
        (
            'color_name' => 'canary yellow
            ','color_code' => 'rgb(255, 254, 64)'
        ),

    '547' => Array
        (
            'color_name' => 'faded red
            ','color_code' => 'rgb(211, 73, 78)'
        ),

    '548' => Array
        (
            'color_name' => 'sepia
            ','color_code' => 'rgb(152, 94, 43)'
        ),

    '549' => Array
        (
            'color_name' => 'coffee
            ','color_code' => 'rgb(166, 129, 76)'
        ),

    '550' => Array
        (
            'color_name' => 'bright magenta
            ','color_code' => 'rgb(255, 8, 232)'
        ),

    '551' => Array
        (
            'color_name' => 'mocha
            ','color_code' => 'rgb(157, 118, 81)'
        ),

    '552' => Array
        (
            'color_name' => 'ecru
            ','color_code' => 'rgb(254, 255, 202)'
        ),

    '553' => Array
        (
            'color_name' => 'purpleish
            ','color_code' => 'rgb(152, 86, 141)'
        ),

    '554' => Array
        (
            'color_name' => 'cranberry
            ','color_code' => 'rgb(158, 0, 58)'
        ),

    '555' => Array
        (
            'color_name' => 'darkish green
            ','color_code' => 'rgb(40, 124, 55)'
        ),

    '556' => Array
        (
            'color_name' => 'brown orange
            ','color_code' => 'rgb(185, 105, 2)'
        ),

    '557' => Array
        (
            'color_name' => 'dusky rose
            ','color_code' => 'rgb(186, 104, 115)'
        ),

    '558' => Array
        (
            'color_name' => 'melon
            ','color_code' => 'rgb(255, 120, 85)'
        ),

    '559' => Array
        (
            'color_name' => 'sickly green
            ','color_code' => 'rgb(148, 178, 28)'
        ),

    '560' => Array
        (
            'color_name' => 'silver
            ','color_code' => 'rgb(197, 201, 199)'
        ),

    '561' => Array
        (
            'color_name' => 'purply blue
            ','color_code' => 'rgb(102, 26, 238)'
        ),

    '562' => Array
        (
            'color_name' => 'purpleish blue
            ','color_code' => 'rgb(97, 64, 239)'
        ),

    '563' => Array
        (
            'color_name' => 'hospital green
            ','color_code' => 'rgb(155, 229, 170)'
        ),

    '564' => Array
        (
            'color_name' => 'shit brown
            ','color_code' => 'rgb(123, 88, 4)'
        ),

    '565' => Array
        (
            'color_name' => 'mid blue
            ','color_code' => 'rgb(39, 106, 179)'
        ),

    '566' => Array
        (
            'color_name' => 'amber
            ','color_code' => 'rgb(254, 179, 8)'
        ),

    '567' => Array
        (
            'color_name' => 'easter green
            ','color_code' => 'rgb(140, 253, 126)'
        ),

    '568' => Array
        (
            'color_name' => 'soft blue
            ','color_code' => 'rgb(100, 136, 234)'
        ),

    '569' => Array
        (
            'color_name' => 'cerulean blue
            ','color_code' => 'rgb(5, 110, 238)'
        ),

    '570' => Array
        (
            'color_name' => 'golden brown
            ','color_code' => 'rgb(178, 122, 1)'
        ),

    '571' => Array
        (
            'color_name' => 'bright turquoise
            ','color_code' => 'rgb(15, 254, 249)'
        ),

    '572' => Array
        (
            'color_name' => 'red pink
            ','color_code' => 'rgb(250, 42, 85)'
        ),

    '573' => Array
        (
            'color_name' => 'red purple
            ','color_code' => 'rgb(130, 7, 71)'
        ),

    '574' => Array
        (
            'color_name' => 'greyish brown
            ','color_code' => 'rgb(122, 106, 79)'
        ),

    '575' => Array
        (
            'color_name' => 'vermillion
            ','color_code' => 'rgb(244, 50, 12)'
        ),

    '576' => Array
        (
            'color_name' => 'russet
            ','color_code' => 'rgb(161, 57, 5)'
        ),

    '577' => Array
        (
            'color_name' => 'steel grey
            ','color_code' => 'rgb(111, 130, 138)'
        ),

    '578' => Array
        (
            'color_name' => 'lighter purple
            ','color_code' => 'rgb(165, 90, 244)'
        ),

    '579' => Array
        (
            'color_name' => 'bright violet
            ','color_code' => 'rgb(173, 10, 253)'
        ),

    '580' => Array
        (
            'color_name' => 'prussian blue
            ','color_code' => 'rgb(0, 69, 119)'
        ),

    '581' => Array
        (
            'color_name' => 'slate green
            ','color_code' => 'rgb(101, 141, 109)'
        ),

    '582' => Array
        (
            'color_name' => 'dirty pink
            ','color_code' => 'rgb(202, 123, 128)'
        ),

    '583' => Array
        (
            'color_name' => 'dark blue green
            ','color_code' => 'rgb(0, 82, 73)'
        ),

    '584' => Array
        (
            'color_name' => 'pine
            ','color_code' => 'rgb(43, 93, 52)'
        ),

    '585' => Array
        (
            'color_name' => 'yellowy green
            ','color_code' => 'rgb(191, 241, 40)'
        ),

    '586' => Array
        (
            'color_name' => 'dark gold
            ','color_code' => 'rgb(181, 148, 16)'
        ),

    '587' => Array
        (
            'color_name' => 'bluish
            ','color_code' => 'rgb(41, 118, 187)'
        ),

    '588' => Array
        (
            'color_name' => 'darkish blue
            ','color_code' => 'rgb(1, 65, 130)'
        ),

    '589' => Array
        (
            'color_name' => 'dull red
            ','color_code' => 'rgb(187, 63, 63)'
        ),

    '590' => Array
        (
            'color_name' => 'pinky red
            ','color_code' => 'rgb(252, 38, 71)'
        ),

    '591' => Array
        (
            'color_name' => 'bronze
            ','color_code' => 'rgb(168, 121, 0)'
        ),

    '592' => Array
        (
            'color_name' => 'pale teal
            ','color_code' => 'rgb(130, 203, 178)'
        ),

    '593' => Array
        (
            'color_name' => 'military green
            ','color_code' => 'rgb(102, 124, 62)'
        ),

    '594' => Array
        (
            'color_name' => 'barbie pink
            ','color_code' => 'rgb(254, 70, 165)'
        ),

    '595' => Array
        (
            'color_name' => 'bubblegum pink
            ','color_code' => 'rgb(254, 131, 204)'
        ),

    '596' => Array
        (
            'color_name' => 'pea soup green
            ','color_code' => 'rgb(148, 166, 23)'
        ),

    '597' => Array
        (
            'color_name' => 'dark mustard
            ','color_code' => 'rgb(168, 137, 5)'
        ),

    '598' => Array
        (
            'color_name' => 'shit
            ','color_code' => 'rgb(127, 95, 0)'
        ),

    '599' => Array
        (
            'color_name' => 'medium purple
            ','color_code' => 'rgb(158, 67, 162)'
        ),

    '600' => Array
        (
            'color_name' => 'very dark green
            ','color_code' => 'rgb(6, 46, 3)'
        ),

    '601' => Array
        (
            'color_name' => 'dirt
            ','color_code' => 'rgb(138, 110, 69)'
        ),

    '602' => Array
        (
            'color_name' => 'dusky pink
            ','color_code' => 'rgb(204, 122, 139)'
        ),

    '603' => Array
        (
            'color_name' => 'red violet
            ','color_code' => 'rgb(158, 1, 104)'
        ),

    '604' => Array
        (
            'color_name' => 'lemon yellow
            ','color_code' => 'rgb(253, 255, 56)'
        ),

    '605' => Array
        (
            'color_name' => 'pistachio
            ','color_code' => 'rgb(192, 250, 139)'
        ),

    '606' => Array
        (
            'color_name' => 'dull yellow
            ','color_code' => 'rgb(238, 220, 91)'
        ),

    '607' => Array
        (
            'color_name' => 'dark lime green
            ','color_code' => 'rgb(126, 189, 1)'
        ),

    '608' => Array
        (
            'color_name' => 'denim blue
            ','color_code' => 'rgb(59, 91, 146)'
        ),

    '609' => Array
        (
            'color_name' => 'teal blue
            ','color_code' => 'rgb(1, 136, 159)'
        ),

    '610' => Array
        (
            'color_name' => 'lightish blue
            ','color_code' => 'rgb(61, 122, 253)'
        ),

    '611' => Array
        (
            'color_name' => 'purpley blue
            ','color_code' => 'rgb(95, 52, 231)'
        ),

    '612' => Array
        (
            'color_name' => 'light indigo
            ','color_code' => 'rgb(109, 90, 207)'
        ),

    '613' => Array
        (
            'color_name' => 'swamp green
            ','color_code' => 'rgb(116, 133, 0)'
        ),

    '614' => Array
        (
            'color_name' => 'brown green
            ','color_code' => 'rgb(112, 108, 17)'
        ),

    '615' => Array
        (
            'color_name' => 'dark maroon
            ','color_code' => 'rgb(60, 0, 8)'
        ),

    '616' => Array
        (
            'color_name' => 'hot purple
            ','color_code' => 'rgb(203, 0, 245)'
        ),

    '617' => Array
        (
            'color_name' => 'dark forest green
            ','color_code' => 'rgb(0, 45, 4)'
        ),

    '618' => Array
        (
            'color_name' => 'faded blue
            ','color_code' => 'rgb(101, 140, 187)'
        ),

    '619' => Array
        (
            'color_name' => 'drab green
            ','color_code' => 'rgb(116, 149, 81)'
        ),

    '620' => Array
        (
            'color_name' => 'light lime green
            ','color_code' => 'rgb(185, 255, 102)'
        ),

    '621' => Array
        (
            'color_name' => 'snot green
            ','color_code' => 'rgb(157, 193, 0)'
        ),

    '622' => Array
        (
            'color_name' => 'yellowish
            ','color_code' => 'rgb(250, 238, 102)'
        ),

    '623' => Array
        (
            'color_name' => 'light blue green
            ','color_code' => 'rgb(126, 251, 179)'
        ),

    '624' => Array
        (
            'color_name' => 'bordeaux
            ','color_code' => 'rgb(123, 0, 44)'
        ),

    '625' => Array
        (
            'color_name' => 'light mauve
            ','color_code' => 'rgb(194, 146, 161)'
        ),

    '626' => Array
        (
            'color_name' => 'ocean
            ','color_code' => 'rgb(1, 123, 146)'
        ),

    '627' => Array
        (
            'color_name' => 'marigold
            ','color_code' => 'rgb(252, 192, 6)'
        ),

    '628' => Array
        (
            'color_name' => 'muddy green
            ','color_code' => 'rgb(101, 116, 50)'
        ),

    '629' => Array
        (
            'color_name' => 'dull orange
            ','color_code' => 'rgb(216, 134, 59)'
        ),

    '630' => Array
        (
            'color_name' => 'steel
            ','color_code' => 'rgb(115, 133, 149)'
        ),

    '631' => Array
        (
            'color_name' => 'electric purple
            ','color_code' => 'rgb(170, 35, 255)'
        ),

    '632' => Array
        (
            'color_name' => 'fluorescent green
            ','color_code' => 'rgb(8, 255, 8)'
        ),

    '633' => Array
        (
            'color_name' => 'yellowish brown
            ','color_code' => 'rgb(155, 122, 1)'
        ),

    '634' => Array
        (
            'color_name' => 'blush
            ','color_code' => 'rgb(242, 158, 142)'
        ),

    '635' => Array
        (
            'color_name' => 'soft green
            ','color_code' => 'rgb(111, 194, 118)'
        ),

    '636' => Array
        (
            'color_name' => 'bright orange
            ','color_code' => 'rgb(255, 91, 0)'
        ),

    '637' => Array
        (
            'color_name' => 'lemon
            ','color_code' => 'rgb(253, 255, 82)'
        ),

    '638' => Array
        (
            'color_name' => 'purple grey
            ','color_code' => 'rgb(134, 111, 133)'
        ),

    '639' => Array
        (
            'color_name' => 'acid green
            ','color_code' => 'rgb(143, 254, 9)'
        ),

    '640' => Array
        (
            'color_name' => 'pale lavender
            ','color_code' => 'rgb(238, 207, 254)'
        ),

    '641' => Array
        (
            'color_name' => 'violet blue
            ','color_code' => 'rgb(81, 10, 201)'
        ),

    '642' => Array
        (
            'color_name' => 'light forest green
            ','color_code' => 'rgb(79, 145, 83)'
        ),

    '643' => Array
        (
            'color_name' => 'burnt red
            ','color_code' => 'rgb(159, 35, 5)'
        ),

    '644' => Array
        (
            'color_name' => 'khaki green
            ','color_code' => 'rgb(114, 134, 57)'
        ),

    '645' => Array
        (
            'color_name' => 'cerise
            ','color_code' => 'rgb(222, 12, 98)'
        ),

    '646' => Array
        (
            'color_name' => 'faded purple
            ','color_code' => 'rgb(145, 110, 153)'
        ),

    '647' => Array
        (
            'color_name' => 'apricot
            ','color_code' => 'rgb(255, 177, 109)'
        ),

    '648' => Array
        (
            'color_name' => 'dark olive green
            ','color_code' => 'rgb(60, 77, 3)'
        ),

    '649' => Array
        (
            'color_name' => 'grey brown
            ','color_code' => 'rgb(127, 112, 83)'
        ),

    '650' => Array
        (
            'color_name' => 'green grey
            ','color_code' => 'rgb(119, 146, 111)'
        ),

    '651' => Array
        (
            'color_name' => 'true blue
            ','color_code' => 'rgb(1, 15, 204)'
        ),

    '652' => Array
        (
            'color_name' => 'pale violet
            ','color_code' => 'rgb(206, 174, 250)'
        ),

    '653' => Array
        (
            'color_name' => 'periwinkle blue
            ','color_code' => 'rgb(143, 153, 251)'
        ),

    '654' => Array
        (
            'color_name' => 'light sky blue
            ','color_code' => 'rgb(198, 252, 255)'
        ),

    '655' => Array
        (
            'color_name' => 'blurple
            ','color_code' => 'rgb(85, 57, 204)'
        ),

    '656' => Array
        (
            'color_name' => 'green brown
            ','color_code' => 'rgb(84, 78, 3)'
        ),

    '657' => Array
        (
            'color_name' => 'bluegreen
            ','color_code' => 'rgb(1, 122, 121)'
        ),

    '658' => Array
        (
            'color_name' => 'bright teal
            ','color_code' => 'rgb(1, 249, 198)'
        ),

    '659' => Array
        (
            'color_name' => 'brownish yellow
            ','color_code' => 'rgb(201, 176, 3)'
        ),

    '660' => Array
        (
            'color_name' => 'pea soup
            ','color_code' => 'rgb(146, 153, 1)'
        ),

    '661' => Array
        (
            'color_name' => 'forest
            ','color_code' => 'rgb(11, 85, 9)'
        ),

    '662' => Array
        (
            'color_name' => 'barney purple
            ','color_code' => 'rgb(160, 4, 152)'
        ),

    '663' => Array
        (
            'color_name' => 'ultramarine
            ','color_code' => 'rgb(32, 0, 177)'
        ),

    '664' => Array
        (
            'color_name' => 'purplish
            ','color_code' => 'rgb(148, 86, 140)'
        ),

    '665' => Array
        (
            'color_name' => 'puke yellow
            ','color_code' => 'rgb(194, 190, 14)'
        ),

    '666' => Array
        (
            'color_name' => 'bluish grey
            ','color_code' => 'rgb(116, 139, 151)'
        ),

    '667' => Array
        (
            'color_name' => 'dark periwinkle
            ','color_code' => 'rgb(102, 95, 209)'
        ),

    '668' => Array
        (
            'color_name' => 'dark lilac
            ','color_code' => 'rgb(156, 109, 165)'
        ),

    '669' => Array
        (
            'color_name' => 'reddish
            ','color_code' => 'rgb(196, 66, 64)'
        ),

    '670' => Array
        (
            'color_name' => 'light maroon
            ','color_code' => 'rgb(162, 72, 87)'
        ),

    '671' => Array
        (
            'color_name' => 'dusty purple
            ','color_code' => 'rgb(130, 95, 135)'
        ),

    '672' => Array
        (
            'color_name' => 'terra cotta
            ','color_code' => 'rgb(201, 100, 59)'
        ),

    '673' => Array
        (
            'color_name' => 'avocado
            ','color_code' => 'rgb(144, 177, 52)'
        ),

    '674' => Array
        (
            'color_name' => 'marine blue
            ','color_code' => 'rgb(1, 56, 106)'
        ),

    '675' => Array
        (
            'color_name' => 'teal green
            ','color_code' => 'rgb(37, 163, 111)'
        ),

    '676' => Array
        (
            'color_name' => 'slate grey
            ','color_code' => 'rgb(89, 101, 109)'
        ),

    '677' => Array
        (
            'color_name' => 'lighter green
            ','color_code' => 'rgb(117, 253, 99)'
        ),

    '678' => Array
        (
            'color_name' => 'electric green
            ','color_code' => 'rgb(33, 252, 13)'
        ),

    '679' => Array
        (
            'color_name' => 'dusty blue
            ','color_code' => 'rgb(90, 134, 173)'
        ),

    '680' => Array
        (
            'color_name' => 'golden yellow
            ','color_code' => 'rgb(254, 198, 21)'
        ),

    '681' => Array
        (
            'color_name' => 'bright yellow
            ','color_code' => 'rgb(255, 253, 1)'
        ),

    '682' => Array
        (
            'color_name' => 'light lavender
            ','color_code' => 'rgb(223, 197, 254)'
        ),

    '683' => Array
        (
            'color_name' => 'umber
            ','color_code' => 'rgb(178, 100, 0)'
        ),

    '684' => Array
        (
            'color_name' => 'poop
            ','color_code' => 'rgb(127, 94, 0)'
        ),

    '685' => Array
        (
            'color_name' => 'dark peach
            ','color_code' => 'rgb(222, 126, 93)'
        ),

    '686' => Array
        (
            'color_name' => 'jungle green
            ','color_code' => 'rgb(4, 130, 67)'
        ),

    '687' => Array
        (
            'color_name' => 'eggshell
            ','color_code' => 'rgb(255, 255, 212)'
        ),

    '688' => Array
        (
            'color_name' => 'denim
            ','color_code' => 'rgb(59, 99, 140)'
        ),

    '689' => Array
        (
            'color_name' => 'yellow brown
            ','color_code' => 'rgb(183, 148, 0)'
        ),

    '690' => Array
        (
            'color_name' => 'dull purple
            ','color_code' => 'rgb(132, 89, 126)'
        ),

    '691' => Array
        (
            'color_name' => 'chocolate brown
            ','color_code' => 'rgb(65, 25, 0)'
        ),

    '692' => Array
        (
            'color_name' => 'wine red
            ','color_code' => 'rgb(123, 3, 35)'
        ),

    '693' => Array
        (
            'color_name' => 'neon blue
            ','color_code' => 'rgb(4, 217, 255)'
        ),

    '694' => Array
        (
            'color_name' => 'dirty green
            ','color_code' => 'rgb(102, 126, 44)'
        ),

    '695' => Array
        (
            'color_name' => 'light tan
            ','color_code' => 'rgb(251, 238, 172)'
        ),

    '696' => Array
        (
            'color_name' => 'ice blue
            ','color_code' => 'rgb(215, 255, 254)'
        ),

    '697' => Array
        (
            'color_name' => 'cadet blue
            ','color_code' => 'rgb(78, 116, 150)'
        ),

    '698' => Array
        (
            'color_name' => 'dark mauve
            ','color_code' => 'rgb(135, 76, 98)'
        ),

    '699' => Array
        (
            'color_name' => 'very light blue
            ','color_code' => 'rgb(213, 255, 255)'
        ),

    '700' => Array
        (
            'color_name' => 'grey purple
            ','color_code' => 'rgb(130, 109, 140)'
        ),

    '701' => Array
        (
            'color_name' => 'pastel pink
            ','color_code' => 'rgb(255, 186, 205)'
        ),

    '702' => Array
        (
            'color_name' => 'very light green
            ','color_code' => 'rgb(209, 255, 189)'
        ),

    '703' => Array
        (
            'color_name' => 'dark sky blue
            ','color_code' => 'rgb(68, 142, 228)'
        ),

    '704' => Array
        (
            'color_name' => 'evergreen
            ','color_code' => 'rgb(5, 71, 42)'
        ),

    '705' => Array
        (
            'color_name' => 'dull pink
            ','color_code' => 'rgb(213, 134, 157)'
        ),

    '706' => Array
        (
            'color_name' => 'aubergine
            ','color_code' => 'rgb(61, 7, 52)'
        ),

    '707' => Array
        (
            'color_name' => 'mahogany
            ','color_code' => 'rgb(74, 1, 0)'
        ),

    '708' => Array
        (
            'color_name' => 'reddish orange
            ','color_code' => 'rgb(248, 72, 28)'
        ),

    '709' => Array
        (
            'color_name' => 'deep green
            ','color_code' => 'rgb(2, 89, 15)'
        ),

    '710' => Array
        (
            'color_name' => 'vomit green
            ','color_code' => 'rgb(137, 162, 3)'
        ),

    '711' => Array
        (
            'color_name' => 'purple pink
            ','color_code' => 'rgb(224, 63, 216)'
        ),

    '712' => Array
        (
            'color_name' => 'dusty pink
            ','color_code' => 'rgb(213, 138, 148)'
        ),

    '713' => Array
        (
            'color_name' => 'faded green
            ','color_code' => 'rgb(123, 178, 116)'
        ),

    '714' => Array
        (
            'color_name' => 'camo green
            ','color_code' => 'rgb(82, 101, 37)'
        ),

    '715' => Array
        (
            'color_name' => 'pinky purple
            ','color_code' => 'rgb(201, 76, 190)'
        ),

    '716' => Array
        (
            'color_name' => 'pink purple
            ','color_code' => 'rgb(219, 75, 218)'
        ),

    '717' => Array
        (
            'color_name' => 'brownish red
            ','color_code' => 'rgb(158, 54, 35)'
        ),

    '718' => Array
        (
            'color_name' => 'dark rose
            ','color_code' => 'rgb(181, 72, 93)'
        ),

    '719' => Array
        (
            'color_name' => 'mud
            ','color_code' => 'rgb(115, 92, 18)'
        ),

    '720' => Array
        (
            'color_name' => 'brownish
            ','color_code' => 'rgb(156, 109, 87)'
        ),

    '721' => Array
        (
            'color_name' => 'emerald green
            ','color_code' => 'rgb(2, 143, 30)'
        ),

    '722' => Array
        (
            'color_name' => 'pale brown
            ','color_code' => 'rgb(177, 145, 110)'
        ),

    '723' => Array
        (
            'color_name' => 'dull blue
            ','color_code' => 'rgb(73, 117, 156)'
        ),

    '724' => Array
        (
            'color_name' => 'burnt umber
            ','color_code' => 'rgb(160, 69, 14)'
        ),

    '725' => Array
        (
            'color_name' => 'medium green
            ','color_code' => 'rgb(57, 173, 72)'
        ),

    '726' => Array
        (
            'color_name' => 'clay
            ','color_code' => 'rgb(182, 106, 80)'
        ),

    '727' => Array
        (
            'color_name' => 'light aqua
            ','color_code' => 'rgb(140, 255, 219)'
        ),

    '728' => Array
        (
            'color_name' => 'light olive green
            ','color_code' => 'rgb(164, 190, 92)'
        ),

    '729' => Array
        (
            'color_name' => 'brownish orange
            ','color_code' => 'rgb(203, 119, 35)'
        ),

    '730' => Array
        (
            'color_name' => 'dark aqua
            ','color_code' => 'rgb(5, 105, 107)'
        ),

    '731' => Array
        (
            'color_name' => 'purplish pink
            ','color_code' => 'rgb(206, 93, 174)'
        ),

    '732' => Array
        (
            'color_name' => 'dark salmon
            ','color_code' => 'rgb(200, 90, 83)'
        ),

    '733' => Array
        (
            'color_name' => 'greenish grey
            ','color_code' => 'rgb(150, 174, 141)'
        ),

    '734' => Array
        (
            'color_name' => 'jade
            ','color_code' => 'rgb(31, 167, 116)'
        ),

    '735' => Array
        (
            'color_name' => 'ugly green
            ','color_code' => 'rgb(122, 151, 3)'
        ),

    '736' => Array
        (
            'color_name' => 'dark beige
            ','color_code' => 'rgb(172, 147, 98)'
        ),

    '737' => Array
        (
            'color_name' => 'emerald
            ','color_code' => 'rgb(1, 160, 73)'
        ),

    '738' => Array
        (
            'color_name' => 'pale red
            ','color_code' => 'rgb(217, 84, 77)'
        ),

    '739' => Array
        (
            'color_name' => 'light magenta
            ','color_code' => 'rgb(250, 95, 247)'
        ),

    '740' => Array
        (
            'color_name' => 'sky
            ','color_code' => 'rgb(130, 202, 252)'
        ),

    '741' => Array
        (
            'color_name' => 'light cyan
            ','color_code' => 'rgb(172, 255, 252)'
        ),

    '742' => Array
        (
            'color_name' => 'yellow orange
            ','color_code' => 'rgb(252, 176, 1)'
        ),

    '743' => Array
        (
            'color_name' => 'reddish purple
            ','color_code' => 'rgb(145, 9, 81)'
        ),

    '744' => Array
        (
            'color_name' => 'reddish pink
            ','color_code' => 'rgb(254, 44, 84)'
        ),

    '745' => Array
        (
            'color_name' => 'orchid
            ','color_code' => 'rgb(200, 117, 196)'
        ),

    '746' => Array
        (
            'color_name' => 'dirty yellow
            ','color_code' => 'rgb(205, 197, 10)'
        ),

    '747' => Array
        (
            'color_name' => 'orange red
            ','color_code' => 'rgb(253, 65, 30)'
        ),

    '748' => Array
        (
            'color_name' => 'deep red
            ','color_code' => 'rgb(154, 2, 0)'
        ),

    '749' => Array
        (
            'color_name' => 'orange brown
            ','color_code' => 'rgb(190, 100, 0)'
        ),

    '750' => Array
        (
            'color_name' => 'cobalt blue
            ','color_code' => 'rgb(3, 10, 167)'
        ),

    '751' => Array
        (
            'color_name' => 'neon pink
            ','color_code' => 'rgb(254, 1, 154)'
        ),

    '752' => Array
        (
            'color_name' => 'rose pink
            ','color_code' => 'rgb(247, 135, 154)'
        ),

    '753' => Array
        (
            'color_name' => 'greyish purple
            ','color_code' => 'rgb(136, 113, 145)'
        ),

    '754' => Array
        (
            'color_name' => 'raspberry
            ','color_code' => 'rgb(176, 1, 73)'
        ),

    '755' => Array
        (
            'color_name' => 'aqua green
            ','color_code' => 'rgb(18, 225, 147)'
        ),

    '756' => Array
        (
            'color_name' => 'salmon pink
            ','color_code' => 'rgb(254, 123, 124)'
        ),

    '757' => Array
        (
            'color_name' => 'tangerine
            ','color_code' => 'rgb(255, 148, 8)'
        ),

    '758' => Array
        (
            'color_name' => 'brownish green
            ','color_code' => 'rgb(106, 110, 9)'
        ),

    '759' => Array
        (
            'color_name' => 'red brown
            ','color_code' => 'rgb(139, 46, 22)'
        ),

    '760' => Array
        (
            'color_name' => 'greenish brown
            ','color_code' => 'rgb(105, 97, 18)'
        ),

    '761' => Array
        (
            'color_name' => 'pumpkin
            ','color_code' => 'rgb(225, 119, 1)'
        ),

    '762' => Array
        (
            'color_name' => 'pine green
            ','color_code' => 'rgb(10, 72, 30)'
        ),

    '763' => Array
        (
            'color_name' => 'charcoal
            ','color_code' => 'rgb(52, 56, 55)'
        ),

    '764' => Array
        (
            'color_name' => 'baby pink
            ','color_code' => 'rgb(255, 183, 206)'
        ),

    '765' => Array
        (
            'color_name' => 'cornflower
            ','color_code' => 'rgb(106, 121, 247)'
        ),

    '766' => Array
        (
            'color_name' => 'blue violet
            ','color_code' => 'rgb(93, 6, 233)'
        ),

    '767' => Array
        (
            'color_name' => 'chocolate
            ','color_code' => 'rgb(61, 28, 2)'
        ),

    '768' => Array
        (
            'color_name' => 'greyish green
            ','color_code' => 'rgb(130, 166, 125)'
        ),

    '769' => Array
        (
            'color_name' => 'scarlet
            ','color_code' => 'rgb(190, 1, 25)'
        ),

    '770' => Array
        (
            'color_name' => 'green yellow
            ','color_code' => 'rgb(201, 255, 39)'
        ),

    '771' => Array
        (
            'color_name' => 'dark olive
            ','color_code' => 'rgb(55, 62, 2)'
        ),

    '772' => Array
        (
            'color_name' => 'sienna
            ','color_code' => 'rgb(169, 86, 30)'
        ),

    '773' => Array
        (
            'color_name' => 'pastel purple
            ','color_code' => 'rgb(202, 160, 255)'
        ),

    '774' => Array
        (
            'color_name' => 'terracotta
            ','color_code' => 'rgb(202, 102, 65)'
        ),

    '775' => Array
        (
            'color_name' => 'aqua blue
            ','color_code' => 'rgb(2, 216, 233)'
        ),

    '776' => Array
        (
            'color_name' => 'sage green
            ','color_code' => 'rgb(136, 179, 120)'
        ),

    '777' => Array
        (
            'color_name' => 'blood red
            ','color_code' => 'rgb(152, 0, 2)'
        ),

    '778' => Array
        (
            'color_name' => 'deep pink
            ','color_code' => 'rgb(203, 1, 98)'
        ),

    '779' => Array
        (
            'color_name' => 'grass
            ','color_code' => 'rgb(92, 172, 45)'
        ),

    '780' => Array
        (
            'color_name' => 'moss
            ','color_code' => 'rgb(118, 153, 88)'
        ),

    '781' => Array
        (
            'color_name' => 'pastel blue
            ','color_code' => 'rgb(162, 191, 254)'
        ),

    '782' => Array
        (
            'color_name' => 'bluish green
            ','color_code' => 'rgb(16, 166, 116)'
        ),

    '783' => Array
        (
            'color_name' => 'green blue
            ','color_code' => 'rgb(6, 180, 139)'
        ),

    '784' => Array
        (
            'color_name' => 'dark tan
            ','color_code' => 'rgb(175, 136, 74)'
        ),

    '785' => Array
        (
            'color_name' => 'greenish blue
            ','color_code' => 'rgb(11, 139, 135)'
        ),

    '786' => Array
        (
            'color_name' => 'pale orange
            ','color_code' => 'rgb(255, 167, 86)'
        ),

    '787' => Array
        (
            'color_name' => 'vomit
            ','color_code' => 'rgb(162, 164, 21)'
        ),

    '788' => Array
        (
            'color_name' => 'forrest green
            ','color_code' => 'rgb(21, 68, 6)'
        ),

    '789' => Array
        (
            'color_name' => 'dark lavender
            ','color_code' => 'rgb(133, 103, 152)'
        ),

    '790' => Array
        (
            'color_name' => 'dark violet
            ','color_code' => 'rgb(52, 1, 63)'
        ),

    '791' => Array
        (
            'color_name' => 'purple blue
            ','color_code' => 'rgb(99, 45, 233)'
        ),

    '792' => Array
        (
            'color_name' => 'dark cyan
            ','color_code' => 'rgb(10, 136, 138)'
        ),

    '793' => Array
        (
            'color_name' => 'olive drab
            ','color_code' => 'rgb(111, 118, 50)'
        ),

    '794' => Array
        (
            'color_name' => 'pinkish
            ','color_code' => 'rgb(212, 106, 126)'
        ),

    '795' => Array
        (
            'color_name' => 'cobalt
            ','color_code' => 'rgb(30, 72, 143)'
        ),

    '796' => Array
        (
            'color_name' => 'neon purple
            ','color_code' => 'rgb(188, 19, 254)'
        ),

    '797' => Array
        (
            'color_name' => 'light turquoise
            ','color_code' => 'rgb(126, 244, 204)'
        ),

    '798' => Array
        (
            'color_name' => 'apple green
            ','color_code' => 'rgb(118, 205, 38)'
        ),

    '799' => Array
        (
            'color_name' => 'dull green
            ','color_code' => 'rgb(116, 166, 98)'
        ),

    '800' => Array
        (
            'color_name' => 'wine
            ','color_code' => 'rgb(128, 1, 63)'
        ),

    '801' => Array
        (
            'color_name' => 'powder blue
            ','color_code' => 'rgb(177, 209, 252)'
        ),

    '802' => Array
        (
            'color_name' => 'off white
            ','color_code' => 'rgb(255, 255, 228)'
        ),

    '803' => Array
        (
            'color_name' => 'electric blue
            ','color_code' => 'rgb(6, 82, 255)'
        ),

    '804' => Array
        (
            'color_name' => 'dark turquoise
            ','color_code' => 'rgb(4, 92, 90)'
        ),

    '805' => Array
        (
            'color_name' => 'blue purple
            ','color_code' => 'rgb(87, 41, 206)'
        ),

    '806' => Array
        (
            'color_name' => 'azure
            ','color_code' => 'rgb(6, 154, 243)'
        ),

    '807' => Array
        (
            'color_name' => 'bright red
            ','color_code' => 'rgb(255, 0, 13)'
        ),

    '808' => Array
        (
            'color_name' => 'pinkish red
            ','color_code' => 'rgb(241, 12, 69)'
        ),

    '809' => Array
        (
            'color_name' => 'cornflower blue
            ','color_code' => 'rgb(81, 112, 215)'
        ),

    '810' => Array
        (
            'color_name' => 'light olive
            ','color_code' => 'rgb(172, 191, 105)'
        ),

    '811' => Array
        (
            'color_name' => 'grape
            ','color_code' => 'rgb(108, 52, 97)'
        ),

    '812' => Array
        (
            'color_name' => 'greyish blue
            ','color_code' => 'rgb(94, 129, 157)'
        ),

    '813' => Array
        (
            'color_name' => 'purplish blue
            ','color_code' => 'rgb(96, 30, 249)'
        ),

    '814' => Array
        (
            'color_name' => 'yellowish green
            ','color_code' => 'rgb(176, 221, 22)'
        ),

    '815' => Array
        (
            'color_name' => 'greenish yellow
            ','color_code' => 'rgb(205, 253, 2)'
        ),

    '816' => Array
        (
            'color_name' => 'medium blue
            ','color_code' => 'rgb(44, 111, 187)'
        ),

    '817' => Array
        (
            'color_name' => 'dusty rose
            ','color_code' => 'rgb(192, 115, 122)'
        ),

    '818' => Array
        (
            'color_name' => 'light violet
            ','color_code' => 'rgb(214, 180, 252)'
        ),

    '819' => Array
        (
            'color_name' => 'midnight blue
            ','color_code' => 'rgb(2, 0, 53)'
        ),

    '820' => Array
        (
            'color_name' => 'bluish purple
            ','color_code' => 'rgb(112, 59, 231)'
        ),

    '821' => Array
        (
            'color_name' => 'red orange
            ','color_code' => 'rgb(253, 60, 6)'
        ),

    '822' => Array
        (
            'color_name' => 'dark magenta
            ','color_code' => 'rgb(150, 0, 86)'
        ),

    '823' => Array
        (
            'color_name' => 'greenish
            ','color_code' => 'rgb(64, 163, 104)'
        ),

    '824' => Array
        (
            'color_name' => 'ocean blue
            ','color_code' => 'rgb(3, 113, 156)'
        ),

    '825' => Array
        (
            'color_name' => 'coral
            ','color_code' => 'rgb(252, 90, 80)'
        ),

    '826' => Array
        (
            'color_name' => 'cream
            ','color_code' => 'rgb(255, 255, 194)'
        ),

    '827' => Array
        (
            'color_name' => 'reddish brown
            ','color_code' => 'rgb(127, 43, 10)'
        ),

    '828' => Array
        (
            'color_name' => 'burnt sienna
            ','color_code' => 'rgb(176, 78, 15)'
        ),

    '829' => Array
        (
            'color_name' => 'brick
            ','color_code' => 'rgb(160, 54, 35)'
        ),

    '830' => Array
        (
            'color_name' => 'sage
            ','color_code' => 'rgb(135, 174, 115)'
        ),

    '831' => Array
        (
            'color_name' => 'grey green
            ','color_code' => 'rgb(120, 155, 115)'
        ),

    '832' => Array
        (
            'color_name' => 'white
            ','color_code' => 'rgb(255, 255, 255)'
        ),

    '833' => Array
        (
            'color_name' => "robin's egg blue
            ",'color_code' => 'rgb(152, 239, 249)'
        ),

    '834' => Array
        (
            'color_name' => 'moss green
            ','color_code' => 'rgb(101, 139, 56)'
        ),

    '835' => Array
        (
            'color_name' => 'steel blue
            ','color_code' => 'rgb(90, 125, 154)'
        ),

    '836' => Array
        (
            'color_name' => 'eggplant
            ','color_code' => 'rgb(56, 8, 53)'
        ),

    '837' => Array
        (
            'color_name' => 'light yellow
            ','color_code' => 'rgb(255, 254, 122)'
        ),

    '838' => Array
        (
            'color_name' => 'leaf green
            ','color_code' => 'rgb(92, 169, 4)'
        ),

    '839' => Array
        (
            'color_name' => 'light grey
            ','color_code' => 'rgb(216, 220, 214)'
        ),

    '840' => Array
        (
            'color_name' => 'puke
            ','color_code' => 'rgb(165, 165, 2)'
        ),

    '841' => Array
        (
            'color_name' => 'pinkish purple
            ','color_code' => 'rgb(214, 72, 215)'
        ),

    '842' => Array
        (
            'color_name' => 'sea blue
            ','color_code' => 'rgb(4, 116, 149)'
        ),

    '843' => Array
        (
            'color_name' => 'pale purple
            ','color_code' => 'rgb(183, 144, 212)'
        ),

    '844' => Array
        (
            'color_name' => 'slate blue
            ','color_code' => 'rgb(91, 124, 153)'
        ),

    '845' => Array
        (
            'color_name' => 'blue grey
            ','color_code' => 'rgb(96, 124, 142)'
        ),

    '846' => Array
        (
            'color_name' => 'hunter green
            ','color_code' => 'rgb(11, 64, 8)'
        ),

    '847' => Array
        (
            'color_name' => 'fuchsia
            ','color_code' => 'rgb(237, 13, 217)'
        ),

    '848' => Array
        (
            'color_name' => 'crimson
            ','color_code' => 'rgb(140, 0, 15)'
        ),

    '849' => Array
        (
            'color_name' => 'pale yellow
            ','color_code' => 'rgb(255, 255, 132)'
        ),

    '850' => Array
        (
            'color_name' => 'ochre
            ','color_code' => 'rgb(191, 144, 5)'
        ),

    '851' => Array
        (
            'color_name' => 'mustard yellow
            ','color_code' => 'rgb(210, 189, 10)'
        ),

    '852' => Array
        (
            'color_name' => 'light red
            ','color_code' => 'rgb(255, 71, 76)'
        ),

    '853' => Array
        (
            'color_name' => 'cerulean
            ','color_code' => 'rgb(4, 133, 209)'
        ),

    '854' => Array
        (
            'color_name' => 'pale pink
            ','color_code' => 'rgb(255, 207, 220)'
        ),

    '855' => Array
        (
            'color_name' => 'deep blue
            ','color_code' => 'rgb(4, 2, 115)'
        ),

    '856' => Array
        (
            'color_name' => 'rust
            ','color_code' => 'rgb(168, 60, 9)'
        ),

    '857' => Array
        (
            'color_name' => 'light teal
            ','color_code' => 'rgb(144, 228, 193)'
        ),

    '858' => Array
        (
            'color_name' => 'slate
            ','color_code' => 'rgb(81, 101, 114)'
        ),

    '859' => Array
        (
            'color_name' => 'goldenrod
            ','color_code' => 'rgb(250, 194, 5)'
        ),

    '860' => Array
        (
            'color_name' => 'dark yellow
            ','color_code' => 'rgb(213, 182, 10)'
        ),

    '861' => Array
        (
            'color_name' => 'dark grey
            ','color_code' => 'rgb(54, 55, 55)'
        ),

    '862' => Array
        (
            'color_name' => 'army green
            ','color_code' => 'rgb(75, 93, 22)'
        ),

    '863' => Array
        (
            'color_name' => 'grey blue
            ','color_code' => 'rgb(107, 139, 164)'
        ),

    '864' => Array
        (
            'color_name' => 'seafoam
            ','color_code' => 'rgb(128, 249, 173)'
        ),

    '865' => Array
        (
            'color_name' => 'puce
            ','color_code' => 'rgb(165, 126, 82)'
        ),

    '866' => Array
        (
            'color_name' => 'spring green
            ','color_code' => 'rgb(169, 249, 113)'
        ),

    '867' => Array
        (
            'color_name' => 'dark orange
            ','color_code' => 'rgb(198, 81, 2)'
        ),

    '868' => Array
        (
            'color_name' => 'sand
            ','color_code' => 'rgb(226, 202, 118)'
        ),

    '869' => Array
        (
            'color_name' => 'pastel green
            ','color_code' => 'rgb(176, 255, 157)'
        ),

    '870' => Array
        (
            'color_name' => 'mint
            ','color_code' => 'rgb(159, 254, 176)'
        ),

    '871' => Array
        (
            'color_name' => 'light orange
            ','color_code' => 'rgb(253, 170, 72)'
        ),

    '872' => Array
        (
            'color_name' => 'bright pink
            ','color_code' => 'rgb(254, 1, 177)'
        ),

    '873' => Array
        (
            'color_name' => 'chartreuse
            ','color_code' => 'rgb(193, 248, 10)'
        ),

    '874' => Array
        (
            'color_name' => 'deep purple
            ','color_code' => 'rgb(54, 1, 63)'
        ),

    '875' => Array
        (
            'color_name' => 'dark brown
            ','color_code' => 'rgb(52, 28, 2)'
        ),

    '876' => Array
        (
            'color_name' => 'taupe
            ','color_code' => 'rgb(185, 162, 129)'
        ),

    '877' => Array
        (
            'color_name' => 'pea green
            ','color_code' => 'rgb(142, 171, 18)'
        ),

    '878' => Array
        (
            'color_name' => 'puke green
            ','color_code' => 'rgb(154, 174, 7)'
        ),

    '879' => Array
        (
            'color_name' => 'kelly green
            ','color_code' => 'rgb(2, 171, 46)'
        ),

    '880' => Array
        (
            'color_name' => 'seafoam green
            ','color_code' => 'rgb(122, 249, 171)'
        ),

    '881' => Array
        (
            'color_name' => 'blue green
            ','color_code' => 'rgb(19, 126, 109)'
        ),

    '882' => Array
        (
            'color_name' => 'khaki
            ','color_code' => 'rgb(170, 166, 98)'
        ),

    '883' => Array
        (
            'color_name' => 'burgundy
            ','color_code' => 'rgb(97, 0, 35)'
        ),

    '884' => Array
        (
            'color_name' => 'dark teal
            ','color_code' => 'rgb(1, 77, 78)'
        ),

    '885' => Array
        (
            'color_name' => 'brick red
            ','color_code' => 'rgb(143, 20, 2)'
        ),

    '886' => Array
        (
            'color_name' => 'royal purple
            ','color_code' => 'rgb(75, 0, 110)'
        ),

    '887' => Array
        (
            'color_name' => 'plum
            ','color_code' => 'rgb(88, 15, 65)'
        ),

    '888' => Array
        (
            'color_name' => 'mint green
            ','color_code' => 'rgb(143, 255, 159)'
        ),

    '889' => Array
        (
            'color_name' => 'gold
            ','color_code' => 'rgb(219, 180, 12)'
        ),

    '890' => Array
        (
            'color_name' => 'baby blue
            ','color_code' => 'rgb(162, 207, 254)'
        ),

    '891' => Array
        (
            'color_name' => 'yellow green
            ','color_code' => 'rgb(192, 251, 45)'
        ),

    '892' => Array
        (
            'color_name' => 'bright purple
            ','color_code' => 'rgb(190, 3, 253)'
        ),

    '893' => Array
        (
            'color_name' => 'dark red
            ','color_code' => 'rgb(132, 0, 0)'
        ),

    '894' => Array
        (
            'color_name' => 'pale blue
            ','color_code' => 'rgb(208, 254, 254)'
        ),

    '895' => Array
        (
            'color_name' => 'grass green
            ','color_code' => 'rgb(63, 155, 11)'
        ),

    '896' => Array
        (
            'color_name' => 'navy
            ','color_code' => 'rgb(1, 21, 62)'
        ),

    '897' => Array
        (
            'color_name' => 'aquamarine
            ','color_code' => 'rgb(4, 216, 178)'
        ),

    '898' => Array
        (
            'color_name' => 'burnt orange
            ','color_code' => 'rgb(192, 78, 1)'
        ),

    '899' => Array
        (
            'color_name' => 'neon green
            ','color_code' => 'rgb(12, 255, 12)'
        ),

    '900' => Array
        (
            'color_name' => 'bright blue
            ','color_code' => 'rgb(1, 101, 252)'
        ),

    '901' => Array
        (
            'color_name' => 'rose
            ','color_code' => 'rgb(207, 98, 117)'
        ),

    '902' => Array
        (
            'color_name' => 'light pink
            ','color_code' => 'rgb(255, 209, 223)'
        ),

    '903' => Array
        (
            'color_name' => 'mustard
            ','color_code' => 'rgb(206, 179, 1)'
        ),

    '904' => Array
        (
            'color_name' => 'indigo
            ','color_code' => 'rgb(56, 2, 130)'
        ),

    '905' => Array
        (
            'color_name' => 'lime
            ','color_code' => 'rgb(170, 255, 50)'
        ),

    '906' => Array
        (
            'color_name' => 'sea green
            ','color_code' => 'rgb(83, 252, 161)'
        ),

    '907' => Array
        (
            'color_name' => 'periwinkle
            ','color_code' => 'rgb(142, 130, 254)'
        ),

    '908' => Array
        (
            'color_name' => 'dark pink
            ','color_code' => 'rgb(203, 65, 107)'
        ),

    '909' => Array
        (
            'color_name' => 'olive green
            ','color_code' => 'rgb(103, 122, 4)'
        ),

    '910' => Array
        (
            'color_name' => 'peach
            ','color_code' => 'rgb(255, 176, 124)'
        ),

    '911' => Array
        (
            'color_name' => 'pale green
            ','color_code' => 'rgb(199, 253, 181)'
        ),

    '912' => Array
        (
            'color_name' => 'light brown
            ','color_code' => 'rgb(173, 129, 80)'
        ),

    '913' => Array
        (
            'color_name' => 'hot pink
            ','color_code' => 'rgb(255, 2, 141)'
        ),

    '914' => Array
        (
            'color_name' => 'black
            ','color_code' => 'rgb(0, 0, 0)'
        ),

    '915' => Array
        (
            'color_name' => 'lilac
            ','color_code' => 'rgb(206, 162, 253)'
        ),

    '916' => Array
        (
            'color_name' => 'navy blue
            ','color_code' => 'rgb(0, 17, 70)'
        ),

    '917' => Array
        (
            'color_name' => 'royal blue
            ','color_code' => 'rgb(5, 4, 170)'
        ),

    '918' => Array
        (
            'color_name' => 'beige
            ','color_code' => 'rgb(230, 218, 166)'
        ),

    '919' => Array
        (
            'color_name' => 'salmon
            ','color_code' => 'rgb(255, 121, 108)'
        ),

    '920' => Array
        (
            'color_name' => 'olive
            ','color_code' => 'rgb(110, 117, 14)'
        ),

    '921' => Array
        (
            'color_name' => 'maroon
            ','color_code' => 'rgb(101, 0, 33)'
        ),

    '922' => Array
        (
            'color_name' => 'bright green
            ','color_code' => 'rgb(1, 255, 7)'
        ),

    '923' => Array
        (
            'color_name' => 'dark purple
            ','color_code' => 'rgb(53, 6, 62)'
        ),

    '924' => Array
        (
            'color_name' => 'mauve
            ','color_code' => 'rgb(174, 113, 129)'
        ),

    '925' => Array
        (
            'color_name' => 'forest green
            ','color_code' => 'rgb(6, 71, 12)'
        ),

    '926' => Array
        (
            'color_name' => 'aqua
            ','color_code' => 'rgb(19, 234, 201)'
        ),

    '927' => Array
        (
            'color_name' => 'cyan
            ','color_code' => 'rgb(0, 255, 255)'
        ),

    '928' => Array
        (
            'color_name' => 'tan
            ','color_code' => 'rgb(209, 178, 111)'
        ),

    '929' => Array
        (
            'color_name' => 'dark blue
            ','color_code' => 'rgb(0, 3, 91)'
        ),

    '930' => Array
        (
            'color_name' => 'lavender
            ','color_code' => 'rgb(199, 159, 239)'
        ),

    '931' => Array
        (
            'color_name' => 'turquoise
            ','color_code' => 'rgb(6, 194, 172)'
        ),

    '932' => Array
        (
            'color_name' => 'dark green
            ','color_code' => 'rgb(3, 53, 0)'
        ),

    '933' => Array
        (
            'color_name' => 'violet
            ','color_code' => 'rgb(154, 14, 234)'
        ),

    '934' => Array
        (
            'color_name' => 'light purple
            ','color_code' => 'rgb(191, 119, 246)'
        ),

    '935' => Array
        (
            'color_name' => 'lime green
            ','color_code' => 'rgb(137, 254, 5)'
        ),

    '936' => Array
        (
            'color_name' => 'grey
            ','color_code' => 'rgb(146, 149, 145)'
        ),

    '937' => Array
        (
            'color_name' => 'sky blue
            ','color_code' => 'rgb(117, 187, 253)'
        ),

    '938' => Array
        (
            'color_name' => 'yellow
            ','color_code' => 'rgb(255, 255, 20)'
        ),

    '939' => Array
        (
            'color_name' => 'magenta
            ','color_code' => 'rgb(194, 0, 120)'
        ),

    '940' => Array
        (
            'color_name' => 'light green
            ','color_code' => 'rgb(150, 249, 123)'
        ),

    '941' => Array
        (
            'color_name' => 'orange
            ','color_code' => 'rgb(249, 115, 6)'
        ),

    '942' => Array
        (
            'color_name' => 'teal
            ','color_code' => 'rgb(2, 147, 134)'
        ),

    '943' => Array
        (
            'color_name' => 'light blue
            ','color_code' => 'rgb(149, 208, 252)'
        ),

    '944' => Array
        (
            'color_name' => 'red
            ','color_code' => 'rgb(229, 0, 0)'
        ),

    '945' => Array
        (
            'color_name' => 'brown
            ','color_code' => 'rgb(101, 55, 0)'
        ),

    '946' => Array
        (
            'color_name' => 'pink
            ','color_code' => 'rgb(255, 129, 192)'
        ),

    '947' => Array
        (
            'color_name' => 'blue
            ','color_code' => 'rgb(3, 67, 223)'
        ),

    '948' => Array
        (
            'color_name' => 'green
            ','color_code' => 'rgb(21, 176, 26)'
        ),

    '949' => Array
        (
            'color_name' => 'purple
            ','color_code' => 'rgb(126, 30, 156)'
        ),

);

return $color;
//echo count($color );
//echo "<pre>";print_r($color );
//echo $color['948']['color_name']; 
}


/*
 * Crop Images
 */
function get_resize_img_values() {
    $resize = array(
        array(
            'type' => 'thumb',
            'new_image' => './uploads/product/thumb/',
            'maintain_ratio' => true,
            'width' => 200,
            'height' => 200
        ),
        array(
            'type' => 'offer',
            'new_image' => './uploads/product/offer/',
            'maintain_ratio' => false,
            'width' => 250,
            'height' => 145
        ),
        array(
            'type' => 'offer',
            'new_image' => './uploads/product/medium/',
            'maintain_ratio' => true,
            'width' => 192,
            'height' => 203
        ),
        
    );
    
    return $resize;
}




}//end class