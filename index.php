<?php

require "models/RadiusUser.php";
require "models/ActiveUser.php";
require "models/FailedTransaction.php";


$users = (new RadiusUser())->all();

$activeUsers = (new ActiveUser())->all();

$failed = (new FailedTransaction())->all();



include "views/layout/header.php";

include "views/create-form.php";

include "views/users-table.php";

include "views/active-users.php";

include "views/failed-table.php";

include "views/layout/footer.php";

?>