=== Simple Breaks ===
Contributors: Hit Reach, JamieFraser
Donate link: 
Tags: html, br, hr, clear, simple html elements, simple breaks
Requires at least: 2.0
Tested up to: 3.5
Stable tag: 3.0.0

Simple Breaks adds in shortcodes for everyday html elements that normally get removed by visual mode

== Description ==

Simple Breaks adds in shortcodes for everyday html elements that normally get removed by visual mode allowing you to use them seamlessly with your WordPress content.

Currently the tags added in are:

* **br** - A line break
* **cl** - An empty div tag with clear:left attribute
* **cr** - An empty div tag with clear:right attribute
* **cb** - An empty div tag with clear:both attribute
* **hr** - A horizontal rule tag (hr)
* **sp** - An empty div which has a height set based on it's size attribute (in pixels) so size=10 translates as height=10px

== Usage ==

Place the shortcodes inside your post/page for the desired effect:

* **[br]** - Adds in a line break, accepts the attributes id and class.
* **[clearleft]** - does not allow content floating to the left of it, pushes all the content below it down, accepts the attributes id, class and span.
* **[clearright]** - does not allow content floating to the right of it, pushes all the content below it down, accepts the attributes id, class and span.
* **[clearboth]** - does not allow content floating to the left or the right of it, pushes all the content below it down, accepts the attributes id, class and span.
* **[hr]** - Horizontal Rule, draws a line across the page, accepts the attributes id, size class and color.
* **[space]** - Blank space, empty, nothing, pushes content down, accepts the attributes id, size and class.

The span attribute in **[clearleft]** **[clearright]** **[clearboth]** allows an override of the default tag used.  when span=false (default) the tag used will be a div, however when span=true the tag used will be a span.
for example [clearleft span=true] will use a span tag instead of a div tag, and [clearleft] will use a div tag as default

== Installation ==

Installation is Quick, just upload the Simple Breaks files to a Simple Breaks folder within wp-content/plugins and then activate the plugin through the admin dashboard, or find the plugin using the Wordpress plugin search and click install

== FAQ ==

= Q. Where can the plugin be used? =
Currently the plugin can be used anywhere that allows shortcodes.

= Q. How can I customise the elements? =
To customise the elements you can apply a css class using the "Class" attribute, or an ID using the "ID" attribute.

= My Question Is Not Answered Here! =
If your question is not listed here please look on: [http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/](http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/ "Simple Breaks") and if the answer is not listed there, just leave a comment!


== Change Log ==
= 1.0.0 =
Initial Release
= 2.0.0 = 
Tiny MCE buttons added
= 2.1.0 = 
Span tag override added to clears
= 2.1.3 =
Tiny MCE fix
= 2.2 =
Addition of options page for toggling on/off the tinyMCE editor buttons [Suggestion by Teresa via the Hit Reach site]
= 3.0.0 =
Updated for WordPress 3.5. Added option to size a space in any CSS unit value.