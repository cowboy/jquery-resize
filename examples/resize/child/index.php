<?PHP

include "../../index.php";
$base = '../../';

$shell['title3'] = "resize event";

$shell['h2'] = 'That\'s about the size of it..';

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" language="javascript">

<?= $shell['script']; ?>

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
  // Oops?
  if ( window == top ) {
    $('h2').show();
  }
  
  // Add text after inline "add text" links.
  $('.add_text').click(function(){
    $(this).parent().append( ' Adding some more text, to grow the parent container!' );
    return false;
  });
  
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
  width: auto;
}

#header, #footer {
  display: none;
}

html, body {
  background: #eee;
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
<h2 style="display:none">This page is part of a full example, <a href="../">click here to return!</a></h2>

<p class="test">
  <a href="#" class="add_text">Click this link to add text!</a> <em>Notice that the info box updates
  slowly, because the resize event is *not* being triggered manually.</em>
</p>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
