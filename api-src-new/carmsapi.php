<?php
if (isset($_GET['submitread'])) {
    $name = $_GET['name'];
    // $url = "http://phpzag.com/demo/how-to-create-simple-rest-api-in-php/items/read.php?name=".$name;
<<<<<<< HEAD
    $url = "http://localhost/oneemstest/api-src-new/readuser.php?name=" . $name;
    //$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/readuser.php?name=" . $name;
=======
   // $url = "http://localhost/oneemstest/api-src-new/readuser.php?name=" . $name;
    $url = "https://njbboemsda1v.nss.vzwnet.com/oneemstest/api-src/readuser.php?name=" . $name;
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
    header('Location:'.$url);
    /*
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_USERPWD, "admin:password");
    $response = curl_exec($client);
    $result = json_decode($response);
    print_r($result);*/
    exit();
}

if (isset($_GET['submitcreate'])) {
    // print_r($_POST);
    //$url = "http://localhost/oneemstest/createuser.php";
    $url = "http://localhost/oneemstest/api-src-new/createuser.php?username=".$_GET['uname']."&passwd=".$_GET['passwd']."&usertype=".$_GET['usertype']."&firstname=".$_GET['firstname']."&lastname=".$_GET['lname']."&phoneno=".$_GET['phoneno']."&emailid=".$_GET['emailid'];
    header('Location:'.$url);
    
    /*$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/createuser.php";
    $data = array(
        "username" => $_POST['uname'],
        "password" => $_POST['passwd'],
        "usertype" => $_POST['usertype'],
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lname'],
        "phoneno" => $_POST['phoneno'],
        "emailid" => $_POST['emailid']
    );
    $ch = curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "customer" => $data_string
    ));
    curl_setopt($client, CURLOPT_USERPWD, "admin:password");
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;*/
    exit();
}
;

if (isset($_GET['submitdelete'])) {
    // print_r($_POST);
    //$url = "http://localhost/oneemstest/deleteuser.php";
    $url = "http://localhost/oneemstest/api-src-new/deleteuser.php?username=".$_GET['uname'];
    header('Location:'.$url);
    /*
    $url ="http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/deleteuser.php";
    $data = array(
        "username" => $_POST['uname']
    );
    $ch = curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "customer" => $data_string
    ));
    curl_setopt($ch, CURLOPT_USERPWD, "admin:password");
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;*/
    exit();
};
if (isset($_GET['submitconfig'])) {
    $tmplname = $_GET['tmplname'];
    //$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/reqconfigtempfile.php?name=" . $name;
    //$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/reqconfigtempfile.php?name=" . $name;
    //$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/readuser.php?name=" . $name;
    //$url = "http://admin:password@localhost/oneemstest/api-src/reqconfigtempfile.php?tmplname=" . $tmplname;
    //$url = "http://ohtwoemsda3z.nss.vzwnet.com/oneemstest/api-src/reqconfigtempfile.php?tmplname=" . $tmplname;
    $url = "http://localhost/oneemstest/api-src-new/reqconfigtempfile.php?tmplname=" . $tmplname;
    header('Location:'.$url);
    
    /*
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_USERPWD, "admin:password");
    $response = curl_exec($client);
    $result = json_decode($response);
    print_r($result);*/
    exit();
};

?>
<div class="container">
	<h2>Read user API</h2>
	<form class="form-inline" action="" method="POST">
		<div class="form-group">
			<label for="name">Search Name:</label> <input type="text" name="name"
				class="form-control" placeholder="Enter User Name" required />
		</div>
		<button type="submit" name="submitread" class="btn btn-default">Find</button>
	</form>
</div>

<div class="container">
	<h2>Create user API</h2>
	<form class="form-inline" action="" method="POST">
		<div class="form-group">
			<label for="name">Username:</label> <input type="text" name="uname"
				class="form-control" placeholder="Enter User Name" required />
		</div>
		<div class="form-group">
			<label for="name">Password:</label> <input type="text" name="passwd"
				class="form-control" placeholder="Enter Password" required />
		</div>
		<div class="form-group">
			<label for="name">UserType:</label> <input type="text"
				name="usertype" class="form-control" placeholder="Enter User Type"
				required />
		</div>
		<div class="form-group">
			<label for="name">First Name:</label> <input type="text"
				name="firstname" class="form-control" placeholder="Enter First Name"
				required />
		</div>
		<div class="form-group">
			<label for="name">Last Name:</label> <input type="text" name="lname"
				class="form-control" placeholder="Enter Last Name" required />
		</div>
		<div class="form-group">
			<label for="name">Phone Number:</label> <input type="text"
				name="phoneno" class="form-control" placeholder="Enter Phone Number"
				required />
		</div>
		<div class="form-group">
			<label for="name">Email Id:</label> <input type="text" name="emailid"
				class="form-control" placeholder="Enter Email Id" required />
		</div>
		<button type="submit" name="submitcreate" class="btn btn-default">Submit</button>
	</form>
</div>


<div class="container">
	<h2>Delete user API</h2>
	<form class="form-inline" action="" method="POST">
		<div class="form-group">
			<label for="name">User Name:</label> <input type="text" name="uname"
				class="form-control" placeholder="Enter User Name" required />
		</div>
		<button type="submit" name="submitdelete" class="btn btn-default">Delete</button>
	</form>
</div>
