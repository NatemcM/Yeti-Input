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
* Copyright (c) <2014> <Nathanael McMillan>
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
*THE SOFTWARE.
*/

function yeti_input($type = 'text', $name, $label, $class = null, $require = null) {
	
	$type = strtolower($type);

	if(!empty($require)){
		$require = 'required';	
	}
	
	if(!empty($class)) {
		$class = "class=\"$class\" ";	
	}
	
	if($type == 'submit') {
		return <<<BUILD_OUTPUT
		<input type="submit" value="$label" name="$name" $class $require/>
		
BUILD_OUTPUT;

	} 
	
	elseif($type == 'select'){
		$select = "<select name=\"$name\">\r\n";
		
		$optionGroup = explode(': ', $label); // Create and array from the submited values
		
			foreach($optionGroup as $optionValue) {
				$valueName = str_replace(' ','', ucwords($optionValue)); // Creat Camel Case value name
				$select .= "<option value=\"$valueName\">$optionValue</option>\r\n";
			}
		$select .= "</select>";
		
		return $select;
	} 
	
	elseif($type == 'textarea') {
		return <<<TEXT_AREA
		<label>$label
    		<textarea name="$name" $class $require></textarea>
        </label>
		
TEXT_AREA;

	} 
	
	elseif($type == 'datalist') {
		$dataList = "<input list=\"$name\">\r\n";
		$dataList .= "<datalist id=\"$name\">\r\n";
		$optionGroup = explode(': ', $label); // Create and array from the submited values
		foreach($optionGroup as $optionValue) {
				$dataList .= "<option value=\"$optionValue\">\r\n";
			}
		$dataList .= "</datalist> ";
		
		return $dataList;
		
	} 
	
	else {
	return <<<BUILD_INPUT
	<label>$label
	<input type="$type" name="$name" $class $require />	
	</label>
	
BUILD_INPUT;

	} 
	
}