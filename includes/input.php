<!DOCTYPE html>

<html lang="en">
    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <!-- http://sourcefoundry.org/hack/ -->
        <link href="css/hack-extended.min.css" rel="stylesheet"/>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="js/jquery-1.11.3.min.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script>

function strip_tags(input, allowed) {
  //  discuss at: http://phpjs.org/functions/strip_tags/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Luke Godfrey
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Pul
  //    input by: Alex
  //    input by: Marc Palau
  //    input by: Brett Zamir (http://brett-zamir.me)
  //    input by: Bobby Drake
  //    input by: Evertjan Garretsen
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Eric Nagel
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Tomasz Wesolowski
  //  revised by: Rafał Kukawski (http://blog.kukawski.pl/)
  //   example 1: strip_tags('<p>Kevin</p> <br /><b>van</b> <i>Zonneveld</i>', '<i><b>');
  //   returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
  //   example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
  //   returns 2: '<p>Kevin van Zonneveld</p>'
  //   example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
  //   returns 3: "<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>"
  //   example 4: strip_tags('1 < 5 5 > 1');
  //   returns 4: '1 < 5 5 > 1'
  //   example 5: strip_tags('1 <br/> 1');
  //   returns 5: '1  1'
  //   example 6: strip_tags('1 <br/> 1', '<br>');
  //   returns 6: '1 <br/> 1'
  //   example 7: strip_tags('1 <br/> 1', '<br><br/>');
  //   returns 7: '1 <br/> 1'

  allowed = (((allowed || '') + '')
      .toLowerCase()
      .match(/<[a-z][a-z0-9]*>/g) || [])
    .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '')
    .replace(tags, function($0, $1) {
      return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

            jQuery(function($) {

                // focus on input
                $('#input').focus();
 
                // remove formatting from input
                $('#input').on('input', function(eventObject) {
                });

                // onclick
                $('button').click(function(eventObject) {

                    // validate input
                    var input = $('#input').text().trim();
                    if (input === '') {
                        $('#input').removeClass('alert-danger alert-success').addClass('alert-warning');
                        return;
                    }

                    // POST input
                    $.ajax({
                        contentType: 'application/json',
                        data: JSON.stringify(input.split(/\r?\n/)),
                        dataType: 'json',
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#input').removeClass('alert-success alert-warning').addClass('alert-danger');
                        },
                        method: 'POST',
                        success: function(data, textStatus, jqXHR) {
                            $('#input').removeClass('alert-danger alert-warning').addClass('alert-success');
                            $('#input').removeAttr('contenteditable');
                            var input = $('#input').html().split(/\r?\n/);
                            $.each(data, function(propertyName, valueOfProperty) {
                                var i = parseInt(propertyName);
                                input[i] = '<span data-content="hi" data-toggle="popover">' + input[i] + '</span>';
                            });
                            $('#input').html(input.join('\n'));
                            $('[data-toggle="popover"]').popover({
                                trigger: 'hover'
                            });
                        }
                    });
                });

            });

        </script>

        <style>
            
            body {
                font-family: Hack, monospace;
                margin: 50px;
            }

            #input {
                min-height: 6em;
            }

            #input span[data-toggle="popover"] {
                border-bottom: 1px dotted #000;
                cursor: pointer;
            }

        </style>

        <title>CS50 Help</title>

    </head>
    <body>
        <div class="container">
            <div class="form-group">
                <pre contentEditable="true" id="input"></pre>
            </div>
            <button class="btn btn-default" type="submit">help50</button>
        </div>
    </body>
</html>