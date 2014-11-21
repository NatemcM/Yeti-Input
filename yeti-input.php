<?php
/**
* Yeti Input
* ==========
*
* ## Simply create valid HTML input fields 
*
* Yeti Input is a simple function which creates valid 
* HTML inputs, helping make your code easier to read 
* and faster to write.
* 
* @author Nathanael McMillan
* @version 0.5
* @copyright The MIT License (MIT)
*
* Copyright (c) 2014 Nathanael McMillan
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/

/*******************************************************************************
* INPUT
* Accepts anything with the HTML input tag i.e. text, email, submit, reset, date
*******************************************************************************/

function input($type = 'text', $name, $label = null, $atts = null) {
	
	$atts = _extractAtts($atts);
	
	if (strtolower($type) == 'submit' || strtolower($type) == 'reset') {
		return <<<BUILD_INPUT
		<input type="$type" value="$name" $atts>	
	
BUILD_INPUT;
	}
	
	return <<<BUILD_INPUT
	<label>$label
		<input type="$type" name="$name" $atts>	
	</label>
	
BUILD_INPUT;

}

/*******************************************************************************
* TEXTAREA
*******************************************************************************/

function textarea($name, $label, $atts = null) {
	
	$atts = _extractAtts($atts);
	
	return <<<TEXT_AREA
	<label for="$name">$label
		<textarea name="$name" $atts></textarea>
	</label>
		
TEXT_AREA;

}

/*******************************************************************************
* RADIO
*******************************************************************************/

function radio($name, $label, $items, $break = 'br', $atts = null) {
	
	$atts = _extractAtts($atts);
	$itemsArray = explode(', ', $items);
	
	/**
	* Error checking
	* If duplicate values are found in the paramaters we kill the form and alert the user.
	* May change this to append/ prepend a number to the value for a unique identifier 
	* This is case sensitive: Run & Run = same, Run & run = not same
	*/
	if(count(array_unique($itemsArray)) < count($itemsArray)) {
		die ('<p style="color:#E64727">Radio buttons must have unique options, please check your input and remove any duplicate values.</p>');
	}
	
		if ($break == "br") {
			$lbStart = "<br>";
			$lbEnd;
		} else {
			$lbStart = "<$break>";
			$lbEnd = "</$break>";	
		}
			
		$input = "<label>$label</label>\r\n";
		 
		foreach($itemsArray as $optionValue) {
				
				$valueName = str_replace(' ','', ucwords($optionValue));  // Create Camel Case value name
				$input .= "$lbStart<label for=\"rdo_$optionValue\">$optionValue <input type=\"radio\" name=\"$name\" value=\"$valueName\" id=\"rdo_$optionValue\"></label> $lbEnd \r\n";
			}			
		
		return $input;
}

/*******************************************************************************
* CHECKBOX
*******************************************************************************/

function checkbox($name, $label, $items, $break = 'br', $atts = null) {
		
		$atts = _extractAtts($atts);
		$itemsArray = explode(', ', $items);
	
	if(count(array_unique($itemsArray)) < count($itemsArray)) {
		die ('<p style="color:#E64727">Radio buttons must have unique options, please check your input and remove any duplicate values.</p>');
	}
	
		if ($break == "br") {
			$lbStart = "<br>";
			$lbEnd;
		} else {
			$lbStart = "<$break>";
			$lbEnd = "</$break>";	
		}
			
		
		$input = "<label>$label</label>\r\n";
		 
		foreach($itemsArray as $optionValue) {
				$valueName = str_replace(' ','', ucwords($optionValue));  // Create Camel Case value name
				
				$input .= "$lbStart<label for=\"cbx_$optionValue\">$optionValue <input type=\"checkbox\" name=\"$name\" value=\"$valueName\" id=\"cbx_$optionValue\"></label>$lbEnd \r\n";
			}			
		
		return $input;
}

/*******************************************************************************
* SELECT
*******************************************************************************/

function select($name, $label, $items, $atts = null) {
		
		$atts = _extractAtts($atts);
		$itemsArray = explode(', ', $items);
			
		$select  = "<label for=\"$name\">$label\r\n";
		$select .= "<select name=\"$name\" id=\"$name\">\r\n";
	
			foreach($itemsArray as $optionValue) {
				$valueName = str_replace(' ','', ucwords($optionValue)); // Create Camel Case value name
				
				if(preg_match('#\((.*?)\)#', $optionValue)) {
					$optionValue = str_replace(array('(',')'),'',$optionValue);
					$valueName = str_replace(array('(',')'),'', ucwords($optionValue));
					
					$select .= "<option value=\"$valueName\" selected>$optionValue</option>\r\n";
				} else {
					$select .= "<option value=\"$valueName\">$optionValue</option>\r\n";
				}
			}
		$select .= "</select>\r\n</label>";
			
		return $select;
}

/*******************************************************************************
* BUTTON
*******************************************************************************/

