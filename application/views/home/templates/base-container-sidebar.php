<!-- Blog Sidebar Widgets Column -->
<div class="col-md-3 col-sm-3">
    <!-- Blog Search Well -->
    <!--<div class="well">
        <h4>文章搜索</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>-->
    <!-- Blog Categories Well -->
    <div class="panel panel-default" style="width: 300px">
        <div class="panel-heading">
            <h3 class="panel-title">
                文章标签
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php foreach ($label_lists as $item): ?>
                    <div class="div-label">
                        <span class="label label-primary" onclick="searchArticleByLabel( <?=$item['id']?> )"><?=$item['label_name']?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div id='calendar'></div>
    <!-- Side Widget Well -->
    <!--<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                侧边栏公告
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <p>公告栏内容..</p>
            </div>
        </div>
    </div>-->
</div>