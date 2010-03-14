# jQuery resize event #
[http://benalman.com/projects/jquery-resize-plugin/](http://benalman.com/projects/jquery-resize-plugin/)

Version: 1.1, Last updated: 3/14/2010

With jQuery resize event, you can bind resize event handlers to elements other than window, for super-awesome-resizing-greatness!

Note that while this plugin works in jQuery 1.3.2, if an element's event callbacks are manually triggered via .trigger( 'resize' ) or .resize() those callbacks may double-fire, due to limitations in the jQuery 1.3.2 special events system. This is not an issue when using jQuery 1.4+.
  
Visit the [project page](http://benalman.com/projects/jquery-resize-plugin/) for more information and usage examples!


## Documentation ##
[http://benalman.com/code/projects/jquery-resize/docs/](http://benalman.com/code/projects/jquery-resize/docs/)


## Examples ##
This working example, complete with fully commented code, illustrates a few
ways in which this plugin can be used.

[http://benalman.com/code/projects/jquery-resize/examples/resize/](http://benalman.com/code/projects/jquery-resize/examples/resize/)  

## Support and Testing ##
Information about what version or versions of jQuery this plugin has been
tested with, what browsers it has been tested in, and where the unit tests
reside (so you can test it yourself).

### jQuery Versions ###
1.3.2, 1.4.1, 1.4.2

### Browsers Tested ###
Internet Explorer 6-8, Firefox 2-3.6, Safari 3-4, Chrome, Opera 9.6-10.1.

### Unit Tests ###
[http://benalman.com/code/projects/jquery-resize/unit/](http://benalman.com/code/projects/jquery-resize/unit/)


## Release History ##

1.1 - (3/14/2010) Fixed a minor bug that was causing the event to trigger immediately after bind in some circumstances. Also changed $.fn.data to $.data to improve performance.  
1.0 - (2/10/2010) Initial release


## License ##
Copyright (c) 2010 "Cowboy" Ben Alman  
Dual licensed under the MIT and GPL licenses.  
[http://benalman.com/about/license/](http://benalman.com/about/license/)
