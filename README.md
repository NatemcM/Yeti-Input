Yeti Input
==========

Yeti Input is a simple function which creates valid HTML inputs, helping make your code easier to read and faster to write. 

## Creating Form Inputs

Yeti Input supports a number of parameters, these are:

* Type: Type of input i.e. Text, Color, Tel, Email
* Name: Name of the input (`<input name="$name">`)
* Label: Description for the label i.e. Please enter your name
* Attributes: Allows you to define extra attributes i.e. class="input text", required, autocomplete, etc
	* When adding extra input attributes separate with a whitespace only 

Creating input fields is as simple as:

	<?= yeti_input('text', 'firstName', 'Please enter your first name', 'class="input text" required autocomplete) ?>
	
This will output: 

	<label for="firstName">Please enter your first name
		<input type="text" name="firstName" class="input text" required autocomplete>
	</label>
	
### Creating Options

Just like a text field, a select field can be created like this: 

	<?= yeti_input('select', 'cities', 'Please Choose A City: Belfast, (London), Liverpool, Kathmandu, Bath, Dublin, Glasgow, New York, Derry'); ?>
	
In the label param add your custom label followed by a `:` (colon) then just separate the list parameters with a `,` (comma). If you want a pre-selected option wrap it in `()` 
 
This will output: 
 
	<label for="cities">Please Choose A City
		<select name="cities" id="cities">
			<option value="Belfast">Belfast</option>
			<option value="London" selected>London</option>
			<option value="Liverpool">Liverpool</option>
			<option value="Kathmandu">Kathmandu</option>
			<option value="Bath">Bath</option>
			<option value="Dublin">Dublin</option>
			<option value="Glasgow">Glasgow</option>
			<option value="NewYork">New York</option>
			<option value="Derry">Derry</option>
		</select>
	</label>
	
### Radio and Checkbox Inputs 

Creating radio buttons and checkboxes is as simple as creating a dropdown field:

##### Radio Button

	<?= yeti_input('radio', 'rating', 'Please rate our service: really really good, sort of good, good, bad, really bad, really really bad'); ?>
	
Outputs: 
	
	<label>Please rate our service</label>
	<input type="radio" name="rating" value="ReallyReallyGood">really really good 
	<input type="radio" name="rating" value="SortOfGood">sort of good 
	<input type="radio" name="rating" value="Good">good 
	<input type="radio" name="rating" value="Bad">bad 
	<input type="radio" name="rating" value="ReallyBad">really bad 
	<input type="radio" name="rating" value="ReallyReallyBad">really really bad  
	
##### Checkbox

Note the use of `[]` brackets to define an array, these can also be used in text inputs.

	<?= yeti_input('checkbox', 'activities[]', 'Please select the activities you enjoy: running, walking, jumping, cycling, climbing, rowing, sailing, eating'); ?>

Outputs:

	<label>Please select the activities you enjoy</label>
	<input type="checkbox" name="activities[]" value="Running">running 
	<input type="checkbox" name="activities[]" value="Walking">walking 
	<input type="checkbox" name="activities[]" value="Jumping">jumping 
	<input type="checkbox" name="activities[]" value="Cycling">cycling 
	<input type="checkbox" name="activities[]" value="Climbing">climbing 
	<input type="checkbox" name="activities[]" value="Rowing">rowing 
	<input type="checkbox" name="activities[]" value="Sailing">sailing 
	<input type="checkbox" name="activities[]" value="Eating">eating 


### HTML5

Yeti Input also has limited support for HTML5 form elements such as Datalist 

	<?= yeti_input('datalist', 'browsers', 'Please select a browser: Firefox, Internet Explorer, Chrome, Opera'); ?>
	
This will output:

	<label>Please select a browser</label>	
	<input list="browsers" name="browsers">
	<datalist id="browsers">
		<option value="Firefox">
		<option value="Internet Explorer">
		<option value="Chrome">
		<option value="Opera">
	</datalist>
	
### Submitting Forms

Creating submit buttons is easy as anything: 

	<?= yeti_input('submit', 'submit', 'This is a submit button'); ?>
	
This will output: 

	<input type="submit" value="This is a submit button" name="submit" >
	
# To Do

* More support for HTML5 Elements
* Add an ID param (without going overboard on the accepted parameters)
* Possibly look into creating an all encompassing form builder like RORs

# Version 

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
