<div class="card mt-4">

<div class="card-body">


<h5>Users</h5>


<table class="table table-hover">


<tr>

<th>User</th>
<th>Password</th>
<th>Expiration</th>
<th>Download</th>
<th>Upload</th>
<th>Speed</th>
<th>Status</th>
<th>Action</th>

</tr>



<?php foreach($users as $u): ?>


<tr>


<td><?=$u['username']?></td>


<td><?=$u['password']?></td>


<td><?=$u['expiration']?></td>


<td><?=$u['download']?> MB</td>


<td><?=$u['upload']?> MB</td>


<td>

<span class="badge bg-primary">

<?=$u['speed']?>

</span>

</td>



<td>


<?php if($u['status']=="online"): ?>


<span class="badge bg-success">

🟢 Online

</span>


<?php else: ?>


<span class="badge bg-danger">

🔴 Offline

</span>


<?php endif; ?>


</td>




<td>


<a

class="btn btn-danger btn-sm"

href="controllers/DeleteController.php?user=<?=$u['username']?>"

>

Delete

</a>


</td>



</tr>



<?php endforeach; ?>


</table>


</div>

</div>