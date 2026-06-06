<div class="card mt-4">

<div class="card-body">


<h5>

🟢 Active Users

</h5>



<table class="table">


<tr>

<th>User</th>

<th>IP</th>

<th>Started</th>

<th>Download</th>

<th>Upload</th>

<th>Status</th>


</tr>




<?php foreach($activeUsers as $a): ?>

<tr>


<td><?=$a['username']?></td>


<td><?=$a['framedipaddress']?></td>


<td><?=$a['acctstarttime']?></td>


<td><?=$a['download']?> MB</td>


<td><?=$a['upload']?> MB</td>


<td>

<span class="badge bg-success">

🟢 Online

</span>

</td>


</tr>


<?php endforeach; ?>


</table>


</div>

</div>