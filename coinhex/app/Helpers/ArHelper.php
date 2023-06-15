<?php
function getAllEdcs(){

	$allEdc = DB::table('users')
		  ->where('role_id','=','2')
		  ->where('status','=','1')
		  ->pluck('ID','full_name');

	return $allEdc;

}

function getUserName($edc_id){
	$name = DB::table('users')
		  ->where('ID','=',$edc_id)
		  ->select('full_name')
		  ->first();
	if(!empty($name)){
		return $name->full_name;
	} else {
		return "EDC";
	}
}

function getEDC_logoid($edc_id){

	$image_id = "";
	if($edc_id != "" && $edc_id != "0"){
		$arr = DB::table('users')
			  ->where('ID','=',$edc_id)
			  ->select('logo_id')
			  ->first();
		if(!empty($arr)){
			$image_id = $arr->logo_id;
		}
	}

	return $image_id;
}

function getEDCinfo($edc_id){
	$edcArr = DB::table('users')
		  ->where('ID','=',$edc_id)
		  ->first();
	
	return $edcArr;
}

function getMentorImg($mem_id){

	$image_id = "";
	if($mem_id != "" && $mem_id != "0"){
		$arr = DB::table('mentors')
			  ->where('ID','=',$mem_id)
			  ->select('image_id')
			  ->first();
		if(!empty($arr)){
			$image_id = $arr->image_id;
		}
	}

	return $image_id;	
}


function getMentorInfo($mem_id){
	$memArr = DB::table('mentors')
		  ->where('ID','=',$mem_id)
		  ->first();
	
	return $memArr;
}

?>