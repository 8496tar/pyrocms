<?php defined('BASEPATH') or exit('No direct script access allowed');

class Galleries_details extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Galleries'
			),
			'description' => array(
				'en' => 'The galleries module is a powerful module that lets users create image galleries.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => TRUE
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('galleries');
		$this->dbforge->drop_table('gallery_images');
		
		$galleries = "
			CREATE TABLE `galleries` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) NOT NULL,
			  `slug` varchar(255) NOT NULL,
			  `thumbnail_id` int(11) DEFAULT NULL,
			  `description` text,
			  `parent` int(11) DEFAULT NULL,
			  `updated_on` int(15) NOT NULL,
			  `preview` varchar(255) DEFAULT NULL,
			  `enable_comments` INT( 1 ) DEFAULT NULL,
			  `published` INT(1) DEFAULT NULL,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `slug` (`slug`),
			  UNIQUE KEY `thumbnail_id` (`thumbnail_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";

		$gallery_images = "
			CREATE TABLE `gallery_images` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `gallery_id` int(11) NOT NULL,
			  `filename` varchar(255) NOT NULL,
			  `extension` varchar(255) NOT NULL,
			  `title` varchar(255) DEFAULT 'Untitled',
			  `description` text,
			  `uploaded_on` int(15) DEFAULT NULL,
			  `updated_on` int(15) DEFAULT NULL,
			  `order` INT(11) DEFAULT '0',
			  PRIMARY KEY (`id`),
			  KEY `gallery_id` (`gallery_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";

		if($this->db->query($galleries) && $this->db->query($gallery_images))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{		
		if($this->dbforge->drop_table('galleries') &&
		   $this->dbforge->drop_table('gallery_images'))
		{
			return TRUE;
		}
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "Some Help Stuff";
	}
}
/* End of file details.php */