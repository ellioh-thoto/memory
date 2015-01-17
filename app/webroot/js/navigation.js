/**
 * Created by elron on 15/01/15.
 */

var selected = 'none';
var selected_filename = '';
$(document).ready(function () {


    // Load selected item

    AjaxLoadArticle();

    // On click dislay selected content
    $('.left_menu_item').click(function () {
        AjaxLoadArticle($(this).text());
    });

    /*
     * Manage Ajax calls
     */
    $('.ajax').on('click', function () {

        console.log('eth : passed  ');
        /* todo : Pass data with POST. ADD security key */
        $.get($(this).attr('href') + '/' + btoa(selected_filename) + '/' + btoa($(selected).text()),
            {},
            function (data) {
                alert("RETURN : " + data);
            });
        return false;
    });
});


/**
 * Load article by ajax
 * Set title
 */
function AjaxLoadArticle(filename){
    console.info('eth : load start...  ');
    var param;
    if(typeof filename === 'undefined')
        param = "";
    else
        param = "/" +btoa(filename);
    $.get('pages/load'+ param,
        {},
        function (data) {

            // Set textarea content

            var dataObject = jQuery.parseJSON(data);

            var editor = CKEDITOR.instances.editorx;
            editor.setData(dataObject.selectedFileContent);
            //$('#test').text(dataObject.selectedFileContent);
            console.info('eth : Article loaded! ');

            //$('.ckeditor').parent('div').hide();
            //$(selected).parent('div').show();

            // Display title of selected content

            $('#top-menu h1').text(dataObject.noteSelected);

        });

}