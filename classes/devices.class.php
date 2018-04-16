<<<<<<< HEAD
<?php

include_once ("db2.class.php");
class DeviceApi {

	public function getDeviceList($arrayparam) {

		$db2 = new db2();

		$db2->query("SELECT * FROM devices WHERE userid ='" .$arrayparam['userId'] ."' AND usertype='".$arrayparam['userType'] ."'");

		$result = $db2->resultset();

		return $result;

	}
}
=======
<?php

include_once ("db2.class.php");
class DeviceApi {

	public function getDeviceList($arrayparam) {

		$db2 = new db2();

		$db2->query("SELECT * FROM devices WHERE userid ='" .$arrayparam['userId'] ."' AND usertype='".$arrayparam['userType'] ."'");

		$result = $db2->resultset();

		return $result;

	}
}
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
