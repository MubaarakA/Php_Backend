<div class="card shadow-sm mt-4">


<div class="card-body">



<h5>

Failed Transactions

</h5>




<table class="table">



<tr>


<th>ID</th>

<th>Number</th>

<th>Money</th>

<th>Status</th>

<th>Date</th>


</tr>




<?php foreach($failed as $f): ?>



<tr>


<td><?=$f['id']?></td>

<td><?=$f['number']?></td>

<td><?=$f['money']?></td>

<td><?=$f['status']?></td>

<td><?=$f['created_at']?></td>


</tr>



<?php endforeach; ?>



</table>


</div>


</div>