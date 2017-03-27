<div class="container-inverse container-content container-fluid">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <h2><?= $data['title'] ?></h2>
                <p><?= $data['text'] ?></p>
                <form class="form-inline form-subscribe" action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" placeholder="your email address">
                    </div>
                    <button type="submit" class="btn btn-info">Notify me</button>
                </form>
            </div>
        </div>
    </div>
</div>