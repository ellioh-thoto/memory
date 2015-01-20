/**
 * Created by elron on 15/01/15.
 */

var selected_filename = 'none';
$(document).ready(function () {

    // Load selected item

    AjaxLoadArticle();

    // On click display selected content

    $('.left_menu_item').click(function () {
        AjaxLoadArticle($(this).text());
    });

    /*
     * Manage save article with ajax
     */
    //$('.ajax').on('click', function () {
    //    AjaxSaveArticle();
    //    return(false);
    //});
    //
    //$('#idForm').submit(function () {
    //    AjaxSaveArticle();
    //    return(false);
    //});


});


/**
 * Load article by ajax
 * Set title
 */
function AjaxLoadArticle(filename){
    console.info('eth : load of "'+filename+'" start...  ');
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

            // Set current article

            selected_filename = dataObject.noteSelected;

            $('#fileSelected').val(selected_filename);

        });

}

function AjaxSaveArticle(){
     console.info('Save start...');

        //var editor = CKEDITOR.instances.editorx;
        //var editorContent  = editor.getData();
        //var encryptedEditorContent = btoa(editorContent);
    //alert(filename);
    //alert(encryptedEditorContent);
    //console.log(filename);
    //console.log(editorContent);
    //console.log('pages/save/' + btoa(filename) + '/' + btoa(editorContent));

        ///* todo : Pass data with POST. ADD security key */
        //$.get('pages/save' ,
        //    {
        //        title: btoa(filename),
        //        //content : editorContent
        //    },
        //    function (data) {
        //        alert("RETURN : " + data);
        //    });

    //var cars = [
    //    "Saab",
    //    "Volvo",
    //    "BMW"
    //];
    $.ajax({
        type: "POST",
        url: 'pages/save',
        data: $("#idForm").serialize(), // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            //AjaxLoadArticle(selected_filename);
        }
    }) ;
        console.info('Save end!');
    //return (false);

}