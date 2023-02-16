<html>
<head>
  <title>Login with Facebook</title>
</head>
<body>
    <br>
<h2>Login using facebook Account with Codeigniter</h2>
<?php if (isset($fb['id']) && !empty($fb['id'])) { ?>
   
        <a href="<?php echo base_url('user/logout') ?>">Logout from facebook</a>
    
        <?php } else { ?>
    
        <a href="<?php echo $LogonUrl ?>"><img src="https://static-prod.adweek.com/wp-content/uploads/2017/04/ContinueWithFacebook-600x315.jpg"></a>
            
        <?php } ?>

        <?php
        // print_r($fb);    
        if (isset($fb['id']) && !empty($fb['id'])) {
            ?>
   
                <table class="table">
                    <tr>
                        <td>Id: </td>
                        <td><?php echo $fb['id'] ?></td>
                    </tr>
                    <tr>
                        <td>Name: </td>
                        <td><?php echo $fb['first_name'] . ' ' . $fb['last_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Profile Pic</td>
                        <td><img src="<?php echo $fb['picture']['data']['url']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?php echo $fb['email'] ?></td>
                    </tr>
                </table>
           
<?php } ?>
</body>
</html>