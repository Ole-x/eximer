<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
echo _('Eximer');
/**
 * @global array $tmplVars
 */
if (null !== $tmplVars['title'])
{
    echo ': ' . $tmplVars['title'];
}
        ?></title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="themes/default/all.css">
    </head>
    <body class="page">
<?php
if (isset($_SESSION['domain_id']))
{
    $manager = DvaSlona\Eximer\DB\Manager::getInstance();
    /** @var \DvaSlona\Eximer\DB\Object\Domain $domain */
    $domain = $manager->getRepository('Domain')->find($_SESSION['domain_id']);
    if (null !== $domain)
    {
        /** @var \DvaSlona\Eximer\DB\Object\User $user */
        $user = $manager->getRepository('User')->findOneBy(array(
            'localpart' => $_SESSION['localpart'],
            'domain_id' => $_SESSION['domain_id']
        ));
    }
}
?>
        <div class="page-header">
            <a href="https://github.com/DvaSlona/eximer" target="_blank" class="app-title"><?php echo _('Eximer'); ?></a>
            <?php  if (isset($domain)) echo '— ' . $_SESSION['domain']; ?>
<?php
if (isset($domain))
{
    if (null === $domain || !$domain->isEnabled())
    {
        echo _('— domain disabled (please see your administrator).');
    }
    elseif (null === $user || !$user->isEnabled())
    {
        echo _('— account disabled (please see your administrator).');
    }
}
// First a few status messages about account maintenance
if (isset($_GET['added'])) {
    printf (_("-- %s has been successfully added."), $_GET['added']);
} else if (isset($_GET['deleted'])) {
    printf (_("-- %s has been successfully deleted."), $_GET['deleted']);
} else if (isset($_GET['lastadmin'])) {
    printf (_("-- %s is the last admin account. Create another admin account before deleting or demoting this one."), $_GET['lastadmin']);
} else if (isset($_GET['sitepass'])) {
    print   _("-- Site Admin password has been successfully updated.") . "\n";
} else if (isset($_GET['updated'])) {
    printf (_("-- %s has been successfully updated."), $_GET['updated']);
} else if (isset($_GET['userexists'])) {
    printf (_("-- The account could not be added as the name %s is already in use."), $_GET['userexists']);
} else if (isset($_GET['userupdated'])) {
    print   _("-- Your update was sucessful.");
} else if (isset($_GET['userfailed'])) {
    print   _("-- Your account could not be updated. Was your password blank?");
} else if (isset($_GET['usersuccess'])) {
    print   _("-- Your account has been succesfully updated.");
} else if (isset($_GET['uservacationtolong'])) {
    printf (_('-- Your vacation message was too long: %1$d characters. It has been truncated at %2$d.'), $_GET['uservacationtolong'], $max_vacation_length);
} // Now some more general errors on account updates
else if (isset($_GET['badaliaspass'])) {
    printf (_("-- Account %s could not be added. Your passwords do not match, or contain illegal characters: ' \" ` or ;"), $_GET['badaliaspass']);
} else if (isset($_GET['badname'])) {
    printf (_("-- %s contains invalid characters."), $_GET['badname']);
} else if (isset($_GET['badpass'])) {
    printf (_("-- Account %s could not be added. Your passwords were blank, do not match, or contain illegal characters: ' \" ` or ;"), $_GET['badpass']);
} else if (isset($_GET['baddestdom'])) {
    print   _("-- The destination domain you specified does not exist.");
} else if (isset($_GET['blankname'])) {
    print   _("-- You can not specify a blank realname.");
} else if (isset($_GET['failadded'])) {
    printf (_("-- %s could not be added."), $_GET['failadded']);
} else if (isset($_GET['failaddedpassmismatch'])) {
    printf (_("-- Domain %s could not be added. The passwords were blank, or did not match."), $_GET['failaddedpassmismatch']);
} else if (isset($_GET['failaddedusrerr'])) {
    printf (_("-- Domain %s could not be added. There was a problem adding the admin account."), $_GET['failaddedusrerr']);
} else if (isset($_GET['faildeleted'])) {
    printf (_("-- %s was not deleted."), $_GET['faildeleted']);
} else if (isset($_GET['failupdated'])) {
    printf (_("-- %s could not be updated."), $_GET['failupdated']);
} // Now some really general status messages
else if (isset($_GET['canceldelete'])) {
    printf (_("-- Deletion of %s was canceled."), $_GET['canceldelete']);
} else if (isset($_GET['domaindisabled'])) {
    print   _("-- This domain is currently disabled. Please see your administrator.");
} else if (isset($_GET['maxaccounts'])) {
    print   _("-- Your Domain Account Limit Has Been Reached. Please contact your administrator.");
} else if (isset($_GET['quotahigh'])) {
    printf (_("-- The quota you specified was too high. The maximum quota you can specify is: %s MB."), $_GET['quotahigh']);
} else if (isset($_GET['group_deleted'])) {
    printf (_("-- Group %s has been successfully deleted."), $_GET['group_deleted']);
} else if (isset($_GET['group_added'])) {
    printf (_("-- Group %s has been successfully added."), $_GET['group_added']);
} else if (isset($_GET['group_faildeleted'])) {
    printf (_("-- Group %s was not deleted."), $_GET['group_faildeleted']);
} else if (isset($_GET['group_failadded'])) {
    printf (_("-- Group %s failed to be added."), $_GET['group_failadded']);
} else if (isset($_GET['group_updated'])) {
    printf (_("-- Group %s has been updated."), $_GET['group_updated']);
} else if (isset($_GET['group_failupdated'])) {
    printf (_("-- Group %s could not be updated."), $_GET['group_failupdated']);
} else if (isset($_GET['failuidguid'])) {
    printf (_("-- Error getting UID/GID for %s"), $_GET['failuidguid']);
}
if (isset($_GET['login']) && ($_GET['login'] == "failed")) { print _("Login failed"); }
?>
        </div>