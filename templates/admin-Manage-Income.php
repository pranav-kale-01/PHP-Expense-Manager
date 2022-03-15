<?php 
	include_once "../init.php";

	// User login checker
	if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
	}

	include_once 'admin-skeleton.php'; 

	// Deletes income record
	if(isset($_POST['delrec']))
	{
		$getFromI->delinc($_POST['ID']);
		echo "<script>
				Swal.fire({
					title: 'Done!',
					text: 'Record deleted successfully',
					icon: 'success',
					confirmButtonText: 'Cool!'
				})
				</script>";
	}	
?>

<div class="wrapper">
        <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                        
                        <i class="fas fa-ellipsis-h"></i>
                        <h3 style="font-family:'Source Sans Pro'; font-size: 1.5em;">
                            Income
                        </h3>
                   </div>
                   <div class="card-content">
                   <table>
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Item</th>
									<th>Cost</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
										$totinc = $getFromI->allinc('_');
										if($totinc !== NULL)
										{
											$len = count($totinc);
											for ($x = 1; $x <= $len; $x++) {
											echo "<tr>
												<td>".$x."</td>
												<td>".$totinc[$x-1]->Item."</td>
												<td>"."₹ ".$totinc[$x-1]->Cost."</td>
												<td>".date("d-m-Y",strtotime($totinc[$x-1]->Date))."</td>	
												<td><form style='margin-block-end: 0;' action='' method='post'><input style='display:none;' name='ID' value=".$totinc[$x-1]->ID."></input><button type='submit' name='delrec' class='btn btn-default' style='background:none; color:#8f8f8f; font-size:1em;'>
												<i class='far fa-trash-alt' style='color:red;'></i></button></form></td>
											</tr>";	
											}
										}
									?>
							</tbody>
						</table>
                   </div>
               </div>
           </div>
        </div>
</div>
