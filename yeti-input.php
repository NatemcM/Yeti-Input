<?php
/**
* # Yeti Input
* ## Simply create valid HTML input fields 
*
* Yeti Input is a simple function which creates valid 
* HTML inputs, helping make your code easier to read 
* and faster to write.
* 
* @author Nathanael McMillan
* @version 0.1
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
	* Select Input
	*/
	elseif($type == 'select'){
		
		$optionGroupLabel = explode(': ', $label); // Grab the name for the label
		$optionGroup = explode(', ', $optionGroupLabel[1]); // Create an array from the submited values
			
		$select  = "<label for=\"$name\">{$optionGroupLabel[0]}\r\n";
		$select .= "<select name=\"$name\" id=\"$name\">\r\n";
	
			foreach($optionGroup as $optionValue) {
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
	
	/**
	* Textarea Input
	*/
	elseif($type == 'textarea') {
		return <<<TEXT_AREA
		<label for="$name">$label
    		<textarea name="$name" $atts</textarea>
        </label>
		
TEXT_AREA;

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
				$dataList .= "<option value=\"$optionValue\"> \r\n";
			}
		$dataList .= "</datalist>\r\n";
		
		return $dataList;
		
	} 
	
	/**
	* Radio & Checkbox input
	*/
	elseif($type == 'radio' || $type == 'checkbox'){
		$optionGroupLabel = explode(': ', $label); // Grab the name for the label
		$optionGroupLabel[0] = str_replace(array( '[', ']' ), '', $optionGroupLabel[0]); // Strip out array tags
		$optionGroup = explode(', ', $optionGroupLabel[1]); // Create an array from the submited values
		
		$input = "<label>{$optionGroupLabel[0]}</label>\r\n";
		
		foreach($optionGroup as $optionValue) {
				$valueName = str_replace(' ','', ucwords($optionValue)); // Create Camel Case value name
				$input .= "<br><label for\"$valueName\">$optionValue <input type=\"$type\" name=\"$name\" value=\"$valueName\" id=\"$optionValue\"></label> \r\n";
			}			
		return $input;
		
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
	$input .= "\"></output\r\n>";
	
	return $input;	
	}
	
	/**
	* Default Input (text, tel, email, color, etc)
	*/
	else {
		
	return <<<BUILD_INPUT
	<label>$label
	<input type="$type" name="$name" $atts >	
	</label>
	
BUILD_INPUT;
		
	} 
	
}

/**
* Google Recaptcha 
* == Should the lib be included inside the function?
*/
function yeti_recaptcha($publicKey) {
	require_once('Yeti-Input/recaptchalib.php');
	return recaptcha_get_html($publicKey);
}
/**
* Build the form
*/
function yeti_form($action = 'self', $method = 'POST', $atts = null) {
	
	if (strtolower($action) == 'self') {
		$action = $_SERVER['PHP_SELF']; 	
	} 
	
	$form  = "<form action=\"$action\" method=\"$method\" $atts>";
	
	return $form;
	
}

function yeti_end() {
	return '</form>';	
}