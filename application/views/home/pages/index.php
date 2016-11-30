<?php $this->load->view('home/templates/base-header'); ?>
<?php $this->load->view('home/templates/base-nav'); ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-9">
            <?php foreach ($lists as $item): ?>
                <h2>
                    <a target="_blank" href="/home/index/show/<?=$item['id']?>"><?=$item['title']?></a>
                </h2>
                <br/>
                <p>
                    <span class="glyphicon glyphicon-time"></span> Posted on <?=$item['format_update_time']?>
                </p>
                <p>
                    <span class="glyphicon glyphicon-tags"></span> <a href="/home/index/index?label=<?php echo $item['labels']; ?>"><?=$item['label_name']?></a>
                </p>
                <br />
                <p class="outline"> <?=$item['outline']?> </p>
                <br/>
                <a target="_blank" class="btn btn-primary btn-sm" href="/home/index/show/<?=$item['id']?>">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php endforeach; ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="/home/index/index/<?php echo $pre; ?><?php echo empty($label) ? "" : "?label=".$label ?> ">&larr; 上一页</a>
                </li>
                <li class="next">
                    <a href="/home/index/index/<?php echo $next; ?><?php echo empty($label) ? "" : "?label=".$label ?>">下一页 &rarr;</a>
                </li>
            </ul>
        </div>
        <?php $this->load->view('home/templates/base-container-sidebar'); ?>
    </div>
    <!-- /.row -->
    <?php $this->load->view('home/templates/base-container-footer'); ?>
</div>
<?php $this->load->view('home/templates/base-css-js'); ?>
<link rel="stylesheet" type="text/css" href="/application/assets/Simple-Calendar-gh-pages/stylesheets/simple-calendar.css">
<script type="text/javascript" src="/application/assets/Simple-Calendar-gh-pages/javascripts/simple-calendar.js"></script>
<script>
    var calendar = new SimpleCalendar('#calendar',
        {
            width: '300px',
            height: '300px'
        }
    );
</script>
<?php $this->load->view('home/templates/base-end'); ?>
