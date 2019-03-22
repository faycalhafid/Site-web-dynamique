
<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							
							<th>Commentaire</th>
							<th>Date</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';


$users = $object->Read($_POST['ID_recette']);

if (count($users) > 0) {

    foreach ($users as $user) {
        $data .= '<tr>
				
				<td>' . $user['Commentaire'] . '</td>
				<td>' . $user['date'] . '</td>
				<td>
					<button onclick="GetCommentDetails(' . $user['ID'] . ')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteUser1(' . $user['ID'] . ')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
        
    }
} else {
    // records not found
    $data .= '<tr><td colspan="6">Records not found!</td></tr>';
}

$data .= '</table>';

echo $data;

?>
	

			
