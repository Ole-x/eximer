<?php
include_once dirname(__FILE__) . '/config/authpostmaster.php';
  $query = "SELECT localpart FROM users WHERE user_id='{$_GET['user_id']}' AND domain_id='{$_SESSION['domain_id']}' AND users.type='fail'";
  $result = $db->query($query);
  if ($result->numRows()) { $row = $result->fetchRow(); }
$tmplVars['title'] = _('Manage Users');
include 'templates/header.php';
?>
    <div id="menu">
      <a href="adminfail.php"><?php echo _('Manage Fails'); ?></a><br>
      <a href="adminfailadd.php"><?php echo _('Add Fail'); ?></a><br>
      <a href="admin.php"><?php echo _('Main Menu'); ?></a><br>
      <br><a href="logout.php"><?php echo _('Logout'); ?></a><br>
    </div>
    <div="Forms">
	<?php 
		# ensure this page can only be used to view/edit fail's that already exist for the domain of the admin account
		if (!$result->numRows()) {			
			echo '<table align="center"><tr><td>';
			echo "Invalid fail userid '" . htmlentities($_GET['user_id']) . "' for domain '" . htmlentities($_SESSION['domain']). "'";			
			echo '</td></tr></table>';
		}else{	
	?>
      <form name="failchange" method="post" action="adminfailchangesubmit.php">
	<table align="center">
	  <tr>
            <td><?php echo _('Fail address'); ?>:</td>
	    <td>
              <input name="localpart" type="text"
                value="<?php print $row['localpart']; ?>" class="textfield">@
              <?php print $_SESSION['domain']; ?>
            </td>
	    <td>
              <input name="user_id" type="hidden"
                value="<?php print $_GET['user_id']; ?>" class="textfield">
            </td>
          </tr>
	  <tr>
            <td></td>
            <td>
              <input name="submit" type="submit"
                value="<?php echo _('Submit'); ?>">
            </td>
          </tr>
	</table>
      </form>
		<?php 		
			# end of the block editing a fail within the domain
		}  
		?>	  
    </div>
<?php
include 'templates/footer.php';