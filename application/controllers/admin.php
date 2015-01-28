<?php

/**
 * Class Help
 * The help area
 */
class Admin extends Controller
{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::handleLogin();
    }

    /**
     * This method controls what happens when you move to /help/index in your app.
     */
    function index()
    {
        $books_model = $this->loadModel('Admin');
        $this->view->books = $books_model->getArchivedBooks();
        $this->view->onLoanBooks = $books_model->onLoan(); //set the model (books) same as line 28
        $this->view->availableBooks = $books_model->availableBooks();
        $this->view->render('admin/index'); //show index page   
    }
    
    function archive()
    {
        $books_model = $this->loadModel('Admin');
        $this->view->books = $books_model->getArchivedBooks();
        $this->view->render('admin/archive');
    }
    
    function onLoan()
    {
        $admin_model = $this->loadModel('Admin');
        $this->view->onLoanBooks = $admin_model->onLoan();
        $this->view->render('admin/onLoan');
    }
    
    function availableBooks()
    {
        $admin_model = $this->loadModel('Admin');
        $this->view->availableBooks = $admin_model->availableBooks();
        $this->view->render('admin/availableBooks');
    }
    
    function addBook()
    {
        $this->view->render('admin/addBook');
    }
    
    function searchIsbn()
    {
        $this->view->render('admin/searchIsbn');
    }
    
    function bin()
    {
        $bin_model = $this->loadModel('Admin');
        $this->view->books = $bin_model->getDeletedBooks();
        $this->view->render('admin/bin');
    }
    
    function users()
    {
        $overview_model = $this->loadModel('Users');
        $this->view->users = $overview_model->getAllUsersProfiles();
        $this->view->render('admin/users');
    }

    // create a new book and add it to the database using Admin model create()
    function create()
    {
        if (isset($_POST['title']) AND !empty($_POST['title'])) {
            $book_model = $this->loadModel('Admin');
            $book_model->create($_POST['title'],
                                $_POST['category'],
                                $_POST['author'],
                                $_POST['isbn'],
                                $_POST['subtitle'],
                                $_POST['publicationYear'],
                                $_POST['pageCount'],
                                $_POST['description']
                    );
        }
        header('location: ' . URL . 'admin/addBook');
    }
    
    /**
     * This method controls what happens when you move to /overview/showuserprofile in your app.
     * Shows the (public) details of the selected user.
     * @param $user_id int id the the user
     */
    function showUserProfile($user_id)
    {
        if (isset($user_id)) {
            $overview_model = $this->loadModel('Overview');
            $this->view->user = $overview_model->getUserProfile($user_id);
            $this->view->render('admin/showuserprofile');
        } else {
            header('location: ' . URL);
        }
    }
    
    function addIsbn()
    {
               
        if (isset($_POST['isbn']) AND !empty($_POST['isbn'])) {
            $addIsbn_model = $this->loadModel('Admin');
            $addIsbn_model->addIsbn($_POST['isbn'],
                                $_POST['title'],
                                $_POST['category'],
                                $_POST['author'],
                                $_POST['description']
                    );
        }
        header('location: ' . URL . 'admin/searchIsbn');
    }

}
