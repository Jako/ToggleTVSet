# Usage

Example use case: In one of your templates you want to be able to select one of
four different headers. Each type of header needs one or more TVs but you only
want to show the TVs needed for the selected type of header. Inside your
template you want to use different chunks for templating.

!!! danger "Don't misuse this extra"

    Please don't misuse this extra and assign all TVs to all templates and hide 
    them by the default value of a toggling TV. This could cause speed problems 
    in the backend and also in the frontend because the template variable 
    handling is not that effective i.e. in the getResources snippet.

## Example Setup

You have four different headers (Simple, Jumbotron, Carousel, Cover). For each
one of them you use different TVs.

### Step 1 - Create your header TVs

#### Simple Header TV

* Header_Headline (6) - a simple Text TV

#### Jumbotron TVs

* Jumbotron_Background_Color (7) - Colorpicker TV
* Jumbotron_Background_Image (8) - Image TV
* Jumbotron_RTE (9) - Richtext TV

#### Carousel TVs

* Carousel_Gallery (10) - MIGX TV

#### Cover TVs

* Cover_Background_Image (11) - Image TV
* Cover_RTE (12) - Richtext TV

#### Header Select TV

Header (13) - ToggleTV (or before version 2.0.0: Single Select TV)

* Input Option Values: `Standard==6||Jumbotron==7,8,9||Carousel==10||Cover==11,12`
* Default: `6`
* Allow Blank: `false` (before version 2.0.0)
* Enable typeahead: `false` (before version 2.0.0)

Give each input option a label and add the IDs of the TVs used as comma
separated values.

!!! note "Be careful with the value"

    Be careful not to add empty spaces inside the value!
    
    ```
    Bad: "Standard==6||Jumbotron== 7 , 8, 9 ||Carousel==10||Cover==11,12"
    Good: "Standard==6||Jumbotron==7,8,9||Carousel==10||Cover==11,12"
    ```

### Step 2 - Fill the MODX system setting

!!! note "Optional"

    This is only needed before 2.0.0 or when you don't use a Toggle TV. 

Locate the `toggletvset.toggletvs` MODX system setting and fill it with the ID
of the Header Select TV.

!!! note "ID numbers are examples"

    The ID numbers of the template variables in the example are just for
    demonstation and can be different in your installation.

## Output Filter

### getTVLabel

This output filter retrieves the label of a corresponding TV value.

If you have a selectTV with these input options

```
Standard==4||Carousel==8||Cover==9,10||Jumbotron==5,6,7
```

you could use the following call i.e. in the template

```
[[$[[*selectTV:getTVLabel]]]]
```

This will be replaced by the MODX parser to i.e.
`[[$Standard]]` if the value of `[[*selectTV]]` is `4`.

If you are working in getResources/pdoResources, etc. and your TV is prefixed, 
use it like this:

```
[[+tv.selectTV:getTVLabel=`tv.`]]
```

### getTVNames

This output filter retrieve names of TVs from a list of TV IDs. You could get
the TV names of the corresponding TV value with it.

Example usage:

```
&includeTVs=`[[*selectTV:getTVNames]]`
```

## System Settings

ToggleTVSet uses the following system settings in the namespace `toggletvset`:

Key | Description | Default
----|-------------|--------
toggletvset.toggletvs | (Only needed before 2.0.0 or when you don't use a Toggle TV) Comma separated list of template variable IDs that should toggle the visibility of other template variables. | -
toggletvset.toggletvs_clearhidden | Clear template variables that are hidden by ToggleTVSet. | No
toggletvset.debug | Log debug information in the MODX ystem log. | No
