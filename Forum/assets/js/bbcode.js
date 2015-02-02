//$(function() {

   function bbcode_b() {
      
      wrapText("post_content", "[b]", "[/b]");
      
   }
   
   function bbcode_i() {
      
      wrapText("post_content", "[i]", "[/i]");
      
   }
   
   function bbcode_u() {
      
      wrapText("post_content", "[u]", "[/u]");
      
   }

   function bbcode_code() {
      
      wrapText("post_content", "[code]", "[/code]");
      
   }
   
   function bbcode_link() {
      
      wrapText("post_content", "[link]", "[/link]");
      
   }
   
   function bbcode_quote() {
      
      wrapText("post_content", "[quote]", "[/quote]");
      
   }
   
   function bbcode_img() {
      
      wrapText("post_content", "[img]", "[/img]");
      
   }
   
   function bbcode_youtube() {
      
      wrapText("post_content", "[youtube]", "[/youtube]");
      
   }

   function wrapText(elementID, openTag, closeTag) {
       var textArea = $('#' + elementID);
       var len = textArea.val().length;
       var start = textArea[0].selectionStart;
       var end = textArea[0].selectionEnd;
       var selectedText = textArea.val().substring(start, end);
       var replacement = openTag + selectedText + closeTag;
       textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
   }

//});
