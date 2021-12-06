<?php

class Book
{
    private $iSBN; //ID Num of book
    private $title;
    private $authors;
    // Authors by seperated by comma
    private $language;
    private $type; //Hard/Soft/Ebook
    private $yearPublished;

    // private CopiesTotal;
    // private CopiesInStock;

    private $genre;
    //future todo items
    // add shelf locations
    // indexing books by author
    // 
    function __constructor($iSBN, $title, $authors, $language, $type, $yearPublished, $genre)
    {
        $this->iSBN = $iSBN;
        $this->title = $title;
        $this->authors = $authors;
        $this->language = $language;
        $this->type = $type;
        $this->yearPublished = $yearPublished;
        $this->genre = $genre;
    }
}
