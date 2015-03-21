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

<div class="alert alert-success hidden" id="notification" role="alert">
</div>
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

    <div id="right" style="display:block;position:absolute; width: 100%">
    <!--- right content -->
    <form id="idForm" action="/pages/save" method="post"  style="position: absolute; width: 85%">

        <div id="top-menu" style="height: 50px;">

            <h1 id="top-menu-title"></h1>
            <div style="diplay:block;position:absolute"> <input  size="100" type="text" id="top-menu-new-title" name="top-menu-new-title" value="" placeholder="My new note title..." class="hidden"/>
                </div>

            <div id="top-menu-new-title" style="display:none;position:absolute">
                <input  size="100" type="text"  name="top-menu-new-title-input" id="top-menu-new-title-input" placeholder="My new note title..." style="display:block"></input>
            </div>
        </div>
        <div>



                <div class="top-menu-action-buttons">

                    <input id="top-menu-button-new" type="button" name="New" value="New" class="btn">

                    <input type="submit" name="submit" value="Save" class="btn">
                </div>
                <textarea class="ckeditor hidden" name="editorx" cols="70" id="editorx" rows="50"></textarea>



    </form>
    </div>
        <div class="clear"></div>



