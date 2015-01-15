<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

define('DATA_DIR', ROOT.'/data');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

    public $components = array('RequestHandler');

    function beforeFilter(){
        if($this->request->is('ajax')){
            $this->layout = null;
        }
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function diary() {

		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

        $noteDir = new Folder(DATA_DIR.'/note/');

        $files = $noteDir->find('.*\.html');

        $fileContents = Array();
        $notes = Array();
        foreach ($files as $file) {
            $file = new File($noteDir->pwd() . DS . $file);
            $notes[] = $file->name();
//            echo $file->name()." - ".date("H:m:s d/m/Y", $file->lastChange())."<BR>";
            $fileContents[] = $file->read();

            // $file->write('J'écris dans ce fichier');
            // $file->append('J'ajoute à la fin de ce fichier.');
            // $file->delete(); // Je supprime ce fichier
            $file->close(); // Assurez vous de fermer le fichier quand c'est fini
        }

//        print_r($files); die;
        $firstFile = new File($noteDir->pwd() . DS . $files[3]);
        $fileContent = $firstFile->read();

//print_r($noteList);
        $this->set('fileContents', $fileContents);
        $this->set('files', $files);
        $this->set('notes', $notes);
//die ;
//        print_r($files); die;
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

    /**
     *$the_filename, $the_content
     */
    public function save() {
//echo "coucou";
//        echo print_r($this->request);


//        $path = func_get_args();
//
//        $count = count($path);
//
//
//        $noteDir = new Folder(DATA_DIR.'/note/');
//
//
//        $filenames = $noteDir->find($the_filename.'\.html');
//        $filename = $filenames[0];
//
//        $file = new File($noteDir->pwd() . DS . $filename);
//         $file->write($the_content);


//        // $file->append('J'ajoute à la fin de ce fichier.');
        // $file->delete(); // Je supprime ce fichier
//        $file->close(); // Assurez vous de fermer le fichier quand c'est fini
//        $filename = "test";
//        echo json_encode("Done!");
        echo(base64_decode($this->request->pass[0]));
        echo(base64_decode($this->request->pass[1]));
//        echo($this->request->pass[0]);
//        echo($this->request->pass[1]);

        exit();


    }

    public function test(){
        echo($this->request->pass[0]);
//        echo json_encode("Done!");
        exit();
    }

    public function loader(){

    }

}
