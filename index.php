<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
// Place the advert text into a variable
// Implement a for loop to display the message about 10 times
function create_ad() {
    $ad = 'This is the Midterm! ';
     echo "<div class='alert alert-info' role='alert'><p>";
    for ($i = 0; $i < 10; $i++) {
     echo "$ad";
    }
    echo "</p></div>";
}

 
$page_title = 'Welcome to this Site!';
include('includes/header.html');

// Call the function:
create_ad();
?>

<div class="page-header"><h1>Content Header</h1></div>
<p>The midterm includes all we have learned so far. Please use accessible styles.
Your site will display data from the tech_support database. In addition to the home page, the
customer, incidents and technicians’ pages, supply additional pages to show the following
information or provide functionality:</p>

<p>1. Add two hyperlinks to the customer page (see example below). When hyperlinks are clicked: </p> 
<p>a) Display incidents for this customer (HINT: most customers have NO incidents)</p>
<p>b) Display products this customer has registered for </p>
<p>2. On the technician’s page, provide an EDIT link so technician information can be updated
(NOT the ID)</p>
<p>Show a screen shot one of the pages you created running in Cloud9.</p>
<p>Show a screen shot of your cloud repo.</p>
<?php
// Call the function again:
create_ad();

include('includes/footer.html');
?>