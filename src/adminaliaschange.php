<?php
include_once dirname(__FILE__) . '/config/authpostmaster.php';
  $query = "SELECT localpart,realname,smtp,on_avscan,on_spamassassin,
    admin,enabled FROM users 	
	WHERE user_id='{$_GET['user_id']}' AND domain_id='{$_SESSION['domain_id']}' AND type='alias'";
  $result = $db->query($query);
  if ($result->numRows()) {
    $row = $result->fetchRow();
  }
$tmplVars['title'] = _('Manage Users');
include 'templates/header.php';
?>
    <div id="menu">
      <a href="adminalias.php"><?php echo _('Manage Aliases'); ?></a><br>
      <a href="adminaliasadd.php"><?php echo _('Add Alias'); ?></a></br>
      <a href="admin.php"><?php echo _('Main Menu'); ?></a><br>
      <br><a href="logout.php"><?php echo _('Logout'); ?></a><br>
    </div>
    <div id="Forms">
	<?php 
		# ensure this page can only be used to view/edit aliases that already exist for the domain of the admin account
		if (!$result->numRows()) {			
			echo '<table align="center"><tr><td>';
			echo "Invalid alias userid '" . htmlentities($_GET['user_id']) . "' for domain '" . htmlentities($_SESSION['domain']). "'";			
			echo '</td></tr></table>';
		}else{	
	?>
	<form name="aliaschange" method="post" action="adminaliaschangesubmit.php">
        <table align="center">
          <tr>
            <td><?php echo _('Alias Name'); ?>:</td>
            <td>
              <input name="realname" type="text"
              value="<?php print $row['realname']; ?>"class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Address'); ?>:</td>
            <td>
              <input name="localpart" type="text"
              value="<?php print $row['localpart']; ?>"class="textfield">
              @<?php print $_SESSION['domain']; ?>
            </td>
          </tr>
          <tr>
            <td>
              <input name="user_id" type="hidden"
              value="<?php print $_GET['user_id']; ?>" class="textfield">
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-bottom:1em">
              <?php
                echo _('Multiple addresses should be comma separated,
                with no spaces');
              ?>
            </td>
          </tr>
          <tr>
            <td><?php echo _('Forward To'); ?>:</td>
            <td>
              <input name="target" type="text" size="30"
              value="<?php print $row['smtp']; ?>" class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Password'); ?>:</td>
            <td>
              <input name="password" type="password" size="30" class="textfield">
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-bottom:1em">
              (<?php echo _('Password only needed if you want the user to be
              able to log in, or if the Alias is the admin account'); ?>)
            </td>
          </tr>
          <tr
            ><td><?php echo _('Verify Password'); ?>:</td>
            <td>
              <input name="vpassword" type="password" size="30" class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Admin'); ?>:</td>
            <td>
              <input name="admin" type="checkbox"
              <?php if ($row['admin'] == 1) {
                print "checked";
              } ?> class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Anti-Virus'); ?>:</td>
            <td>
              <input name="on_avscan" type="checkbox"
              <?php if ($row['on_avscan'] == 1) {
                print "checked";
              } ?> class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Spamassassin'); ?>:</td>
            <td>
              <input name="on_spamassassin" type="checkbox"
              <?php if ($row['on_spamassassin'] == 1) {
                print "checked";
              } ?> class="textfield">
            </td>
          </tr>
          <tr>
            <td><?php echo _('Enabled'); ?>:</td>
            <td>
              <input name="enabled" type="checkbox"
              <?php if ($row['enabled'] == 1) {
                print "checked";
              } ?> class="textfield">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="button">
              <input name="submit" type="submit"
              value="<?php echo _('Submit'); ?>">
            </td>
          </tr>
        </table>
      </form>
		<?php 		
			# end of the block editing an alias within the domain
		}  
		?>	
    </div>
<?php
include 'templates/footer.php';