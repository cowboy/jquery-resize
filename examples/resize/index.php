<?PHP

include "../index.php";

$shell['title3'] = "resize event";

$shell['h2'] = 'That\'s about the size of it..';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  // Bind the resize event. When any test element's size changes, update its
  // corresponding info div.
  $('.test').resize(function(){
    var elem = $(this);
    
    // Update the info div width and height - replace this with your own code
    // to do something useful!
    elem.closest('.container').find('.info')
      .text( this.tagName + ' width: ' + elem.width() + ', height: ' + elem.height() );
  });
  
  // Update all info divs immediately.
  $('.test').resize();
  
  // Add text after inline "add text" links.
  $('.add_text').click(function(e){
    e.preventDefault();
    $(this).parent().append( ' Adding some more text, to grow the parent container!' );
  });
  
  // Resize manually when the link is clicked, but only for the first paragraph.
  $('.add_text:first').click(function(){
    $(this).parent().resize();
  });
});
<?
$shell['script1'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$(function(){
  // Append an iFrame to the page.
  var iframe = $('<iframe src="./child/" scrolling="no"/>').insertAfter('#iframe-info');
  
  // Called once the Iframe's content is loaded.
  iframe.load(function(){
    // The Iframe's child page BODY element.
    var iframe_content = iframe.contents().find('body');
    
    // Bind the resize event. When the iframe's size changes, update its height as
    // well as the corresponding info div.
    iframe_content.resize(function(){
      var elem = $(this);
      
      // Resize the IFrame.
      iframe.css({ height: elem.outerHeight( true ) });
      
      // Update the info div width and height.
      $('#iframe-info').text( 'IFRAME width: ' + elem.width() + ', height: ' + elem.height() );
    });
    
    // Resize the Iframe and update the info div immediately.
    iframe_content.resize();
  });
});
<?
$shell['script2'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$(function(){
  // Bind the resize event. When the window size changes, update its corresponding
  // info div.
  $(window).resize(function(){
    var elem = $(this);
    
    // Update the info div width and height - replace this with your own code
    // to do something useful!
    $('#window-info').text( 'window width: ' + elem.width() + ', height: ' + elem.height() );
  });
  
  // Updates the info div immediately.
  $(window).resize();
});
<?
$shell['script3'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../jquery.ba-resize.js"></script>
<script type="text/javascript" language="javascript">

<?= $shell['script1']; ?>
<?= $shell['script2']; ?>
<?= $shell['script3']; ?>

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  max-width: 700px;
  width: 100%;
}

.container {
  position: relative;
}

.test {
  background: #eee;
}

.info {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.2em 0.4em;
  margin: 2px 2px 0 1em;
  color: #913D00;
  border: 1px solid #913D00;
  background: #FDEBDC;
  -moz-box-shadow: 0px 2px 2px #ccc;
  -webkit-box-shadow: 0px 2px 2px #ccc;
  box-shadow: 0px 2px 2px #ccc;
}

#window-info {
  position: fixed;
  _position: absolute;
  top: 2px;
}

#content .info {
  margin-top: 0;
}

.floaty .info {
  float: right;
  position: static;
}

textarea,
iframe {
  width: 50%;
  height: 7em;
}

iframe {
  overflow: hidden;
  border: 1px solid #000;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>
<?= $shell['donate'] ?>

<p>
  With <a href="http://benalman.com/projects/jquery-resize-plugin/">jQuery resize event</a>, you can now bind
  resize event handlers to elements other than window, for super-awesome-resizing-greatness!
</p>

<h2>The resize event on block and inline elements</h2>

<h3>Paragraph (block)</h3>
<div class="container floaty clear">
  <div class="info">N/A</div>
  <p class="test">
    <a href="#" class="add_text">Click this link to add text!</a> <em>Notice that the info box updates
    immediately, because the resize event is being triggered manually on click with <code>.resize()</code>. Resize
    the browser window to be smaller with the mouse to see the info box update more slowly.</em>
  </p>
</div>

<h3>Span (inline)</h3>
<div class="container floaty">
  <div class="info">N/A</div>
  <p>
    <span class="test">
      <a href="#" class="add_text">Click this link to add text!</a> <em>Notice that the info box updates
    slowly, because the resize event is *not* being triggered manually.</em>
    </span>
  </p>
</div>

<h3>Textarea (block)</h3>
<div class="container">
  <div class="info">N/A</div>
  <textarea class="test">Drag to resize in Safari or Chrome. Notice that the info box updates slowly, because the resize event is *not* being triggered manually. (How could it? You're dragging a proprietary browser control!)</textarea>
</div>

<h3>The code</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script1'] ); ?>
</pre>

<h2>Resizing an Iframe as its content grows</h2>

<p>
  While this isn't the best approach to <a href="http://benalman.com/projects/jquery-postmessage-plugin/">cross-domain Iframe resizing</a>,
  it is definitely useful for same-domain Iframes. The best part about this approach is that since all of the resizing
  code is handled in the parent frame, the child page doesn't need to be modified.
</p>
<div class="container">
  <div class="info" id="iframe-info">N/A</div>
</div>

<h3>The code</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script2'] ); ?>
</pre>

<h2>A throttled resize event on the window object</h2>

<div class="info" id="window-info">N/A</div>
<p>
  By default, the window resize event is throttled, making event behavior consistent across all elements (this can be disabled by setting <a href="http://benalman.com/code/projects/jquery-resize/docs/files/jquery-ba-resize-js.html#jQuery.resize.throttleWindow"><code>jQuery.resize.throttleWindow</code></a> property to <code>false</code>).
</p>
<p>
  Just watch the "window" info box in the top right of the page as you resize the window to see how the event fires.
</p>

<h3>The code</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script3'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
