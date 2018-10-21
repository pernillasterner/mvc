<?php
// This is the Default controller that extends the Base Controller

class Home extends Controller
{
  public function index($name = '', $otherName = '')
  {
    // calling the default controller
    echo 'this is the test method in  home/index<br />';
    // mvc/public/home/index/pernilla/sterner
    echo $name . "<br />"; // pernilla
    echo $otherName; // sterner
  }

  public function test()
  {
    // /mvc/public/home/test
    echo "this is the test method in home/test";
  }


}

 ?>
