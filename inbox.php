<?php
    require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysql server
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if(!$link) {
        die('Failed to connect to server: ' . mysql_error());
    }
    
    //Select database
    $db = mysql_select_db(DB_DATABASE);
    if(!$db) {
        die("Unable to select database");
    }
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysql_query("SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_items = mysql_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysql_query("SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_messages = mysql_num_rows($messages);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Tables</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Home</a></li>
  <li><a href="foodzone.php">Food Zone</a></li>
  <li><a href="specialdeals.php">Special Deals</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo APP_NAME ?> Restaurant</div>
</div>
<div id="center">
<h1>MESSAGES</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-index.php">Home</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tables</a> | <a href="partyhalls.php">Party-Halls</a> | <a href="ratings.php">Rate Us</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Here you can ... For more information <a href="contactus.php">Click Here</a> to contact us.
<hr>
<table width="850" style="text-align:center;">
<CAPTION><h2>INBOX</h2></CAPTION>
<tr>
<th>From</th>
<th>Date Received</th>
<th>Time Received</th>
<th>Subject</th>
<th>Text</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($messages)){
echo "<tr>";
echo "<td>" . $row['message_from']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='350' align='left'>" . $row['message_text']."</td>";
echo "</tr>";
}
mysql_free_result($messages);
mysql_close($link);
?>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>