# Facebook-Login

This Facebook-Login Github Repo created to make it possible for all noobie programmer who wanted to implement login with facebook feature for developers using Facebook PHP SDK in just three lines of code.

# How to Use
To use this extended api programmer need to import FbLogin.php file in their code by include or require functions in PHP.
rest stuff will be done by that API.
 
 Now just create an Object of FbLogin Class in your code by passing array parameter as 
 
 $obj = new FbLoginarray("app_id"=>"your app id","app_secret"=>"your app secret");
 
 and after creating FbLogin obj just call getUser function using obj by passing  redirect url and permission array as
 $user = $obj->getUser("redirect url",array('email,public_profile'));
 
 getUser() function may return login URL or Profile data based on if user is logged in or not.
 
 Now our function has does all the things you can check whether return type is array or not by using is_array function of PHP.
 If return type is array that means user already logged in and you recieved his/her data in array else you get login url to   facebook.
 
 so isn't it cool that all the requirement of user login with facebook and getting data of a user of facebook is done in 3 lines of code as followed:
 
  if(!session_id()) {
    session_start();
  }
 require_once __DIR__ . '/Facebook/FbLogin.php';

 $fblogin = new FbLogin(array("app_id"=>"your app id","app_secret"=>"your app secret"));

 $user = $fblogin->getUser("redirect url",array('email','public_profile'));
 
 #for the developer
 Programmer can commit and contribute to this code, it wil be very helpfull to make something easy for the world of programmers. 
 
 


 
