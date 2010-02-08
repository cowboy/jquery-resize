// Not sure why this isn't set by default in qunit.js..
QUnit.jsDump.HTML = false;

$(function(){ // START CLOSURE


module( 'foo' );

test( 'bar', function() {
  expect( 1 );
  
  var result = 1;
  equals( result, 1, 'result should be 1' );
});


}); // END CLOSURE