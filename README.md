# JetForm Progress Bar

Add a customizable progress bar to multi-step forms created with JetFormBuilder.

## Description

JetForm Progress Bar is an extension for JetFormBuilder that displays a progress bar while users complete multi-step forms. The progress bar updates automatically as users navigate through form steps.

## Features

- Visual progress bar for multi-step forms
- Color and height customization
- Seamless JetFormBuilder integration
- Support for multiple forms on the same page
- Fully responsive
- Lightweight and optimized code
- Multilingual support (English and Spanish included)

## Requirements

- WordPress 5.6 or higher
- JetFormBuilder 3.0 or higher
- PHP 7.4 or higher

## Installation

1. Upload the `jetform-progress-bar` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Make sure JetFormBuilder is installed and activated

## Usage

1. Create a multi-step form with JetFormBuilder
2. In the form editor, you'll find a sidebar box with the progress bar shortcode
3. Copy the shortcode and paste it where you want to display the progress bar
4. The basic shortcode is: `[jfb_progress_bar id="FORM_ID"]`

### Customization

You can customize the progress bar using the following shortcode attributes:

```
[jfb_progress_bar 
    id="123" 
    color="#4caf50" 
    background="#f3f3f3" 
    height="20px"
]
```

- `id`: Form ID (required)
- `color`: Progress bar color (optional, default: #4caf50)
- `background`: Background color (optional, default: #f3f3f3)
- `height`: Bar height (optional, default: 20px)

### Languages

The plugin is available in:
- English (default)
- Spanish (es_ES)

To add more translations, use the POT file in the `languages` folder.

## Support

To report issues or request new features, please use the [Issues section on GitHub](https://github.com/marcosarcu/JetFormBuilder-Progress-Bar/issues).

## License

This plugin is licensed under GPL v2 or later.

## Credits

Developed by [Marcos Arcusin](https://github.com/marcosarcu) 