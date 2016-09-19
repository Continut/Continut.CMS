<div class="widget">
    <h3><?= $data["title"] ?></h3>
    <div id="owl-blog" class="owl-carousel">
        <?php foreach ($news->getAll() as $newsItem): ?>
            <div class="blog-carousel">
                <div class="entry">
                    <?php if ($newsItem->getImages()->count() > 0): ?>
                        <img class="img-responsive"
                             src="<?= $this->helper('Image')->crop($newsItem->getImages()->getFirst()->getRelativePath(), 800, 800, 'news') ?>"
                             alt=""/>
                    <?php endif ?>
                    <div class="magnifier">
                        <div class="buttons">
                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="post-type">
                        <i class="fa fa-picture-o"></i>
                    </div>
                </div>
                <div class="blog-carousel-header">
                    <h3><a title=""
                           href="blog-single-sidebar.html"><?= $this->helper("Text")->truncate($this->helper("Text")->stripTags($newsItem->getTitle()), 100) ?></a>
                    </h3>
                    <div class="blog-carousel-meta">
                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>