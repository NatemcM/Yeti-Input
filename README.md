Yeti Input
==========

Yeti Input is a bunch of simple functions which creates valid HTML inputs, helping make your code easier to read and faster to write. 

## Creating Forms

Creating forms is simple, to start off simply write

	<?= _form(); ?>

This will create the following markup

	<form action="/index.php" method="POST" enctype="application/x-www-form-urlencoded">The `_form` function accepts the following parameters:

*  `$action`: Defaults to `$_SERVER['PHP_SELF']` 
*  `$method`: Defaults to `_POST`
*  `$atts`
*  `$enctype`: Defaults to `application/x-www-form-urlencoded`
*  `$honeypotName`
*  `$honeypotValue`

## Form Inputs

The `$atts` parameter accepts additional information about the input, for example:

* Separate different attributes with a `,` (comma)
* Group similar attributes together i.e. `.class .class .class` (don't separate grouped attributes with a comma)

i.e. 

	<?= _input('text', 'fname', 'Please enter your first name: ', '.input .text, #firstnameInput, required'); ?>
	
will output:

		<label>Please enter your first name: 
		<input type="text" name="name" id="firstnameInput" class="input text" required >
		</label>
		


### _Input

	<?= _input($type, $name, $label, $atts); ?>
 
Outputs

	<label>$label
		<input type="$type" name="$name" $atts >
	</label>
		
### _textarea

	<?= _textarea($name, $label, $atts); ?>
	
Outputs

	<label for="$name">$label
		<textarea name="$name" $atts ></textarea>
	</label> 
	
### _radio

 `_radio` accepts parameters called `$items` and `$break`, add items to your radio button by separating each one with a comma. Choose how to separate your radios with `$break` (defaults to `<br>`)

	<?= _radio('activities', 'Please select an activity: ', 'Running, Jumping, Swimming, Cycling', 'li', '.radio .input'); ?>
	
Outputs 

	<label>Please select an activity: </label>
	<li><label for="rdo_Running">Running <input type="radio" name="activities" value="Running" id="rdo_Running"></label> </li> 
	<li><label for="rdo_Jumping">Jumping <input type="radio" name="activities" value="Jumping" id="rdo_Jumping"></label> </li> 
	<li><label for="rdo_Swimming">Swimming <input type="radio" name="activities" value="Swimming" id="rdo_Swimming"></label> </li> 
	<li><label for="rdo_Cycling">Cycling <input type="radio" name="activities" value="Cycling" id="rdo_Cycling"></label> </li> 
	
The `_radio` function automatically adds `rdo_` to the item name creating a unique ID for each radio button

### _checkbox

	<?= _checkbox($name, $label, $items, $break, $atts); ?>

Outputs (Based on the radio input above)

	<label>Please select an activity: </label>
	<li><label for="cbx_Running">Running <input type="checkbox" name="activities" value="Running" id="cbx_Running"></label></li> 
	<li><label for="cbx_Jumping">Jumping <input type="checkbox" name="activities" value="Jumping" id="cbx_Jumping"></label></li> 
	<li><label for="cbx_Swimming">Swimming <input type="checkbox" name="activities" value="Swimming" id="cbx_Swimming"></label></li> 
	<li><label for="cbx_Cycling">Cycling <input type="checkbox" name="activities" value="Cycling" id="cbx_Cycling"></label></li> 
	
To create an array of items just place `[]` after the name parameter (But before the comma (no spaces!)) i.e. `activites[]` or `$name[]` 
	
### _select

	<?= _select($name, $label, $items, $atts); ?>
	
Like the radio and checkbox functions the `_select` function accepts different items sepereated by commas, to preset a value place the value in parenthesise i.e. `'Running, Jumping, (Cycling), Swimming'`. Cycling will be preselected.

Outputs (Based on the radio input above)

		<label for="activities">Please select an activity: 
			<select name="activities" id="activities">
				<option value="Running">Running</option>
				<option value="Jumping">Jumping</option>
				<option value="Swimming">Swimming</option>
				<option value="Cycling">Cycling</option>
			</select>
		</label>

### _datalist

Accepts: `$name, $label, $items, $atts`

	<?= _datalist('datalist', 'Select a browser', 'Internet Explorer, Firefox, Google Chrome, Opera'); ?>
	
Outputs 

	<label>Select a browser</label>
	<input list="datalist" name="datalist">
		<datalist id="datalist">
			<option value="Internet Explorer">
			<option value="Firefox">
			<option value="Google Chrome">
			<option value="Opera">
		</datalist>
### _button 

	<?= _button($type, $name, $value, $atts); ?>
	
Outputs 

	<button type="$type" name="$name" $atts >$value</button>
	
### _keygen

	<?= _keygen($name, $label, $atts); ?>
	
Outputs 

	<label>$label
		<keygen name="$name" $atts >	
	</label>
	
### _numrange

	<?= _numrange($name, $label, $min, $max, $atts); ?>
	
Could output

	 <label>Adjust the slider
	<input type="range" name="numberRange" min="0" max="250" class="range input" >
	</label>

### _number

	<?= _number($name, $label, $min, $max, $step, $value, $atts); ?>
	
Could output 

	<label>Select a numebr between 0 and 250
	<input type="number" name="number" min="0" max="250" step="10" value="25" class="number input" >
	</label>
	
### _output

	<?= _output($name, $values, $atts); ?>
	
### _endForm

	<?= _endForm(); ?>
	
Outputs `</form>`, could be easier just to type `</form>`.
 

### _recaptcha

	<?= _recaptcha($publicKey, $path); ?>
	
This will automatically add in Googele Recaptcha, just make sure that `$path` is the path to your Google Recaptcha script.
	
# To Do

* Possibly look at creating a class rather than individual functions

# Version 

* 0.2.0
	* Complete rewrite of code, segmenting inputs into new functions 
	* Added support for classes and IDs within the $atts parameter
	* Added support for Google Recaptcha 
	* Added list break support for radio and checkbox inputs  
	* Complete rewrite of documentation 
* 0.1.4
	* Added support for keygen input
	* Added support for output tag 
	* Better support for number input (set a default value)
	* Changed radio and checkboxes to use labels and separate each by `<br>` 
* 0.1.3 
	* Added pre-selected value for dropdown
	* Removed required and class params
	* Added $atts param, this allows more flexibility when defining extra attributes such as required, class, id max, min, etc
	* Update datalist syntax to match select syntax
	* Fixed the datalist output so it actually passes a name to the input 
* 0.1.2
	* Added support for radio and checkbox inputs
	* Removed `[]` in labels and ids when calling an array of inputs 
* 0.1.1
	* Added `for` attribute to labels
	* Added input `id`'s which correspond with the label `for` attribute 
	* Added label for select element 
	* Changed the select list separator from `:` to `,`
	* Name the select element label using `:` 	 
* 0.1.0 - Initial Release 
