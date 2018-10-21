<?php
// 3. This is an App class that you can call new instans of

// Array ( [0] => home [1] => index [2] => pernilla )
// The controller, the method and the parameter

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
    echo "construct körs <br />";
    // echo "this is construct<br />";
    print_r($this->parseUrl());
    $url = $this->parseUrl();

    if(file_exists('../app/controllers/' . $url[0] . '.php'))
    {
      $this->controller = $url[0]; // this will replace the protected $controller = 'home';
      unset($url[0]);
      echo "om inte filen controllers finns kör det här";
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    echo "<br />";
    echo "om if file_exist inte finns körs den här " . $this->controller . "<br />";
    // echo $this->controller;

    $this->controller = new $this->controller;

    // var_dump($this->controller); Home object created

    // Check if this method $url[1] exists dvs index
    if(isset($url[1])) {
      // echo $url[1];
      // If index exists
      // this->controller is the name of the object or class name and if the index method exists
      if(method_exists($this->controller, $url[1])) {
        echo "The method index exists in the controller object<br />";
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    // Checking the params
    // Need to check if the url has any content first
    $this->params = $url ? array_values($url) : [];
    // mvc/public/home/index/pernilla returns Array ( [0] => pernilla )
    // mvc/public/home/index/ returns Array ()
    print_r($this->params);

    call_user_func_array([$this->controller, $this->method], $this->params);
    // Now we get home/index when we set /mvc/public/home/index/ and that is from controllers/home.php

  }

  // This method envolves trimming, exploding and sanatizing the URL
  // It will gives us any controller, method and parameters
  public function parseUrl()
  {
    echo "parsUrl körs <br />";
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
