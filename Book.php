<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author Brad
 */

require_once 'Publisher.php';
require_once 'Author.php';

class Book {
	//put your code here
	protected $authors;
	protected $publishers;
	protected $name;
	protected $isbn;
	protected $volume_id;
	protected $page_count;
	protected $description;
	protected $quantity;
	protected $available;

	public function __construct() {
		$this->authors = new Author();
		$this->publishers = new Publisher();
	}
	public function getNumAvailable(){
		return $this->available;
	}
	public function getVolumeID() {
		return $this->volume_id;
	}
	public function getAuthor(){
		return $this->authors;
	}
	public function setAuthor($pAuthorObject)
	{
		$this->authors = $pAuthorObject;
	}
	public function getPublisher(){
		return $this->publishers;
	}
	public function setPublisher($pPublisherObject)
	{
		$this->publishers = $pPublisherObject;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($newName){
		$this->name = $newName;
		return 1;
	}

	public function getISBN(){
		return $this->isbn;
	}

	public function setISBN($newisbn){
		$this->isbn = $newisbn;
		return 1;
	}

	public function getPCount(){
		return $this->page_count;
	}

	public function setPCount($pcount){
		$this->page_count = $pcount;
		return 1;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($newDesc){
		$this->description = $newDesc;
		return 1;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($newQuant){
		$this->quantity = $newQuant;
		return 1;
	}

	public function setVolumeID($pVolID){
		$this->volume_id = $pVolID;
		return 1;
	}
	public function setNumAvailable($pNA){
		$this->available = $pNA;
		return 1;
	}


	public function __toString()
	{
		$returnString = "";
		$returnString .= sprintf("Title: %s\n", $this->name);
		$returnString .= sprintf("ISBN: %s\n", $this->isbn);
		$returnString .= sprintf("Volume ID: %s\n", $this->volume_id);
		$returnString .= sprintf("Quantity: %s\n", $this->quantity);
		$returnString .= sprintf("Page Count: %s\n", $this->page_count);
		$returnString .= sprintf("Publish Date: %s\n", $this->publishers->getPublishDate());
		$count = 1;
		foreach($this->authors->getAuthor() as $author)
		{
			$returnString .= sprintf("Author %d: %s\n", $count, $author);
			$count++;
		}
		$count = 1;
		foreach($this->publishers->getPublisher() as $publisher)
		{
			$returnString .= sprintf("Publisher %d: %s\n", $count, $publisher);
			$count ++;
		}
		return $returnString;
	}
}

?>