function button($type = 'submit', $name, $atts = null) {
	
	$atts = _extractAtts($atts);
	
	return <<<BUTTON_INPUT
		<button type="$type" name="$name" $atts>$value</button>
BUTTON_INPUT;

}


/*******************************************************************************
* FORM
*******************************************************************************/

function form($action = 'self', $method = 'POST', $enctype = null, $atts = null , $honeypotName = null, $honeypotValue = null) {
	
	$atts = _extractAtts($atts);
	
	if (strtolower($enctype) == 'text') {
		$enctype = "text/plain"; 
	} elseif (strtolower($enctype) == 'multipart') {
		$enctype = "multipart/form-data"; 
	} else {
		$enctype = "application/x-www-form-urlencoded";
	}
	
	if (strtolower($action) == 'self') {
		$action = $_SERVER['PHP_SELF']; 	
	} 
	
	if ($honeypotName) {
		$returnHoneypot = "<input type=\"text\" name=\"$honeypotName\" value=\"$honeypotValue\"  style=\"position:absolute; left:-9999px; top:0;\">";
	}
	
	$form  = "<form action=\"$action\" method=\"$method\" $atts enctype=\"$enctype\">\r\n". $returnHoneypot;
	
	return $form;
	
}


/*******************************************************************************
* OLD
*******************************************************************************/

function yeti_input($type = 'text', $name, $label, $atts = null) {

	$type = strtolower($type); // Convert to downcase for matching below
		
	/**
	* Submit Button
	*/
	if($type == 'submit') {
		return <<<BUILD_OUTPUT
		<input type="submit" value="$label" name="$name" $atts>
		
BUILD_OUTPUT;

	} 
	
	/**
	* Datalist Input
	*/
	elseif($type == 'datalist') {
		
		$optionGroupLabel = explode(': ', $label); // Grab the name for the label
		$optionGroup = explode(', ', $optionGroupLabel[1]); // Create an array from the submited values
		
		$dataList  = "<label>{$optionGroupLabel[0]}</label>\r\n";
		$dataList .= "<input list=\"$name\" name=\"$name\">\r\n";
		$dataList .= "<datalist id=\"$name\">\r\n";
		
		$optionGroup = explode(', ', $optionGroupLabel[1]); // Create and array from the submited values
		foreach($optionGroup as $optionValue) {
				$dataList .= "<option value=\"$optionValue\">\r\n";
			}
		$dataList .= "</datalist>\r\n";
		
		return $dataList;
		
	} 
	

	
	/**
	* Keygen input
	*/
	elseif($type == 'keygen'){
	
	return <<<BUILD_INPUT
	<label>$label
		<keygen name="$name" $atts >	
	</label>
	
BUILD_INPUT;
	
	}
	
	/**
	* Number tag & range slider
	*/
	elseif($type == 'number' || $type == 'range'){
	
	$splitLabel = explode(': ', $label);
	
	$input  = "<label>$splitLabel[0]\r\n";
	$input .= "<input type=\"$type\" name=\"$name\" value=\"{$splitLabel[1]}\">\r\n" ;
	$input .= "</label>";
	
	return $input;	
	}
	
	/**
	* Outout tag
	*/
	elseif($type == 'output'){
	
	$calcValues = explode(', ', $label);
		
	$input = "<output name=\"$name\" for=\"";
	foreach($calcValues as $intVal) {
				$input .= $intVal." ";
			}			
	$input .= "\"></output>\r\n>";
	
	return $input;	
	}
	
	/**
	* Default Input (text, tel, email, color, etc)
	*/
	else {
		
	} 
	
}

/**
* Google Recaptcha 
* == Should the lib be included inside the function?
*/
function recaptcha($publicKey, $path) {
	require_once($path."recaptchalib.php");
	return recaptcha_get_html($publicKey);
}


function endForm() {
	return '</form>';	
}

/*******************************************************************************
* FUNCTIONS FOR FUNCTIONS
*******************************************************************************/

function _extractAtts($attsToExtract) {
		
	$attsArray = explode(', ', $attsToExtract);
	
	$idCount = 0;
	foreach ($attsArray as $indAtts) {
		if($indAtts[0] == '.') {
			$classAtts .= str_replace('.', '', $indAtts).' ';	
		}
		elseif($indAtts[0] == '#') {
			$idAtt .= str_replace('#', '', $indAtts).' ';	
			$idCount ++;
			if($idCount > 1) {
				echo '<p style="color:#E64727">Element must only have one unique ID!</p>';
				break;
			}
		} 
		else {
			$otherAtts .= $indAtts.' ';	
		}
	}
	
	if ($idAtt) {
		$returnId = 	'id="'.rtrim($idAtt).'" ';
	}
	
	if ($classAtts) {
		$returnClass = 	'class="'.rtrim($classAtts).'" ';
	}
	
	return $returnId.$returnClass.$otherAtts;
}















