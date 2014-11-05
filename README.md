Yeti Input
==========

Yeti Input is a simple function which creates valid HTML inputs, helping make your code easier to read and faster to write. 

## Creating Form Inputs

Yeti Input supports a number parameters, these are:

* Type: Type of input i.e. Text, Color, Tel, Email
* Name: Name of the input (`<input name="$name">`)
* Label: Description for the label i.e. Please enter your name
* Class: Add a class to the input field 
* Required: This field is required i.e. (`<input type="text" required>`)

Creating input fields is as simple as:

	<?= yeti_input('text', 'firstName', 'Please enter your first name', 'input text', 'r') ?>
	
This will output: 

	<label>Please enter your first name
	<input type="text" name="firstName" class="input text"  required />
	</label>
	
### Creating Options

Just like a text field, a select field can be created like this: 

	<?= input('select', 'select', 'This: Is: A: Dropdown menu: Its nice you know'); ?>
	
Just separate the label param with a `:` (colon).
 
This will output: 
 
	<select name="select"> 
		<option value="This">This</option> 
		<option value="Is">Is</option>
		<option value="A">A</option>
		<option value="DropdownMenu">Dropdown menu</option>
		<option value="ItsNiceYouKnow">Its nice you know</option>
	</select> 
	
### HTML5

Yeti Input also has limited support for HTML5 form elements such as Datalist 

	<?= input('datalist', 'companies', 'Firefox: Internet Explorer: Chrome: Opera'); ?>
	
This will output:

	<input list="companies">
	<datalist id="companies">
		<option value="Firefox">
		<option value="Internet Explorer">
		<option value="Chrome">
		<option value="Opera">
	</datalist>
	
### Submitting Forms

Creating submit buttons is easy as anything: 

	<?= input('submit', 'submit', 'This is a submit button'); ?>
	
This will output: 

	<input type="submit" value="This is a submit button" name="submit"  />
	
# To Do

* More support for HTML5 Elements
* Add an ID param (without going overboard on the accepted parameters)
* Possibly look into creating an all encompassing form builder like RORs