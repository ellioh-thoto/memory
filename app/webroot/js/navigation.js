/**
 * Created by elron on 15/01/15.
 */

var selected_filename = 'none';



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
            resetEditor(dataObject.selectedFileContent);
            console.info('eth : Article loaded! ');

            // Display title of selected content

            $('#top-menu h1').text(dataObject.noteSelected);

            // Set current article

            selected_filename = dataObject.noteSelected;
            $('#fileSelected').val(selected_filename);

        });
}

/**
 * Display notification
 * @param data
 */
function displayNotification(data) {
        $('#notification').append(data);
    $('#notification').slideDown();

    setTimeout(function() {

        $('#notification').slideUp().text("");
    }, 1000);
}

/**
 * Save article
 */
function AjaxSaveArticle() {
    console.info('Save start...');

    var editor = CKEDITOR.instances.editorx;
    var editorContent = editor.getData();

    $.ajax({
        type: "POST",
        url: 'pages/save',
        data: {
            "fileSelected": selected_filename,
            "top-menu-new-title-input": $("#top-menu-new-title").val(),
            "editorx": editorContent

        }, // serializes the form's elements.

        success: function (data) {
            //alert(data); // show response from the php script.
            displayNotification(data);
            if (data == "File created!"){
                selected_filename = $('#top-menu-new-title').val();
                $('#top-menu-new-title').val("");
                AjaxLoadArticle(selected_filename);
                activateModeEdition(false);
            }


        }
    });
    console.info('Save end!');

}

/**
 * Display new article title input
 * @param pActivate
 */
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

/**
 * Clear editor
 * @param pContent
 */
function resetEditor(pContent){
    var editor = CKEDITOR.instances.editorx;
    editor.setData(pContent);
}

/**
 * Activate edit mode
 * @param pActivate
 */
function activateModeEdition(pActivate){
    if(typeof (pActivate) == "undefined")
    {
        pActivate = true;
    }

    if (pActivate){
        $("#top-menu-new-title").val("");
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

$(document).ready(function () {

    // Load selected item

    AjaxLoadArticle();

    // On click display selected content

    $('.left_menu_item').click(function () {
        activateModeEdition(false);
        AjaxLoadArticle($(this).text());
    });

    // Manage save article with ajax

    $('#idForm').submit(function () {
        AjaxSaveArticle();
        return(false);
    });

    // Manage new article

    $('#top-menu-button-new').click(function(){
        if ($(this).val() == 'New')
            activateModeEdition(true);
        else // Cancel
            activateModeEdition(false);
    });
});