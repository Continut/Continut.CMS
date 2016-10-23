<h2><?= $this->__('backend.dashboard') ?></h2>
<p><?= $this->__('backend.dashboard.welcome', ['fullname' => $user->getName()]) ?></p>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-users"></i> Visitors
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                        <canvas id="myChart2" width="400" height="200"></canvas>
                        <script type="text/javascript">
                            var ctx = $("#myChart2");
                            var myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ["New visitors", "Returning visitors", "Mobile visitors"],
                                    datasets: [{
                                        label: '# of visitors',
                                        data: [12, 19, 3],
                                        backgroundColor: [
                                            'rgba(36, 123, 160, 1)',
                                            'rgba(112, 193, 179, 1)',
                                            'rgba(243, 255, 189, 1)'
                                        ],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: true
                                    },
                                    scales: {
                                        yAxes: [{
                                            display: false
                                        }]
                                    }
                                }
                            });
                        </script>
                </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-bank"></i> Chart demos
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <canvas id="myChart3" width="400" height="200"></canvas>
                <script type="text/javascript">
                    var ctx = $("#myChart3");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["New visitors", "Returning visitors", "Mobile visitors"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3],
                                backgroundColor: [
                                    'rgba(36, 123, 160, 0.2)',
                                    'rgba(112, 193, 179, 0.2)',
                                    'rgba(255, 206, 86, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(36, 123, 160, 1)',
                                    'rgba(112, 193, 179, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 3
                            }]
                        },
                        options: {
                            legend: {
                                display: true
                            },
                            scales: {
                                yAxes: [{
                                    display: false
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-pie-chart"></i> Number of pages per domain
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <canvas id="myChart4" width="400" height="200"></canvas>
                <script type="text/javascript">
                    var ctx = $("#myChart4");
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ["www.domain1.ch", "www.dummy-domain.org", "www.another-domain.com"],
                            datasets: [{
                                label: '# of pages',
                                data: [120, 19, 3],
                                backgroundColor: [
                                    'rgba(36, 123, 160, 1)',
                                    'rgba(112, 193, 179, 1)',
                                    'rgba(243, 255, 189, 1)'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            legend: {
                                display: true
                            },
                            scales: {
                                yAxes: [{
                                    display: false
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-globe"></i> Content statistics
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p><strong>2</strong> domains in total:</p>
                <h4>www.domain1.ch</h4>
                <div class="list-element"><span class="badge">15</span> pages and <span class="badge">100</span> content
                    elements <span class="pull-right">Allemand <i class="flag-icon flag-icon-de"></i></span></div>
                <div class="list-element"><span class="badge">10</span> pages and <span class="badge">92</span> content
                    elements <span class="pull-right">Français <i class="flag-icon flag-icon-fr"></i></span></div>
                <h4>www.dummy-domain.org</h4>
                <div class="list-element"><span class="badge">15</span> pages and <span class="badge">100</span> content
                    elements <span class="pull-right">Italiano <i class="flag-icon flag-icon-it"></i></span></div>
                <div class="list-element"><span class="badge">10</span> pages and <span class="badge">92</span> content
                    elements <span class="pull-right">English <i class="flag-icon flag-icon-us"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-thumbs-up"></i> Review elements
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p>Elements to review and validate before they are shown on the website:</p>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Gringo Deluxe</h4>
                        created new <i class="fa fa-fw fa-file-o"></i> page: <strong>Our solutions [id: 100]</strong>
                        </br><small class="time"><i class="fa fa-clock-o"></i> 08:21</small>
                    </div>
                    <div class="media-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href=""><i class="fa fa-fw fa-eye"></i> View</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-up text-success"></i> Validate</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-down text-danger"></i> Refuse</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Gringo Deluxe</h4>
                        created new <i class="fa fa-fw fa-file-text-o"></i> content element: <strong>Winners of the Odissey competition [id: 422]</strong>
                        <br/><small class="time"><i class="fa fa-clock-o"></i> 21 oct. 10:15</small>
                    </div>
                    <div class="media-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href=""><i class="fa fa-fw fa-eye"></i> View</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-up text-success"></i> Validate</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-down text-danger"></i> Refuse</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic2.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Dickbutt</h4>
                        modified <i class="fa fa-fw fa-file-text-o"></i> content element: <strong>Untitled [id: 502]</strong>, changed: title, description, image
                        <br/><small class="time"><i class="fa fa-clock-o"></i> 21 oct. 10:15</small>
                    </div>
                    <div class="media-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href=""><i class="fa fa-fw fa-eye"></i> View</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-up text-success"></i> Validate</a></li>
                                <li><a href=""><i class="fa fa-fw fa-thumbs-down text-danger"></i> Refuse</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-history"></i> History \ Recovery
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p>List of recently removed pages or content elements:</p>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Gringo Deluxe</h4>
                        deleted <i class="fa fa-fw fa-file-o"></i> Page: <strong>Comics HAC! BD [id: 32]</strong>
                        </br><small class="time"><i class="fa fa-clock-o"></i> 07:00</small>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-sm btn-danger" href=""><i class="fa fa-fw fa-recycle"></i> Restore</a>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic2.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Dickbutt</h4>
                        deleted <i class="fa fa-fw fa-file-text-o"></i> Content: <strong>-- No title -- [id: 102]</strong>
                        <br/><small class="time"><i class="fa fa-clock-o"></i> 21 oct. 10:15</small>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-sm btn-danger" href=""><i class="fa fa-fw fa-recycle"></i> Restore</a>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic2.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Dickbutt</h4>
                        deleted <i class="fa fa-fw fa-question-circle"></i> news article: <strong>-- No title -- [id: 93]</strong>
                        <br/><small class="time"><i class="fa fa-clock-o"></i> 20 oct. 22:20</small>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-sm btn-danger" href=""><i class="fa fa-fw fa-recycle"></i> Restore</a>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic2.jpg', 'Backend'); ?>" height="40" alt="" class="img-circle">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Dickbutt</h4>
                        deleted <i class="fa fa-fw fa-file-o"></i> Page: <strong>About us [id: 123]</strong>
                        <br/><small class="time"><i class="fa fa-clock-o"></i> 17 oct. 13:15</small>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-sm btn-danger" href=""><i class="fa fa-fw fa-recycle"></i> Restore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>