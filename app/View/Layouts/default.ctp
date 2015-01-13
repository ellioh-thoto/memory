<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework -eth');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');


		echo $this->Html->css('sample');
    echo $this->Html->css('skins/bootstrap/css/bootstrap.css');
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('//fonts.googleapis.com/css?family=Gloria+Hallelujah');
    echo $this->Html->css('http://fonts.googleapis.com/css?family=Patrick+Hand');
//    echo $this->Html->css('../debug_kit/css/debug_toolbar.css');

        echo $this->Html->script('ckeditor');
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        echo $this->Html->script('adapters/jquery.js');
//        echo $this->Html->script('http://s1.ckeditor.com/sites/default/files/advagg_css/css__MkdQlYKKNTEDe5b_jl9tuxsFB8G4YXA2ZM0bQzB5-dY__NDcGhWz1u4SfLX7snS8GbAQCur1j1Onks2nODezNrHw__G95gm9NlfJgZe9SHqTCtegdMymJWWUC9WAzkpiM_1xo.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <style>

        #editable
        {
            padding: 10px;
            float: left;
        }


    </style>
    <script>
        // Replace the <textarea id="editor1"> with an CKEditor instance.
//        var editor = CKEDITOR.replace( 'editor1');
//        editor.resize( '100%', '850' );
    </script>
</head>
<body>
	<div id="container">
		<div id="header">
<!--			<h1>--><?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?><!--</h1>-->
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
