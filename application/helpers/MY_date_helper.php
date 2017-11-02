<?php
function monthList(){
        return array(
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10'    => 'October',
                    '11'    => 'November',
                    '12'    => 'December'
                );
    } 
function format_date($date){	
	if ($date != '' && $date != '0000-00-00')
	{
		$d	= explode('-', $date);
	
		$m	= Array(
		'January'
		,'February'
		,'March'
		,'April'
		,'May'
		,'June'
		,'July'
		,'August'
		,'September'
		,'October'
		,'November'
		,'December'
		);
	
		return $m[$d[1]-1].' '.$d[2].', '.$d[0]; 
	}
	else
	{
		return false;
	}
}

function get_week_days(){
    $days = array(
            'sun'=>'sunday',
            'mon'=>'monday',
            'tue'=>'tuesday',
            'wed'=>'wednesday',
            'thu'=>'thursday',
            'fri'=>'friday',
            'sat'=>'saturday',
        );
    
    return $days;
}

function reverse_format($date ,$find = '' , $replace = '')
{
        
	if(empty($date)) 
	{
		return;
	}
        if(empty($find)){
            $find= '-';
        }
	
	$d = explode($find, $date);
	
	return "{$d[2]}$replace{$d[1]}$replace{$d[0]}";
}

function format_ymd($date)
{
	if(empty($date) || $date == '00-00-0000')
	{
		return '';
	}
	else
	{
		$d = explode('-', $date);
		return $d[2].'-'.$d[0].'-'.$d[1];
	}
}

function format_mdy($date)
{
	if(empty($date) || $date == '0000-00-00')
	{
		return '';
	}
	else
	{
		return date('m-d-Y', strtotime($date));
	}
	
}

/*
 * This function returns the passt date.
 * I am trying to convert a timestamp of the format 2009-09-12 20:57:19 and turn it into something like 3 minutes ago with PHP.
 * Param1 : strtotime('2009-09-12 20:57:19');
 */
function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}


/*
 * This function returns the Future date.
 * I am trying to convert a timestamp of the format 2009-09-12 20:57:19 and turn it into something like 3 minutes ago with PHP.
 * Param1 : strtotime('2009-09-12 20:57:19');
 */
function how_many_days_left($ptime)
{
    ///Get current Unix time stamp
    $currentTime = time();

    //Calculate the difference in seconds
    $difference = $ptime - $currentTime;
    
    //Calculate how many days are within $difference

      $days = intval($difference / 86400); 

      //Keep the remainder

      $difference = $difference % 86400;

      //Calculate how many hours are within $difference 

      $hours = intval($difference / 3600); 

      //Keep the remainder

      $difference = $difference % 3600;

      //Calculate how many minutes are within $difference 

      $minutes = intval($difference / 60); 

      //Keep the remainder

      $difference = $difference % 60;

      //Calculate how many seconds are within $difference 

      $seconds = intval($difference); 

      //Output:

      //return "Days: ".$days." Hours: ".$hours." Minutes: ".$minutes." Seconds: ".$seconds;
      return $days.' Days '.$hours.' Hours Remaining';

}

function start_time_list($select = ''){
    $day = date('Y-m-d');
    $startTime = date(strtotime($day." 07:00"));
    $endTime = date(strtotime($day." 21:30"));
    $timeDiff = round(($endTime - $startTime)/60/60);
    $startHour = date("G", $startTime);
    $endHour = $startHour + $timeDiff; 
    for ($i=$startHour; $i <= $endHour; $i++)
    {
         for ($j = 0; $j <= 45; $j+=60)
            {
                $time = $i.":".str_pad($j, 2, '0', STR_PAD_LEFT);
                $time_interval = (date(strtotime($day." ".$time)) <= $endTime) ? date("g:i a", strtotime($day." ".$time)):"";
                ?>
                <?php if($time_interval!='') { ?><option value="<?php echo $time_interval; ?>" <?php if($time_interval == $select){ echo "selected";}  ?> ><?php echo $time_interval; ?></option> <?php } ?>
                <?php 
            }
    }
}

function end_time_list($select = ''){
    $day = date('Y-m-d');
    $startTime = date(strtotime($day." 08:00"));
    $endTime = date(strtotime($day." 21:30"));
    $timeDiff = round(($endTime - $startTime)/60/60);
    $startHour = date("G", $startTime);
    $endHour = $startHour + $timeDiff; 
    for ($i=$startHour; $i <= $endHour; $i++)
    {
         for ($j = 0; $j <= 45; $j+=60)
            {
                $time = $i.":".str_pad($j, 2, '0', STR_PAD_LEFT);
                $time_interval = (date(strtotime($day." ".$time)) <= $endTime) ? date("g:i a", strtotime($day." ".$time)):"";
                ?>
                <?php if($time_interval!='') { ?><option value="<?php echo $time_interval; ?>"  <?php if($time_interval == $select){ echo "selected";}  ?>   ><?php echo $time_interval; ?></option> <?php } ?>
                <?php 
            }
    }
}

/*
 * GET Current age
 * Param 1 : YY-MM-DD
 *result
 * ->y : 26
 * ->m : 8
 * ->d : 23 
 */
function age_calculation($date_of_birth){
    return date_diff(date_create($date_of_birth), date_create('today'))->y;
}
?>