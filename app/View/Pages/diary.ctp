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
        <div class="dhtmlxTree" // for automatic conversion
        id="treeboxbox_tree"
        setImagePath="[full path to this category]/imgs/"
        style="width:250px; height:218px;overflow:auto;">
        <ul>
            <li>Root
                <ul>
                    <li>Child1
                        <ul>
                            <li>Child 1-1</li>
                        </ul>
                    <li>Child2</li>
                    <li><b>Bold</b> <i>Italic</i></li>
                </ul>
            </li>
        </ul>
    </div>
        <?php if (isset($notes)) : ?>
            <?php foreach ($notes as $i => $note): ?>

                <div class="left_menu_item_parent"><a class="left_menu_item"
                                                      href="#editor<?php echo $i; ?>"><?php echo $note ?></a></div>
            <? endforeach; ?>
        <?php else : ?>
            <span>Aucun article trouvé</span>
        <?php endif; ?>
    </div>


    <div id="right" style="position:absolute; width: 100%">
        <!--- right content -->
        <form id="idForm" action="/pages/save" method="post" style="position: absolute; width: 85%">

            <div id="top-menu" style="height: 50px; width: auto">

                <div class="top-menu-action-buttons" style="display: inline-block; float: right; width: 200px ">
                    <input type="button" name="submit" onclick="$('#idForm').submit();" value="Save" class="btn"
                           style="">
                    <input id="top-menu-button-new" type="button" name="New" value="New" class="btn" style=" ">
                </div>

                <div style="padding-bottom: 40px; "><h1 id="top-menu-title" style="margin-top:0; "></h1>
                    <input size="100" type="text" id="top-menu-new-title"
                           name="top-menu-new-title" value=""
                           placeholder="My new note title..." class="hidden"/>
                </div>

            </div>
            <div style="margin-top: 20px">

                <textarea class="ckeditor hidden" name="editorx" cols="70" id="editorx" rows="50"></textarea>
            </div>


        </form>
    </div>
</div>
<script>
    var myTree = dhtmlXTreeFromHTML("treeboxbox_tree"); // for script conversion
</script>



