<?php

/**
 * Class Overview
 * This controller shows all books
 */
class Books extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        
        Auth::handleLogin();
    }

    /**
     * This method controls what happens when you move to /books/index in your app.
     * Shows a list of all users.
     */
    function index()
    {
        $books_model = $this->loadModel('Books');
        $this->view->books = $books_model->getAllBooks();
        //$this->view->bookOfWeek = $books_model->getBookOfWeek();
        $this->view->render('books/index');
    }
    
    function itemView()
    {
        $itemView_model = $this->loadModel('Books');
        $this->view->books = $itemView_model->itemView();
        $this->view->similarBooks = $itemView_model->randomBooks();
        $this->view->render('books/itemView'); 
    }
    
    function categoryView()
    {
        $categoryView_model = $this->loadModel('Books');
        $this->view->books = $categoryView_model->categoryView();
        $this->view->render('books/categoryView');
    }
    
    function borrowRequest()
    {
        $borrowRequest_model = $this->loadModel('Books');
        $this->view->books = $borrowRequest_model->borrowRequestView();
        $this->view->render('books/borrowRequest');
    }
    
    function borrowRequestAction()
    {
        $borrowRequest_model = $this->loadModel('Books');
        $borrowRequest_model->borrowRequest();
    }
    
    function checkFav()
    {
        $checkFav_model = $this->loadModel('Books');
        $checkFav_model->checkFav($bookid,$userid); 
    }
    
    function markAvailable()
    {
        $markAvailable = $this->loadModel('Books');
        $markAvailable->markAvailable(); 
        $this->view->render('books/markAvailable');  
    }
    
    function markUnavailable()
    {
        $markUnavailable = $this->loadModel('Books');
        $markUnavailable->markUnavailable(); 
        $this->view->render('books/markUnavailable');
    }
    
    function archiveBook()
    {
        $archiveBook = $this->loadModel('Books');
        $this->view->books = $archiveBook->itemView();
        $archiveBook->archiveBook(); 
        $this->view->render('books/archiveBook');  
    }
    
    function deleteBook()
    {
        $deleteBook = $this->loadModel('Books');
        $deleteBook->deleteBook(); 
        $this->view->render('books/deleteBook');  
    }
    
    function favouriteList()
    {
        $favList = $this->loadModel('Books'); //loads books model page
        $this->view->books = $favList->favList();
        $this->view->render('books/favouriteList'); //rebder the view (show page content)
    }
    
    function deleteFav()
    {
        //$favList = $this->loadModel('Books'); //loads books model page
        $favList->deleteFav();
        $this->view->render('books/favouriteList'); 
        $this->view->books = $favList->deleteFav();
    }
    
    function search()
    {
        $search = $this->loadModel('Books'); //loads books model page
        $this->view->books = $search->search();
        $this->view->render('books/search'); //rebder the view (show page content)
    }
    
    function markBookOfWeek()
    {
        $markBookOfWeek = $this->loadModel('Books');
        $markBookOfWeek->markBookOfWeek(); 
        $this->view->render('books/markBookOfWeek');
    }
    
    function removeBookOfWeek()
    {
        $removeBookOfWeek = $this->loadModel('Books');
        $removeBookOfWeek->removeBookOfWeek(); 
        $this->view->render('books/removeBookOfWeek');
    }
    
    function getPopular()
    {
        $popular = $this->loadModel('Books');
        $popular->getPopular(); 
        $this->view->render('books/getPopular');
    }
    
    

}
