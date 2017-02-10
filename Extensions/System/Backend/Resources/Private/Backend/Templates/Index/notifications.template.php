<a href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'notifications']) ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-fw fa-2x fa-envelope-o fa-alerted"></i> <?= $this->__('backend.menu.notifications') ?>
</a>
<ul class="dropdown-menu media-list">
    <li class="dropdown-header"><strong>9</strong> new notifications</li>
    <li role="separator" class="divider"></li>
    <li class="media">
        <a href="#">
            <div class="media-left">
                <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
            </div>
            <div class="media-body">
                <small class="pull-right time"><i class="fa fa-clock-o"></i> 10:30</small>
                <h4 class="media-heading">Gringo Deluxe</h4>
                <small>has published an article <strong>Lorem ipsum dolor sit amec</strong></small>
            </div>
        </a>
    </li>
    <li role="separator" class="divider"></li>
    <li class="media">
        <a href="#">
            <div class="media-left">
                <img src="<?= $this->helper('Image')->getPath('Images/profile_pic2.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
            </div>
            <div class="media-body">
                <small class="pull-right time"><i class="fa fa-clock-o"></i> 08:21</small>
                <h4 class="media-heading">Dickbutt</h4>
                <small>has added the content element <strong>Contact us</strong> to the <span class="label label-success">LIVE workspace</span></small>
            </div>
        </a>
    </li>
    <li role="separator" class="divider"></li>
    <li class="media">
        <a href="#">
            <div class="media-left">
                <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
            </div>
            <div class="media-body">
                <small class="pull-right time"><i class="fa fa-clock-o"></i> 22 oct.</small>
                <h4 class="media-heading">Gringo Deluxe</h4>
                <small>has restored the deleted content element <strong>Untitled [id: 301]</strong></small>
            </div>
        </a>
    </li>
    <li role="separator" class="divider"></li>
    <li class="media">
        <a href="#">
            <div class="media-left">
                <img src="<?= $this->helper('Image')->getPath('Images/logo_negru.svg', 'Backend'); ?>" height="40" alt="" class="img-circle">
            </div>
            <div class="media-body">
                <small class="pull-right time"><i class="fa fa-clock-o"></i> 20 oct.</small>
                <h4 class="media-heading">System notification</h4>
                <p><small>Your logs have not been purged for the past 30 days.<br/>Please configure your cron jobs for automatic purge!</small></p>
            </div>
        </a>
    </li>
    <li role="separator" class="divider"></li>
    <li class="media">
        <a href="#">
            <div class="media-left">
                <img src="<?= $this->helper('Image')->getPath('Images/logo_negru.svg', 'Backend'); ?>" height="40" alt="" class="img-circle">
            </div>
            <div class="media-body">
                <small class="pull-right time"><i class="fa fa-clock-o"></i> 20 oct.</small>
                <h4 class="media-heading">System notification</h4>
                <p><small>3 new <span class="label label-danger">failed</span> connection attempts.<br/>Check the logs for more information!</small></p>
            </div>
        </a>
    </li>
    <li role="separator" class="divider"></li>
    <li>
        <a href="#">
            Show all notifications
        </a>
    </li>
</ul>