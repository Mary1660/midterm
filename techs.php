<?php # Script 10.5 - #5
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'Our Technicians';
include('includes/header.html');
echo '<h1>Our Technicians</h1>';

require('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'rd':
		$order_by = 'registration_date ASC';
		break;
	default:
		$order_by = 'registration_date ASC';
		$sort = 'rd';
		break;
}

// Define the query:
$q = "SELECT lastName, firstName, email, phone FROM technicians";

$r = @mysqli_query($dbc, $q); // Run the query.

// Table header:
echo '<table width="80%">
<thead>
<tr>
		<th align="left">Last Name</th>
		<th align="left">First Name</th>
		<th align="left">Email</th>
		<th align="left">Phone</th>
		<th align="left">Update</th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr> 
		<td align="left">' .$row['lastName'].'	</td>
		<td align="left">' .$row['firstName'].'	</td>
		<td align="left">' .$row['email'].'	</td>
		<td align="left">' .$row['phone'].'	</td>
		<td align="left"><a href="edit_tech.php?id=' .$row['incidents'] . '">Update Information</a></td>

	</tr>  
	';
} // End of WHILE loop.

// <td align="left"><a href="allincidents.php?id=' .$row['incidents'] . '">Customer Incidents</a></td>

echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

include('includes/footer.html');
?>
