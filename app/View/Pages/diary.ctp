<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

//App::uses('Debugger', 'Utility');
?>

<!--<h2>--><?php //echo __d('cake_dev', 'Release Notes for CakePHP %s.', Configure::version()); ?><!--</h2>-->
<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>


<div id="container">
    <div id="left">

     <?php foreach($notes as $i => $note): ?>
        <div class="left_menu_item_parent"><a class="left_menu_item" href="#editor<?php echo $i; ?>"><?php echo $note ?></a></div>
        <?endforeach; ?>
    </div>
        <div id="right">
            <div id = "top-menu">
                <?php echo $this->Html->link('Test', array('action' => 'save'), array('class' => 'ajax')); ?>
                <h1></h1>
                <div class = "top-menu-action-buttons">
                    <input class="btn btn-primary" type="button" value="Save">
                </div>
            <div>
            <?php foreach ($fileContents as $i=> $fileContent): ?>
            <div>
                <textarea class="ckeditor hidden" name="editor<?php echo $i; ?>" cols="70" id="editor<?php echo $i; ?>" rows="50">
                <?php echo $fileContent; ?>
            </textarea>
                </div>

        <?php endforeach; ?>
        </div>
    <div class="clear"></div>
</div>



<script>

    var selected = '#editor0';
    var selected_filename = '';
    $( document ).ready(function() {

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

        //Save action

        $('.ajax').on('click', function(){
            console.log('eth : passed');
            $.get($(this).attr('href'),
                {filename:"test.php",
//                    content:$("#"+selected).text()}, function(data){
                    content: "contenu"
                },
                function(data){
               alert(data);
            });
            return false;
        });
//        $('#save').click(function(){
//            $.ajax({
//                url: "/save",
//                context: document.body
//            }).done(function() {
//                alert('saved');
//            });
//            .fail(function() {
//                alert( "error" );
//            })
//            .always(function() {
//                alert( "complete" );
//            });
//        });

    });
</script>