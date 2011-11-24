<?php


class Template {


	public $template,$session;
	
	public $skeleton_path = 'skeleton-template';
  
	public function init() {

		$this->template = sprintf(
			"<root>%s</root>",
				$_POST['data']
		);
		
		$this->session = uniqid();

		$this->process();
	}
	
	public function process() {
	
		$doc = new DOMDocument();
		$xsl = new XSLTProcessor();

		$doc->load('template.xslt');
		$xsl->importStyleSheet($doc);

		$doc->loadXML($this->template);
		$content = $xsl->transformToXML($doc);
		
		system("cp -R {$this->skeleton_path} $this->session");
		$index = str_replace(
			'###TEMPLATE###',
			$content,
			file_get_contents("{$this->session}/index.html")
		);

		file_put_contents("{$this->session}/index.html", $index);
		
		$zip_filename = "{$this->skeleton_path}-{$this->session}.zip";
		system("zip -9 -r {$zip_filename} {$this->session}");
		system("rm -rf {$this->session}");
		
		header("Location: {$zip_filename}");
		echo $this->session;
	
	}

}

?>