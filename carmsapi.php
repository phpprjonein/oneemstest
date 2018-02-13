<?php
if(isset($_POST['submitread'])) {
$name = $_POST['name'];
//$url = "http://phpzag.com/demo/how-to-create-simple-rest-api-in-php/items/read.php?name=".$name;
$url = "http://localhost/oneemstest/readuser.php?name=".$name;
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_USERPWD, "admin:password");
$response = curl_exec($client);
$result = json_decode($response);
print_r($result);
}

if(isset($_POST['submitcreate'])) {
  //print_r($_POST);
    $url = "http://localhost/oneemstest/createuser.php";
    $data = array("username" => $_POST['uname'],"password" => $_POST['passwd'],"usertype" => $_POST['usertype'],"firstname"=>$_POST['firstname'],"lastname" => $_POST['lname'],"phoneno" => $_POST['phoneno'],"emailid" => $_POST['emailid']);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("customer"=>$data_string)); 
    $result = curl_exec($ch);
    curl_close($ch); 
    echo $result; 
};



if(isset($_POST['submitdelete'])) {
  //print_r($_POST);
    $url = "http://localhost/oneemstest/deleteuser.php";
    $data = array("username" => $_POST['uname']);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("customer"=>$data_string)); 
    $result = curl_exec($ch);
    curl_close($ch); 
    echo $result; 
};

?>
<div class="container">
<h2>Read user API</h2>
<form class="form-inline" action="" method="POST">
<div class="form-group">
<label for="name">Search Name:</label>
<input type="text" name="name" class="form-control" placeholder="Enter User Name" required/>
</div>
<button type="submit" name="submitread" class="btn btn-default">Find</button>
</form>
</div>
 
<div class="container">
<h2>Create user API</h2>
<form class="form-inline" action="" method="POST">
<div class="form-group">
<label for="name">Username:</label>
<input type="text" name="uname" class="form-control" placeholder="Enter User Name" required/>
</div>
<div class="form-group">
<label for="name">Password:</label>
<input type="text" name="passwd" class="form-control" placeholder="Enter Password" required/>
</div>
<div class="form-group">
<label for="name">UserType:</label>
<input type="text" name="usertype" class="form-control" placeholder="Enter User Type" required/>
</div>
<div class="form-group">
<label for="name">First Name:</label>
<input type="text" name="firstname" class="form-control" placeholder="Enter First Name" required/>
</div>
<div class="form-group">
<label for="name">Last Name:</label>
<input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required/>
</div>
<div class="form-group">
<label for="name">Phone Number:</label>
<input type="text" name="phoneno" class="form-control" placeholder="Enter Phone Number" required/>
</div>
<div class="form-group">
<label for="name">Email Id:</label>
<input type="text" name="emailid" class="form-control" placeholder="Enter Email Id" required/>
</div>
<button type="submit" name="submitcreate" class="btn btn-default">Submit</button>
</form>
</div>


<div class="container">
<h2>Delete user API</h2>
<form class="form-inline" action="" method="POST">
<div class="form-group">
<label for="name">User Name:</label>
<input type="text" name="uname" class="form-control" placeholder="Enter User Name" required/>
</div>
<button type="submit" name="submitdelete" class="btn btn-default">Delete</button>
</form>
</div>