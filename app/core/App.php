<?php
// 3. This is an App class that you can call new instans of

class App
{


  // 1. Define the default controller and default method so create a new file in the controller map home.php
  // 2. Create a protected controller and set it to home
  // Create an construct method

  // Set default controller and method that runs when bootstrapping the application
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    echo "this is construct<br />";
    print_r($this->parseUrl());
    $url = $this->parseUrl();
  }

  // This method envolves trimming, exploding and sanatizing the URL
  // It will gives us any controller, method and parameters
  public function parseUrl()
  {
    // 1. Check if the URL is set
    // We´re going to use an .htaccess file to rewrite the url and parse it through as a GET variabel
      if(isset($_GET['url'])) {
        // http://localhost/mvc/public/home/index/test NOT WORKING because there´s no .htaccess file
        // http://localhost/mvc/public/?url=test   WORKS!
        echo "Det här kommer från parseUrl metoden " . $_GET['url'] . "<br />";

        return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

      }
  }
}



 ?>
