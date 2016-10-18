<h2>Dashboard</h2>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-pie-chart"></i> Chart demos
                <a href="" class="pull-right btn btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="myChart" width="400" height="400"></canvas>
                        <script type="text/javascript">
                            var ctx = $("#myChart");
                            var myChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ["New visitors", "Returning visitors"],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [12, 19],
                                        backgroundColor: [
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 206, 86, 0.5)'
                                        ],
                                        borderColor: [
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)'
                                        ],
                                        borderWidth: 1
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
                    <div class="col-sm-6">
                        <canvas id="myChart2" width="400" height="400"></canvas>
                        <script type="text/javascript">
                            var ctx = $("#myChart2");
                            var myChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ["New visitors", "Returning visitors", "Mobile visitors"],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [12, 19, 3],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)'
                                        ],
                                        borderWidth: 1
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
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-pie-chart"></i> Chart demos
                <a href="" class="pull-right btn btn-default">View complete list</a>
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
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1
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
                <a href="" class="pull-right btn btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <canvas id="myChart4" width="400" height="200"></canvas>
                <script type="text/javascript">
                    var ctx = $("#myChart4");
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ["www.domain1.ch", "www.hautehorlogerie.org", "www.another-domain.com"],
                            datasets: [{
                                label: '# of pages',
                                data: [120, 19, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)'
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
                <i class="fa fa-fw fa-pie-chart"></i> Content statistics
                <a href="" class="pull-right btn btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p><strong>2</strong> domains in total:</p>
                <h4>www.domain1.ch</h4>
                <div class="list-element"><span class="badge">15</span> pages and <span class="badge">100</span> content
                    elements <span class="pull-right">Allemand <i class="flag-icon flag-icon-de"></i></span></div>
                <div class="list-element"><span class="badge">10</span> pages and <span class="badge">92</span> content
                    elements <span class="pull-right">Français <i class="flag-icon flag-icon-fr"></i></span></div>
                <h4>www.domain2.ch</h4>
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
                <a href="" class="pull-right btn btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p>Elements to review and validate before they are shown on the website:</p>
                <div class="list-element">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href=""><i class="fa fa-fw fa-eye"></i> View</a></li>
                            <li><a href=""><i class="fa fa-fw fa-thumbs-up text-success"></i> Validate</a></li>
                            <li><a href=""><i class="fa fa-fw fa-thumbs-down text-danger"></i> Refuse</a></li>
                        </ul>
                    </div>
                    <i class="fa fa-fw fa-file-o"></i> Page: <strong>Our solutions [id: 100]</strong> created by <strong><a href="">Gringo Deluxe</a></strong> today at 10:32
                </div>
                <div class="list-element">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href=""><i class="fa fa-fw fa-eye"></i> View</a></li>
                            <li><a href=""><i class="fa fa-fw fa-thumbs-up text-success"></i> Validate</a></li>
                            <li><a href=""><i class="fa fa-fw fa-thumbs-down text-danger"></i> Refuse</a></li>
                        </ul>
                    </div>
                    <i class="fa fa-fw fa-file-text-o"></i> Content: <strong>Winners of the Odissey competition [id: 422]</strong> created by <strong><a href="">Gringo Deluxe</a></strong>
                    on the 24th june at 09:22
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="panel panel-dashboard">
            <div class="panel-heading">
                <i class="fa fa-fw fa-history"></i> History \ Recovery
                <a href="" class="pull-right btn btn-default">View complete list</a>
            </div>
            <div class="panel-body">
                <p>List of recently removed pages or content elements:</p>
                <div class="list-element"><i class="fa fa-fw fa-file-o"></i> Page: <strong>Comics HAC! BD [id:
                        32]</strong> yesterday at 10:32 <a class="pull-right btn btn-sm btn-danger" href=""><i
                            class="fa fa-fw fa-recycle"></i> Restore</a></div>
                <div class="list-element"><i class="fa fa-fw fa-file-text-o"></i> Content: <strong>-- No title -- [id:
                        102]</strong> 24th june at 09:22 <a class="pull-right btn btn-sm btn-danger" href=""><i
                            class="fa fa-fw fa-recycle"></i> Restore</a></div>
                <div class="list-element"><i class="fa fa-fw fa-question-circle"></i> News: <strong>Getting ready for
                        the competition [id: 42]</strong> yesterday at 22:30 <a class="pull-right btn btn-sm btn-danger"
                                                                                href=""><i
                            class="fa fa-fw fa-recycle"></i> Restore</a></div>
                <div class="list-element"><i class="fa fa-fw fa-file-o"></i> Page: <strong>About us [id: 123]</strong>
                    20th june at 13:50 <a class="pull-right btn btn-sm btn-danger" href=""><i
                            class="fa fa-fw fa-recycle"></i> Restore</a></div>
            </div>
        </div>
    </div>
</div>