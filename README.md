dmChosenSelectJQueryPlugin for Diem Extended
===============================

Author: [TheCelavi](http://www.runopencode.com/about/thecelavi)
Version: 1.0
Stability: Stable  
Date: June 24th, 2013
Courtesy of [Run Open Code](http://www.runopencode.com)   
License: [Free for all](http://www.runopencode.com/terms-and-conditions/free-for-all)

dmChosenSelectJQueryPlugin for Diem Extended adds support for [jQuery Chosen](https://github.com/harvesthq/chosen)
select plugin for Choice and Doctrine Choice form widget. Can be added to front and to admin, as well as for public pages.

Settings and customization:
---------------------

Two widgets are available:

- sfWidgetFormDmChoiceChosen
- sfWidgetFormDmDoctrineChoiceChosen

Use them as regular sfWidgetForm* widgets in your forms. They extend basic widgets, and the add several more options:

- `no_results_text`:              No result text in search
- `theme`:                        CSS file to use for styling the chosen select
- `max_selected_options`:         Maximum available options to select, if select is multiple
- `placeholder_text_multiple`:    Placeholder text for multiple choices
- `placeholder_text_single`:      Placeholder text for single choice

Regaring theme, see 'config/dm/config.yml':

    default:
        dmChosenSelectJQueryPlugin:
            themes:
                admin: dmChosenSelectJQueryPlugin.admin


Under `themes` key, you can define your theme and provide path to CSS file. In this example, the path to the CSS file
is acquired via `assets.yml` setting, but you can provide a real path to CSS file (not recommended).

In `web` dir you can find LESS file to help you start with styling.

Usage in admin/form generator:
---------------------

To have these fields in admin, for your fields, add in schema.yml: `extra: choice_chosen` or `extra: doctrine_choice_chosen`.

Example:


        Testobj:
          actAs:
            DmSortable:
          columns:
            title:              { type: string(255), notnull: true }
            is_active:          { type: boolean, notnull: true, default: false }
            keywords:           { type: enum, values: ['val 1', 'val 2'] notnull: true, extra: choice_chosen }
            related_obj_id:     { type: int, notnull: true, extra: doctrine_choice_chosen }
