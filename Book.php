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
    protected $page_count;
    protected $description;
    protected $quantitiy;
    
    public function __construct() {
        $this->authors = new Author();
        $this->publishers = new Publisher();
    }
    
    public function getAuthor(){
        return $this->authors;
    }
    
    public function getPublisher(){
        return $this->publishers;
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
        $this->page_count = $pccount;
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
        return $this->quantitiy;
    }
    
    public function setQuantity($newQuant){
        $this->quantitiy = $newQuant;
        return 1;
    }
    
}

?>
