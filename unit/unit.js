// Not sure why this isn't set by default in qunit.js..
QUnit.jsDump.HTML = false;

$(function(){ // START CLOSURE

$('#jq_version').html( $.fn.jquery );

var is_132 = $.fn.jquery === '1.3.2',
  tests;

function next(){
  var test = tests.shift();
  test ? test() : start();
};
  
module( 'resize' );

test( 'block element', function() {
  expect( 9 );
  
  var div = $('<div style="width:200px;height:100px;line-height:1px"/>').appendTo('body'),
    div2 = $('<div/>').appendTo('body'),
    sizes = [];
  
  tests = [
    function(){
      div.add(div2).resize(function(e){
        var elem = $(this);
        sizes.push({ w: elem.width(), h: elem.height() });
      });
      
      setTimeout( next, 500 );
    },
    function(){
      equals( sizes.length, 0, 'event not yet fired' );
      
      div.resize();
      equals( sizes.length, 1, 'event should fire once' );
      equals( sizes[sizes.length-1].w, 200, 'size measured correctly' );
      equals( sizes[sizes.length-1].h, 100, 'size measured correctly' );
      
      next();
    },
    function(){
      div.animate({ width: 20, height: 10 }, 1000, function(){
        setTimeout(function(){
          ok( sizes.length > 2, 'event should fire multiple times' );
          equals( sizes[sizes.length-1].w, 20, 'size measured correctly' );
          equals( sizes[sizes.length-1].h, 10, 'size measured correctly' );
          
          next();
        }, 500);
      });
    },
    function(){
      sizes = [];
      div.css({ width: 40, height: 20 }).resize();
      
      setTimeout(function(){
        if ( is_132 ) {
          equal( sizes.length, 2, 'event will fire twice (use jQuery 1.4+)' );
        } else {
          equal( sizes.length, 1, 'event should only fire once' );
        }
        
        next();
      }, 500);
    },
    function(){
      sizes = []
      div.add(div2).unbind( 'resize' );
      div.css({ width: 200, height: 100 });
      
      setTimeout(function(){
        equal( sizes.length, 0, 'event shouldn\'t fire' );
        
        next();
      }, 500);
    },
    function(){
      div.remove();
      next();
    }
  ];
  
  stop();
  next();
});

test( 'inline element', function() {
  expect( 12 );
  
  var span = $('<span style="color:#fff">test</span>').appendTo('body'),
    sizes = [];
  
  tests = [
    function(){
      var w = span.width(),
        h = span.height();
      
      span.resize(function(e){
        var elem = $(this);
        sizes.push({ w: elem.width(), h: elem.height() });
      });
      
      equals( sizes.length, 0, 'event not yet fired' );
      
      span.resize();
      equals( sizes.length, 1, 'event should fire once' );
      equals( sizes[sizes.length-1].w, w, 'size measured correctly' );
      equals( sizes[sizes.length-1].h, h, 'size measured correctly' );
      
      next();
    },
    function(){
      span.html('this is some longer text');
      
      var w = span.width(),
        h = span.height();
      
      setTimeout(function(){
        equals( sizes.length, 2, 'event should fire once' );
        equals( sizes[sizes.length-1].w, w, 'size measured correctly' );
        equals( sizes[sizes.length-1].h, h, 'size measured correctly' );
        
        next();
      }, 500);
    },
    function(){
      span.html('this is some even longer text<br>this is some even longer text');
      
      var w = span.width(),
        h = span.height();
      
      setTimeout(function(){
        equals( sizes.length, 3, 'event should fire once' );
        equals( sizes[sizes.length-1].w, w, 'size measured correctly' );
        equals( sizes[sizes.length-1].h, h, 'size measured correctly' );
        
        next();
      }, 500);
    },
    function(){
      sizes = [];
      span.html('jQuery 1.4+ rocks!').resize();
      
      setTimeout(function(){
        if ( is_132 ) {
          equal( sizes.length, 2, 'event will fire twice (use jQuery 1.4+)' );
        } else {
          equal( sizes.length, 1, 'event should only fire once' );
        }
        
        next();
      }, 500);
    },
    function(){
      sizes = []
      span.unbind( 'resize' );
      span.html('test');
      setTimeout(function(){
        equal( sizes.length, 0, 'event shouldn\'t fire' );
        next();
      }, 500);
    },
    function(){
      span.remove();
      next();
    }
  ];
  
  stop();
  next();
});

if ( !window.opener ) {
  $('<h3>The Window resize tests can only happen in a JavaScript-opened popup window. <a href="#">Click here to open that window.</a></h3>')
    .insertBefore('#qunit-tests')
    .find('a')
      .click(function(){
        window.open( location.href, 'win', 'width=800,height=600,scrollbars=1,resizable=1' );
        return false;
      });
  
  return;
} else {
  $('#qunit-header a').attr( 'target', '_blank' );
}

test( 'window', function() {
  
  expect( 8 );
  
  var sizes = [],
    w = $(window).width(),
    h = $(window).height();
  
  tests = [
    function(){
      $(window).resize(function(e){
        var elem = $(this);
        sizes.push({ w: elem.width(), h: elem.height() });
      });
      
      equals( sizes.length, 0, 'event not yet fired' );
      
      $(window).resize();
      equals( sizes.length, 1, 'event not yet fired' );
      equals( sizes[sizes.length-1].w, w, 'size measured correctly' );
      equals( sizes[sizes.length-1].h, h, 'size measured correctly' );
      
      next();
    },
    function(){
      window.resizeBy( -100, -100 );
      
      setTimeout(function(){
        equals( sizes.length, 2, 'event should fire once' );
        equals( sizes[sizes.length-1].w, w - 100, 'size measured correctly' );
        equals( sizes[sizes.length-1].h, h - 100, 'size measured correctly' );
        
        next();
      }, 500);
    },
    // This behaves oddly in Chrome, and isn't even a meaningful test
    // anyways, so I'm commenting it out.
    /*function(){
      sizes = [];
      window.resizeTo( 400, 300 );
      $(window).resize();
      
      setTimeout(function(){
        if ( is_132 ) {
          equal( sizes.length, 2, 'event will fire twice (use jQuery 1.4+)' );
        } else {
          equal( sizes.length, 1, 'event should only fire once' );
        }
        next();
      }, 500);
      
    },*/
    function(){
      sizes = []
      $(window).unbind( 'resize' );
      window.resizeBy( 100, 100 );
      
      setTimeout(function(){
        equal( sizes.length, 0, 'event shouldn\'t fire' );
        
        next();
      }, 500);
    }
  ];
  
  stop();
  next();
});

}); // END CLOSURE