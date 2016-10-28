<div class="row">
    <div class='col-md-3'></div>
    <div class="col-md-6">
        <div class="login-box well">
            <div id="login_form">
                <form action="<?php echo site_url('adminlogin/login'); ?>" method="post">
                    <br/><br/><br/>
                    <legend>Sign In</legend>
                    <?php echo validation_errors('<p class ="error">');?>

                    <?php

                    $success = $this->session->flashdata('success');
                    $error = $this->session->flashdata('error');

                    if($success) { ?>
                        <div class="alert alert-success">
                            <a href="#" class="close alert-close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $success; ?>
                        </div>
                    <?php } if($error) { ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close alert-close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" value="<?php echo set_value('username');?>" name="username" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" />
                    </div>
                   
                    <div class="form-group">
                        <input type="submit" class="btn btn-default btn-login-submit btn-block m-t-md" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class='col-md-3'></div>
</div>