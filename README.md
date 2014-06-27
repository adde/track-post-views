WordPress Track Post Views
==========================

WordPress plugin that tracks and saves the number of post views as a post meta field.


Installation
------------
Download as zip. Unzip folder into `yoursite/wp-content/plugins`. Activate the plugin in WordPress admin.


Usage
-----
The plugin will automatically track post views after plugin activation. To get the number of views from a post use the following function:

    tpv_get_post_views( $post->ID );

To get the post meta field key use the following function:

    tpv_get_key();


License
-------
This software is free and carries a MIT license.


Changelog
---------
0.0.1 (2014-06-27)
* First release.