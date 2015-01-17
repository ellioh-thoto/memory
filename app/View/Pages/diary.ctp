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
        <div id="top-menu">
            <?php echo $this->Html->link('Test', array('controller' => 'pages', 'action' => 'save'), array('class' => 'ajax', 'id' => 'ajaxbutton')); ?>
            <h1></h1>

                <div class="top-menu-action-buttons">
                    <input class="btn btn-primary" type="button" value="Save">
                </div>

                <div>


                        <textarea class="ckeditor hidden" name="editorx" cols="70" id="editorx" rows="50"></textarea>

                    <?php /*if (isset($fileContents)) : ?>
                        <?php foreach ($fileContents as $i => $fileContent): ?>
                            <div>
                                <textarea class="ckeditor hidden" name="editor<?php echo $i; ?>" cols="70" id="editor<?php echo $i; ?>"
                          rows="50">
                                    <?php echo $fileContent; ?>
                                </textarea>
                            </div>

                        <?php endforeach; */ ?>


                </div>
                <div class="clear"></div>
            </div>

<div id="test"></div>
