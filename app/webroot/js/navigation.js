/**
 * Created by elron on 15/01/15.
 */

var selected_filename = 'none';
$(document).ready(function () {

    // Load selected item

    AjaxLoadArticle();

    // On click display selected content

    $('.left_menu_item').click(function () {
        activateModeEdition(false);
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
    $('#idForm').submit(function () {
        AjaxSaveArticle();
        return(false);
    });

    $('#top-menu-button-new').click(function(){
        if ($(this).val() == 'New')
            activateModeEdition(true);
        else // Cancel
            activateModeEdition(false);
    });
});


/**
 * Load article by ajax
 * Set title
 */
function AjaxLoadArticle(filename) {
    console.info('eth : load of "' + filename + '" start...  ');
    var param;
    if (typeof filename === 'undefined')
        param = "";
    else
        param = "/" + btoa(filename);

    // todo replace by ajax function to made it synchronous
    $.get('pages/load' + param,
        {},
        function (data) {

            console.info('eth : ajax returned ');
            // Set textarea content

            var dataObject = jQuery.parseJSON(data);
            //
            //var editor = CKEDITOR.instances.editorx;
            //editor.setData(dataObject.selectedFileContent);
            resetEditor(dataObject.selectedFileContent);
            //$('#test').text(dataObject.selectedFileContent);
            console.info('eth : Article loaded! ');

            //$('.ckeditor').parent('div').hide();
            //$(selected).parent('div').show();

            // Display title of selected content

            $('#top-menu h1').text(dataObject.noteSelected);

            // Set current article

            selected_filename = dataObject.noteSelected;

            $('#fileSelected').val(selected_filename);

            // Remove edit items
            //displayEditionInput(false);

        });

}

function displayNotification(data) {
        $('#notification').append(data);
    $('#notification').slideDown();

    setTimeout(function() {

        $('#notification').slideUp().text("");
    }, 1000);
}
function AjaxSaveArticle() {
    console.info('Save start...');

    var editor = CKEDITOR.instances.editorx;
    var editorContent = editor.getData();
console.log('input : '+$('#top-menu-new-title-input').val());

    $.ajax({
        type: "POST",
        url: 'pages/save',
        data: {
            "fileSelected": selected_filename,
            "top-menu-new-title-input": $('#top-menu-new-title-input').val(),
            "editorx": editorContent

        }, // serializes the form's elements.

        success: function (data) {
            //alert(data); // show response from the php script.
            displayNotification(data);
            //AjaxLoadArticle(selected_filename);
        }
    });
    console.info('Save end!');

}

function displayEditionInput(pActivate){
    if (typeof(pActivate) == "undefined") {
        activpActivateate = false;
    }
        if (pActivate) {
            $('#top-menu-title').hide();
            $('#top-menu-new-title').fadeIn();
        } else {
            $('#top-menu-new-title').hide();
            $('#top-menu-title').fadeIn();
        }
}

function resetEditor(pContent){
    var editor = CKEDITOR.instances.editorx;
    editor.setData(pContent);
}

function activateModeEdition(pActivate){
    if(typeof (pActivate) == "undefined")
    {
        pActivate = true;
    }

    if (pActivate){
        displayEditionInput(true);
        $('#top-menu-button-new').val('Cancel');
        resetEditor("");
    }
    else
    {
        displayEditionInput(false);
        $('#top-menu-button-new').val('New');
        $('#top-menu-new-title-input').text('');

        // Load back current file
        AjaxLoadArticle(selected_filename);
    }
}