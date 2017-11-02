<?php
//fuly decode a particular string
function full_decode($string)
{
	return html_entity_decode($string, ENT_QUOTES);
}

//decode anything we throw at it
function form_decode(&$x)
{
	//loop through objects or arrays
	if(is_array($x) || is_object($x))
	{
		foreach($x as &$y)
		{
			$y = form_decode($y);
		}
	}
	
	if(is_string($x))
	{
		$x	= full_decode($x);
	}
	
	return $x;
}

function my_character_limiter($str, $n = 500, $end_char = '&#8230;')
{
	$output = substr($str, 0, $n);
	if(strlen($str)>$n){
		$output.=$end_char;
	}

	return $output;
}


//used by the giftcard feature
function generate_code($length=8)
{
	$vowels = '0123';
	$consonants = '456789ABCDEF';
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
/*
 * 
 * $text  =  Fiull text 
 * $words =  Find text
 * $colors = background color pattern
 */
function highlightWords($text, $words, $colors = 'yellow') {
    $text   = trim(strtolower($text));
    $words  = trim($words);
    if ($words != '') {
        $find = preg_quote(strtolower($words));
        
        $rep = "<span style='background-color: " . $colors . ";'>" . $find . "</span>";
        
        //$text = strtr($text, array($find => $rep));
        $text = str_replace($find, $rep, $text);
    }
    /*         * * return the text ** */
    return $text;
}

function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }

        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
    
function alert_message(){
    $CI =& get_instance();
    if ($CI->session->flashdata('message')): ?>
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">x</a>
            <?php echo $CI->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <?php if ($CI->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">x</a>
            <?php echo $CI->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">x</a>
            <?php echo $error; ?>
        </div>
    <?php endif;
}