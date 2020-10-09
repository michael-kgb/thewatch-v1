<section id="featured">
    <div class="container-fluid">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-title-brand">FEATURED NEWS</div>
                </div>
            </div>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <?php if ($row->news_sequence == 1) { ?>
                        <div class="row">
                        <?php } elseif ($row->news_sequence == 4) { ?>
                            <div class="row box-featured-news"> 
                            <?php } ?>
                            <div class="col-md-3 <?php echo $row->news_sequence === 1 || $row->news_sequence === 4 ? 'col-md-offset-1' : 'col-md-offset-0'; ?> <?php echo $row->news_sequence === 1 || $row->news_sequence === 2 || $row->news_sequence === 4 || $row->news_sequence === 6 ? ' custom' : ''; ?>">
                                <img style="width: 100%;" class="img-responsive" src="img/news/<?php echo $row->news_thumbnail; ?>">
                                <div class="content-title featured"><?php echo $row->news_caption; ?></div>
                                <div style="width: 100%;" class="content-text featured">
                                    <div style="height: 50px;"><?php echo strtoupper($row->news_short_description); ?></div>
                                    <div class="clearfix"></div>
                                    <?php echo '<i>'.strtoupper(date("l, j F Y", strtotime($row->news_publish_date))) . '</i>'; ?>
                                </div>
                            </div>
                            <?php if ($row->news_sequence == 3 || $row->news_sequence == 6) { ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <div class="row">
                    <div class="col-md-3 col-md-offset-5 explore-all">
                        <a class="all-news-btn hidden-xs" href="news">EXPLORE ALL NEWS</a>
                        <div class="all-news-btn hidden-lg hidden-md hidden-sm">
                            <a href="news" style="color: #2e4359;">EXPLORE ALL NEWS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>