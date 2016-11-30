<?php
/**
 * Describe:
 * User: lufeng501206@gmail.com
 * Date: 2016-09-02 23:28
 */
?>
<?php $this->load->view('admin/templates/base-header'); ?>
<body>
<div id="wrapper">
    <?php $this->load->view('admin/templates/base-nav'); ?>
    <div id="page-wrapper">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/admin/index/index">管理后台</a></li>
                <li><a href="/admin/articlemanager/index">博客管理</a></li>
                <li class="active">文章编辑</li>
            </ol>
        </div>
        <div class="row">
            <br/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="title">文章标题</label>
                    <input type="text" class="form-control" id="title" value="<?php echo !empty($article_info['title']) ? $article_info['title'] : ""; ?>" placeholder="请输入文章标题">
                </div>
                <div class="form-group">
                    <label for="labels">文章标签</label>
                    <select class="form-control" id="labels" >
                        <option value="0">-- 请选择标签 --</option>
                        <?php foreach ($label_lists as $item): ?>
                            <option value="<?=$item['id']?>"><?=$item['label_name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="outline">文章大纲</label>
                    <textarea id="outline" class="form-control"><?=$article_info['outline']?></textarea>
                </div>
                <div class="form-group">
                    <label for="contents">文章内容</label>
                    <div id="markdown-editor">
                        <textarea style="display:none;"><?php echo !empty($article_info['md_content']) ? $article_info['md_content'] : ""; ?></textarea>
                    </div>
<!--                    <textarea id="markdown-editor" rows="12">--><?php //echo !empty($article_info['md_content']) ? $article_info['md_content'] : ""; ?><!--</textarea>-->
                </div>
                <button class="btn btn-lg btn-primary" id="submit-btn">提交</button>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</body>
<?php $this->load->view('admin/templates/base-css-js'); ?>
<link rel="stylesheet" href="/application/assets/bootstrap-table/bootstrap-table.css">
<script src="/application/assets/public/js/common.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table-zh-CN.js"></script>
<link rel="stylesheet" href="/application/assets/markdown-editor/css/editormd.css" />
<script src="/application/assets/markdown-editor/editormd.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var handerType = <?php echo $hander_type; ?>; //操作类型
        var articleId = <?php echo !empty($article_info['id']) ? $article_info['id'] : 0; ?>;
        var selectedLabel = <?php echo !empty($article_info['labels']) ? $article_info['labels'] : 0; ?>;
        $('#labels').val(selectedLabel);
        var markdownEditor = editormd("markdown-editor", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            saveHTMLToTextarea : true,
            path    : "/application/assets/markdown-editor/lib/"
        });
        $("#submit-btn").click(function(){
            var title = $("#title").val();
            var labels = $("#labels").val();
            var outline = $("#outline").val();
            var mdContent = markdownEditor.getMarkdown();
            var htmlContent = markdownEditor.getHTML();
            var data = {
                md_content : mdContent,
                html_content : htmlContent,
                title : title,
                labels : labels,
                outline : outline
            };

            console.log(data);

//            return;
            if(isNull(mdContent)){
                alert('请完善内容');
                return;
            }
            if(handerType == 1){
                var url = "/admin/articlemanager/addArticle";

            }else{
                data.id = articleId;
                var url = "/admin/articlemanager/saveArticle";
            }
            $.ajax({
                url: url,
                data:data,
                method: 'post',
                dataType: 'json',
                success: function(json){
                    if(json.status == 1){
                        alert(json.msg);
                        window.location.href = "/admin/articlemanager/index";
                    }
                }
            });
        });
    })
</script>
<?php $this->load->view('admin/templates/base-footer'); ?>