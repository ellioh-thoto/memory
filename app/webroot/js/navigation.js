/**
 * Created by elron on 15/01/15.
 */

var selected = '#editor0';
var selected_filename = '';
$( document ).ready(function() {

    /* Initialize page content */

    /*
     * Load selected item
     */
        console.log('eth : load start...  ');
        $.get('pages/load/',
            {},
            function(data){
                var dataObject = jQuery.parseJSON(data);
                $('#editorx').val(dataObject.selectedFileContent);
                console.log(dataObject.selectedFileContent);
            });
        return false;
    //});


    // On first load, display selected content
    $('.ckeditor').parent('div').hide();
    $(selected).parent('div').show();
    console.log('eth : Loaded!');

    // Display title of selected content
    $.each($('.left_menu_item'), function(){
        if ($(this).attr('href') == selected) {
            selected_filename = $(this).text();
            $('#top-menu h1').text($(this).text());
        }
    });

    // On click dislay selected content
    $('.left_menu_item').click(function(){
        if ($(this).attr('href') != selected) {
            $(selected).parent('div').hide();
            selected = $(this).attr('href');
            $(selected).parent('div').show();
        }
        // Display title of selected content
        $.each($('.left_menu_item'), function(){
            if ($(this).attr('href') == selected) {
                selected_filename = $(this).text();
                $('#top-menu h1').text($(this).text()).hide();
            }
            $('#top-menu h1').fadeIn();
        });
    });

    /*
     * Manage Ajax calls
     */
    $('.ajax').on('click', function(){

        console.log('eth : passed  ');
        /* todo : Pass data with POST. ADD security key */
        $.get($(this).attr('href')+ '/'+btoa(selected_filename)+'/'+btoa($(selected).text()),
        {},
            function(data){
                alert("RETURN : "+data);
            });
        return false;
    });
});
