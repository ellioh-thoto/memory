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

define('DATA_DIR', ROOT . '/data');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * This controller does not use a model
     */

    /**
     * @var array
     */
    public $uses = array();
    /**
     * @var Folder
     */
    public $notedir = null;

    public $components = array('RequestHandler');

    function beforeFilter()
    {
        if ($this->request->is('ajax')) {
            $this->layout = null;
        }

        $this->noteDir = new Folder(DATA_DIR . '/note/');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     *    or MissingViewException in debug mode.
     */
    public function diary()
    {

//		$path = func_get_args();
//
//		$count = count($path);
//		if (!$count) {
//			return $this->redirect('/');
//		}
//		$page = $subpage = $title_for_layout = null;
//
//		if (!empty($path[0])) {
//			$page = $path[0];
//		}
//		if (!empty($path[1])) {
//			$subpage = $path[1];
//		}
//		if (!empty($path[$count - 1])) {
//			$title_for_layout = Inflector::humanize($path[$count - 1]);
//		}
//		$this->set(compact('page', 'subpage', 'title_for_layout'));

        // --- eth --



        $files = $this->noteDir->find('.*\.html');

//        $fileContents = Array();
        $notes = Array();
        foreach ($files as $file) {
            $file = new File($this->noteDir->pwd() . DS . $file);
            $notes[] = $file->name();
//            echo $file->name()." - ".date("H:m:s d/m/Y", $file->lastChange())."<BR>";
//            $fileContents[] = $file->read();
            $file->close(); // Assurez vous de fermer le fichier quand c'est fini
        }


//        $firstFile = new File($this->noteDir->pwd() . DS . $files[3]);
//        $fileContent = $firstFile->read();


//        $this->set('fileContents', $fileContents);
        $this->set('files', $files);
        $this->set('notes', $notes);

    }

    /**
     *$the_filename, $the_content
     */
    public function save()
    {

        $filename = base64_decode($this->request->pass[0]);
        $filenameContent = base64_decode($this->request->pass[1]);

        $file = new File($this->noteDir->pwd() . DS . $filename . ".html");
//        $file->write($filenameContent);

        $file->close();
        echo json_encode("Done! " . $this->noteDir->pwd() . DS . $filename);
        exit();
    }

    public function test()
    {
        echo($this->request->pass[0]);
//        echo json_encode("Done!");
        exit();
    }

    /**
     * Load a article
     */
    public function load()
    {
        // Get filename from params

        if(isset($this->request->pass))
            if(isset($this->request->pass[0]))
                $selectedFilename = base64_decode($this->request->pass[0]);

        // Get current filename from Sesssion
        if (empty($selectedFilename))
            $selectedFilename = $this->Session->read("selected");

        // Get all files name

        $filenames = $this->noteDir->find('.*\.html');

        // Get current file from articles directory

        if (!empty($selectedFilename)) {
            $tmp = $this->noteDir->find('.*^'.$selectedFilename.'\.html');
            $fileSelected = $tmp[0];
        }
        else {

            //If none selected we take the first artcle as selected
            $fileSelected = $filenames[0];
        }

        // Warning case : file set in Session not found

        if (empty($fileSelected)){
            echo json_encode(array('code'=>2, 'message' => 'Warning! Selected file from Session not found') );
            die();
        }

        $fileContents = Array();
        $notes = Array();

        // Get short file name

        foreach ($filenames as $filename) {
            $file = new File($this->noteDir->pwd() . DS . $filename);
            $notes[] = $file->name();
            $file->close();
        }

        // Get Content of selected file

        $file = new File($this->noteDir->pwd() . DS . $fileSelected);
        $selectedFileContent = $file->read();
        $file->close();
        // Return values

        echo json_encode(array(
            "fileSelected" => $fileSelected,
            "noteSelected" => $file->name(),
            "selectedFileContent" => $selectedFileContent,
            "notes" => $notes
        ));
        exit();
    }

    /**
     * Delete a note
     * @param filename
     */
    public function delete(){
        $filename = base64_decode($this->request->pass[0]);
        $file = new File($this->noteDir->pwd() . DS . $filename . ".html");
        $file->delete();
        $file->close();

        // todo manage exception

        echo json_encode("File deleted! ");
        exit();
    }
}
