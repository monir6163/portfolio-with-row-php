<?php
	function escape($data){
		global $conn;
		$data = mysqli_real_escape_string($conn,$data);
		$data = trim($data);
		return $data;
	}
	function q($query){
		global $conn;
		$exe_q	=	mysqli_query($conn,$query);
		return	$exe_q;
	}
	function f($query){
		return mysqli_fetch_assoc($query);
	}
	function post($pname){
		$data = escape($_POST[$pname]);
		return $data;
	}
	function get($pname){
		$data = escape($_GET[$pname]);
		return $data;
	}
	function pisset($fname){
		if(isset($_POST[$fname])){
			return true;
		}else{
			return false;
		}
	}
	function gisset($fname){
		if(isset($_GET[$fname])){
			return true;
		}else{
			return false;
		}
	}
	function qf($query){
		$data = q($query);
		$fdata = mysqli_fetch_assoc($data);
		return $fdata;	
	}
	
	function date_for_user($date){
		$date 		=	explode("-",$date);
		$new_date	=	$date[2]."-".$date[1]."-".$date[0];
		return $new_date;
	}
	function dateu($date){
		$date 		=	explode("-",$date);
		$new_date	=	$date[2]."-".$date[1]."-".$date[0];
		return $new_date;
	}
function qc($query){
	global $conn;
	$exe_q	=	mysqli_query($conn,$query);
	$count  =  mysqli_num_rows($exe_q);
	return	$count;
}

   //function expenses_master($id){
    //	$expance_name  = qf("SELECT * FROM `expenses_master` WHERE expenses_master_id = $id");
    //	return $expance_name['expenses_master_name'];
   // }
 

	function date_for_db($date_val)
	{
		$expdate = explode("-",$date_val);
		return $expdate['2']."-".$expdate['1']."-".$expdate['0'];
	}	
	function datedb($date_val)
	{
		$expdate = explode("-",$date_val);
		return $expdate['2']."-".$expdate['1']."-".$expdate['0'];
	}
function datedbu($datedb){
    $year = substr($datedb, 0,4);
    $month = substr($datedb, 4,2);
    $day  = substr($datedb, 6,2);
    return $day."-".$month."-".$year;
}
	
	function convertNumberToWord($num = false)
   {
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
	
	
	//Function For Gender//
	function gender_name($gender){
		if($gender== 'm' )
		{
		return "Male";
		}
		else if($gender=='f'){
		 return "Female";
		 }
	}	
	function date_min($date){
		$date = explode("-",$date);
		if ($date[1]<9) {
			$date[1] = '0'.(int)($date[1]);
		}
		if($date[2]<9){
			$date[2] = '0'.(int)($date[2]);
		}
		return $date[0].$date[1].$date[2];
	}

function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
}
function get_date($date,$num_of_day){
	$datetime = new DateTime($date);
	$datetime->modify('-'.($num_of_day-1).'day');
	return $datetime->format('Y-m-d');
} 
function one_day_pri_get_date($date){
	$datetime = new DateTime($date);
	$datetime->modify('-1 day');
	return $datetime->format('Y-m-d');
} 
function redirect($url){
	$redirect_url = $_SERVER['HTTP_REFERER'];
	if(!empty($url)){
		$redirect_url = $url;
	}
	header("Location: ".$redirect_url."");
	die();
}
function success($msg){
	$_SESSION['success'] = 1;
	$_SESSION['message'] = $msg;
}
function warning($msg){
	$_SESSION['warning'] = 1;
	$_SESSION['message'] = $msg;
}
?>

<?php
function loader(){
	?>
<style>
	.lds-ripple {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #ff5400;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 28px;
    left: 28px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: -1px;
    left: -1px;
    width: 58px;
    height: 58px;
    opacity: 0;
  }
}

</style>
<div class="lds-ripple"><div></div><div></div></div>
	<?php
}
?>