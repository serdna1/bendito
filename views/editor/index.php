<section class="editor-section">
  <div class="editor-bar">
    <form id="add-text-form">
      <input type="text" id="editor-text-input" value="Some Text">
      <input type="submit" value="Add text">
    </form>
    <button id="bold-button">B</button>
    <button id="pdf-button">Download as pdf</button>
    <button id="json-button">Download as JSON</button>
  </div>
  
  <div id="container"></div>
</section>

<?php 
  $script = "
    <script src='https://unpkg.com/konva@9/konva.min.js'></script>
    <script
      src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js'
      integrity='sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/'
      crossorigin='anonymous'
    ></script>
    <script src='/js/editor.js'></script>
  ";
?>
