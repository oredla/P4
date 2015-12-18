# CSCI E-15, P3, Kar Ho Lau

## Live URL
<http://p3.orangeedward.xyz>

## Description
The third assignment, P3, developed with Laravel to provide a set of web developer's tools.

## Demo
[http://screencast.com/t/bEALkFLE](http://screencast.com/t/bEALkFLE)

## Details for teaching team
No login required.

The page is structured by Bootstrap for styling.

**Breadcrumb** is fixed to the bottom of the page with bootstrap's `navbar-fixed-bottom`.

All HTML's FORM `input` are all setup with Validation Attributes (Client Side Validation), it set input to be number and set `min` and `max` accordingly. It is also utilizing the `validate()` function from Laravel to do a second validation for correct input (Server Side Validation).

## Tools
1. **Lorem Ipsum Generator**:
A generator for user to create dummy text as placeholder for designs on website, graphics, or publication.
  - `@parameter: number of paragraph(integer)`: enter an integer from 1 to 99 to generate number of paragraphs.

2. **Random User Generator**:
A generator that will help you to create dummy users with dummy information to populate a database for testing.
  - `@parameter: number of users(integer)`: enter an **integer from 1 to 99** to generate number of users
  - `@parameter: checks for options`: check off options available: Birthdate, Profile, Address, Phone Number, Email, and Password.
  - `@parameter: Bonus option for color`: check to have the generated user info displayed in random colors.  

3. **Permissions Calculator**:
A calculator to generate the octal notation from permissions input (encoding), as well as decoding an octal notation.
  * **Encoder**
    - `@parameter: checkboxes`: input from the permission checkbox will generate the Octal Notation.
  * **Decoder**
    - `@parameter: octal notation`: the inputted octal notation will be decoder to a permission table for user to understand easily.

4. **xkcd Password Generator**:
taken from P1, I had integrated the logic.php into XkcdController.php and separated the whole logic file into multiple functions. There are also other minor modification (i.e. switching from PureCSS to bootstrap) to retro fit, and cleaned up some of the coding. form action was changed from GET to POST.
  - `@parameter: number of words(integer)`: enter an **integer from 1 to 9** to generate the password from random words
  - `@parameter: checks for options`: check off options available: addNumber and addSymbol.
  - `@parameter: addSeparator (dropdown list)`: a dropdown list for different separator between the random words.

5. **Color Picker**: idea inspired by: [http://www.javascripter.net/faq/rgbtohex.htm](http://www.javascripter.net/faq/rgbtohex.htm)

  This is a tool to convert colors:
  * from **RGB to HEX**
    - `@parameter: integer 0-255`: number input for Red, Green, and Blue.  
  * from **HEX to RGB**
    - `@parameter: hex color`: 6 digit hexadecimal number will be converted to values for Red, Green, and Blue.
  * or pick a color from the **color palette** and convert it to RGB.
    - `@parameter: HTML type=color`: input using OS system's default color palette.
  * a special validation package was installed, [intervention/validation](https://github.com/Intervention/validation), to validate the user input for a hexadecimal number.



## CSS
* **main.css** includes general items that needs styling, with some `!important` added to override the default setting from Bootstrap
* **octal.css** enlarged the input/result box, put the octal selections on a different font (Roboto)
* **colorpicker.css** - specifically have some setup for the color picker, i.e. enlarging the input boxes and result box, providing the red/green/blue font color specifically for each for the color input.

## Laravel packages used
* `Lorem Ipsum Generator`: uses [badcow/lorem-ipsum](https://packagist.org/packages/badcow/lorem-ipsum)
* `Random User Generator`: uses [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker)
* `Color Picker`:
  * uses [hasbridge/php-color](https://packagist.org/packages/hasbridge/php-color) for color numbers conversion
  * Color Picker has a hexcolor validation, `Intervention Validation Class`, uses [intervention/validation](https://github.com/Intervention/validation)

## Outside code
* **Bootstrap**: [http://getbootstrap.com/](http://getbootstrap.com/) is used responsive page layout and handles all CSS for the forms.
* **Google Font API**: [Lato](https://www.google.com/fonts#QuickUsePlace:quickUse/Family:Lato), [Roboto](https://www.google.com/fonts#QuickUsePlace:quickUse/Family:Roboto)
