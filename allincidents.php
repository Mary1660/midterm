<?php # Script 10.5 - #5
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'All Open Incidents';
include('includes/header.html');
echo '<h1>All Open Incidents</h1>';

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
$q = "SELECT lastName, incidentID, title, productCode, dateOpened FROM incidents INNER JOIN technicians ON incidents.techID = technicians.techID";
$r = @mysqli_query($dbc, $q); // Run the query.

// Table header:
echo '<table width="80%">
<thead>
<tr>
		<th align="left">Tech Name</th>
		<th align="left">Incident ID</th>
		<th align="left">Title</th>
		<th align="left">Product Code</th>
		<th align="left">Date Opened</th>
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
		<td align="left">' .$row['incidentID'].'	</td>
		<td align="left">' .$row['title'].'	</td>
		<td align="left">' .$row['productCode'].'	</td>
		<td align="left">' .$row['dateOpened'].'	</td>
	</tr>  
	';
} // End of WHILE loop.

// <td align="left"><a href="allincidents.php?id=' .$row['incidents'] . '">Customer Incidents</a></td>

echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

include('includes/footer.html');
?>

