    <div class="col-sm-12">
        <h2>Manage your profile</h2>
    </div>
    <div class="col-sm-3">
        <div class="thumbnail">
            <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" alt="" class="">
            <div class="caption">
                <h3><?= $user->getName(); ?></h3>
                <p>Account created on<br/><span class="fa fa-calendar-check-o"></span> <small>13 dec 2016</small></p>
                <p>Last connected on<br/><span class="fa fa-calendar-check-o"></span> <small>15 dec 2016 at 14h30</small></p>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <form method="post" action="" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Id</label>
                <div class="col-sm-4">
                    <p class="form-control-static"><?php echo $user->getId(); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="username">Username</label>
                <div class="col-sm-4">
                    <p class="form-control-static"><?= $user->getUsername() ?></p>
                </div>
            </div>
            <?= $this->helper('FormObject')->selectField($user, 'language', 'Backend language', $this->helper('Locale')->iso2LanguageCodes(), $user->getLanguage()) ?>
            <?= $this->helper('FormObject')->textField($user, 'name', 'Full name', $user->getName()) ?>
            <div class="form-group">
                <label for="usergroup_id" class="col-sm-2 control-label">User group</label>
                <div class="col-sm-4">
                    <select name="usergroup_id" id="usergroup_id" class="form-control">
                        <option name="1">Admin group 1</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="picture">Profile picture</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="picture" placeholder="Profile picture" value="<?= $user->getUsername() ?>" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

        <hr/>

        <form method="post" action="" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <h3>Change password</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Current password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="current_password" placeholder="Current password" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">New password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="new_password" placeholder="New password" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Confirm new password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="new_password_confirm" placeholder="Confirm new password" value="" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
