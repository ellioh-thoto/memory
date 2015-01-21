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

    <!-- left menu -->


    <div id="left">
        <?php if (isset($notes)) : ?>
            <?php foreach ($notes as $i => $note): ?>
                <div class="left_menu_item_parent"><a class="left_menu_item"
                                                      href="#editor<?php echo $i; ?>"><?php echo $note ?></a></div>
            <? endforeach; ?>
        <?php else : ?>
            <span>Aucun article trouvé</span>
        <?php endif; ?>
    </div>


    <!--- right content -->

    <div id="right">
        <div id="top-menu" style="height: 50px;">
            <h1></h1>
        </div>
        <div>

            <form id="idForm" action="/pages/save" method="post"  style="position: absolute; width: 85%">

                <div class="top-menu-action-buttons">
                    <input type="submit" name="submit" value="Save" class="btn">
                </div>
                <textarea class="ckeditor hidden" name="editorx" cols="70" id="editorx" rows="50"></textarea>
            </form>

        </div>
        <div class="clear"></div>


        <div id="test"></div>
