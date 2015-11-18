<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <style>
      body { 
        width: auto;
        background-size: 10px 10px;
        font-family: sans-serif; 
        font-size: 1.1em; 
        background-color: #F1F1F1; 
        color: #222; 
      }
      input[type="text"] { padding: 4px 6px; }
      input[type="submit"] { padding: 4px; font-size: 1.2em; }
      ul li {
        list-style: none;
        display: inline-block;
        cursor: pointer;
        margin: 10px 20px 0 0;
        opacity: 0.5;
        transition: all 0.2s ease-out;
      }

      ul li:hover {
        opacity: 1;
      }
    </style>
    <script>
    window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!(!t.document.createElementNS||!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||window.opera&&-1===navigator.userAgent.indexOf("Chrome")),o=function(o){var r=t.document.createElement("link"),a=t.document.getElementsByTagName("script")[0];r.rel="stylesheet",r.href=e[o&&n?0:o?1:2],a.parentNode.insertBefore(r,a)},r=new t.Image;r.onerror=function(){o(!1)},r.onload=function(){o(1===r.width&&1===r.height)},r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};
    </script>
    </head>
    <body>
        <div id="tdsk_dialog_wrapper">
          <center><h3>Click on an icon to insert into post</h3>
            <ul id="icons"></ul>
            <hr>
            <form>
                <label for="dumb_shortcode_text">Insert Custom Icon Code</label><br />
                <input type="text" name="grunticon" /><br /><br />
                <input type="submit" value="Insert Icon" />
            </form>
            </center>
        </div>

        <script type="text/javascript">
            var passed_arguments = top.tinymce.activeEditor.windowManager.getParams();

            var $ = passed_arguments.jquery;
            var jq_context = document.getElementsByTagName("body")[0];
            var icons = passed_arguments.icons;
            var hook = new Function(passed_arguments.grunticonHook);


            function returnShortcode(icon) {
              var shortcode = '[grunticon';
              icon = icon.replace('icon-','');

              if( icon != "" ) {
                  shortcode += ' icon="' + icon + '"';
              }
              shortcode += ']';
              passed_arguments.editor.selection.setContent(shortcode);
              passed_arguments.editor.windowManager.close();
            }

            $("form", jq_context).submit(function(event) {
                    event.preventDefault();
                    var input_text = $("input[name='grunticon']", jq_context).val();

                    var shortcode = '[grunticon';

                    if( input_text != "" ) {
                        shortcode += ' icon="' + input_text + '"';
                    }

                    shortcode += ']';

                    passed_arguments.editor.selection.setContent(shortcode);
                    passed_arguments.editor.windowManager.close();
            });

            $("#icons", jq_context).append(function() {
              var template = '<li id="ICONNAME" class="ICONNAME" style="width: 60px; height: 60px;"></li>';
              var renderedIcons = [];
              hook();
              icons = icons.split(',');
              
              for (var i = 0; i < icons.length; i++) {
                var newTemplate = template.replace(/ICONNAME/g, icons[i]);

                newTemplate = $(newTemplate).click(function() {
                  var icon = $(this).attr('id');
                  returnShortcode(icon);
                });

                renderedIcons.push(newTemplate);
              }

              return renderedIcons;
            });

        </script>
    </body>
</html>
