<?php
include('IView.php');
include('../Smarty-3.0.7/libs/Smarty.class.php');

class View implements IView{

	public $jsFolder;
	public $cssFolder;
	public $cssFiles;
	public $jsFiles;
	public $smarty;
	
	public function __construct(){
		$this->cssFiles=array();
		$this->jsFiles=array();
		$this->smarty=new Smarty;
		$this->smarty->setTemplateDir('templates');
	}
	
    /**
     * Renders and displays the HTML.
     * For example - should work like $smarty->display("some.tpl")
     * @var <string> $pagaName - the name of the template to display
     */
    public function display($pageName){
		$this->smarty->display($pageName);
	}

    /**
     * Assigns a variable to a template placeholder
     * @var <string> $varName - the name of the placeholder
     * @var $varValue - the value for the placeholder
     */
    public function assignTemplateVariable($varName, $varValue){
		$this->smarty->assign($varName, $varValue);
	}

    /**
     * Sets the page title between <title></title> tags
     * @var <string> $title - The page title
     */
    public function setPageTitle($title){
		//$this->title = $title;
		$this->smarty->assign("title", $title);
	}

    /**
     * Sets the location of the javascript files
     * @var <string> $jsFolder - the location to the javascript files
     */
    public function setJavascriptFolder($jsFolder){
		$this->jsFolder=$jsFolder;
	}

    /**
     * Adds the following javascript files in the HTML template
     * @var <array> $js - array of file names that are located in the $jsFolder
     */
    public function addJavascriptFiles($js /* array */){
		foreach($js as $jsfile){
			array_push($this->jsFiles, $this->jsFolder.DIRECTORY_SEPARATOR.$jsfile);
		}
		$this->smarty->assign("jsFiles", $this->jsFiles);
	}

    /**
     * Sets the location of the CSS files
     * @var <string> $cssFolder - the location to the CSS files
     */
    public function setCSSFolder($cssFolder){
		$this->cssFolder=$cssFolder;
	}

    /**
     * Adds the following CSS files in the HTML template
     * @var <array> $css - array of file names that are located in the $cssFolder
     */
    public function addCSSFiles($css /* array */){
		foreach($css as $cssfile){
			array_push($this->cssFiles, $this->cssFolder.DIRECTORY_SEPARATOR.$cssfile);
		}
		$this->smarty->assign("cssFiles", $this->cssFiles);
	}
};
?>