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
        <div class="panel panel-dashboard dashboard-domains">
            <div class="panel-heading">
                <i class="fa fa-fw fa-globe"></i> Content statistics
                <a href="" class="pull-right btn btn-sm btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <?php foreach ($domains->getAll() as $domain): ?>
                    <?php if ($domain->getDomainUrls()): ?>
                    <p><strong><?= $domain->getTitle() ?></strong></p>
                        <?php foreach ($domain->getDomainUrls() as $url): ?>
                        <div class="media">
                            <div class="media-left">
                                <i class="flag-icon flag-icon-<?= $url->getFlag() ?>"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?= $url->getUrl() ?></h4>
                                <span class="badge">15</span> pages and <span class="badge">100</span> content elements
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
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
                <i class="fa fa-fw fa-server"></i> <?= $this->__('backend.dashboard.system.title') ?>
                <a href="" class="pull-right btn btn-sm btn-default"><?= $this->__('backend.dashboard.system.viewSpecs') ?></a>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tr <?= (version_compare(PHP_VERSION, '5.5.0', '<')) ? 'class="danger"': ''; ?>>
                        <th width="50%"><?= $this->__('backend.dashboard.system.php') ?></th>
                        <td width="50%"><?= PHP_VERSION ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->__('backend.dashboard.system.server') ?></th>
                        <td><?= (isset($_SERVER['SERVER_SOFTWARE'])) ? $_SERVER['SERVER_SOFTWARE'] : $this->__('backend.dashboard.system.server.unknown'); ?></td>
                    </tr>
                </table>
                <p><?= $this->__('backend.dashboard.system.directives') ?></p>
                <table class="table table-striped">
                    <tr <?= ($this->helper('Units')->iniValueToBytes(ini_get('memory_limit')) < 33554432) ? 'class="danger"': ''; ?>>
                        <th width="50%">
                            <?= $this->__('backend.dashboard.system.directive.memory_limit') ?>
                        </th>
                        <td width="50%">
                            <small>memory_limit</small><br/>
                            <?= ini_get('memory_limit') ?>
                        </td>
                    </tr>
                    <tr <?= ((int)ini_get('max_execution_time') < 30) ? 'class="danger"': ''; ?>>
                        <th>
                            <?= $this->__('backend.dashboard.system.directive.max_execution_time') ?>
                        </th>
                        <td>
                            <small>max_execution_time</small><br/>
                            <?= ini_get('max_execution_time') ?>
                        </td>
                    </tr>
                    <tr <?= ($this->helper('Units')->iniValueToBytes(ini_get('post_max_size')) < 8388608) ? 'class="warning"': ''; ?>>
                        <th>
                            <?= $this->__('backend.dashboard.system.directive.post_max_size') ?>
                        </th>
                        <td>
                            <small>post_max_size</small><br/>
                            <?= ini_get('post_max_size') ?>
                        </td>
                    </tr>
                    <tr <?= ($this->helper('Units')->iniValueToBytes(ini_get('upload_max_filesize')) < 8388608) ? 'class="warning"': ''; ?>>
                        <th>
                            <?= $this->__('backend.dashboard.system.directive.upload_max_filesize') ?>
                        </th>
                        <td>
                            <small>upload_max_filesize</small><br/>
                            <?= ini_get('upload_max_filesize') ?>
                        </td>
                    </tr>
                    <tr <?= ((int)ini_get('max_input_vars') < 200) ? 'class="danger"': ''; ?>>
                        <th>
                            <?= $this->__('backend.dashboard.system.directive.max_input_vars') ?>
                        </th>
                        <td>
                            <small>max_input_vars</small><br/>
                            <?= ini_get('max_input_vars') ?>
                        </td>
                    </tr>
                    <tr <?= ini_get('display_errors') ? 'class="warning"': ''; ?>>
                        <th>
                            <?= $this->__('backend.dashboard.system.directive.display_errors') ?>
                        </th>
                        <td>
                            <small>display_errors</small><br/>
                            <?= ini_get('display_errors') ? $this->__('general.yes'): $this->__('general.no'); ?>
                        </td>
                    </tr>
                </table>
                <?php
                    $extensionsList = ['PDO', 'Reflection', 'bcmath', 'ctype', 'date', 'exif', 'fileinfo', 'filter', 'gd', 'iconv', 'intl', 'json', 'mbstring', 'pcre', 'posix', 'session', 'spl', 'standard', 'tokenizer', 'curl', 'dom', 'imagick', 'xml'];
                    $missingExtensions = [];
                    foreach ($extensionsList as $extension) {
                        if (!extension_loaded($extension)) {
                            $missingExtensions[] = $extension;
                        }
                    }
                ?>
                <?php if ($missingExtensions): ?>
                    <p class="text-danger">
                        <?= $this->__('backend.dashboard.system.extensionsMissing', ['count' => sizeof($missingExtensions)]) ?>
                        <?= implode(',', $missingExtensions); ?>
                    </p>
                <?php else: ?>
                    <p class="text-success"><?= $this->__('backend.dashboard.system.extensionsLoaded') ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>