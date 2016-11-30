<?php $this->load->view('admin/templates/base-header'); ?>
<body>
    <div id="wrapper">
        <?php $this->load->view('admin/templates/base-nav'); ?>
        <div id="page-wrapper">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="/admin/index/index">管理后台</a></li>
                    <li><a href="/admin/articlemanager/index">博客管理</a></li>
                    <li class="active">文章管理</li>
                </ol>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tasks"></i> 全部文章列表
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div id="toolbar">
                                    <button id="add-article" type="button" class="btn btn-sm btn-primary">新增</button>
                                    <button id="update-article" type="button" class="btn btn-sm btn-success" disabled>更新</button>
                                    <button id="remove-article" class="btn btn-sm btn-danger" disabled>删除</button>
                                </div>
                                <br>
                                <table id="table"
                                       data-toolbar="#toolbar"
                                       data-url="getArticleLists"
                                       data-pagination="true"
                                       data-search="true"
                                       data-show-refresh="true"
                                       data-click-to-select="true"
                                    >
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- 添加文章静态（Modal） -->
            <div class="modal fade" id="newArticleModal" tabindex="-1" role="dialog"
                 aria-labelledby="newArticleModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                    data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                <span id="modal-title">新增文章</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">文章标题</label>
                                <input type="text" class="form-control" id="title" placeholder="请输入文章标题">
                            </div>
                            <div class="form-group">
                                <label for="labels">文章标签</label>
                                <select class="form-control" id="labels">
                                    <option value="0">-- 请选择标签 --</option>
                                    <?php foreach ($label_lists as $item): ?>
                                        <option value="<?=$item['id']?>"><?=$item['label_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contents">文章内容</label>
                                <textarea id="markdown-editor" rows="12"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                关闭
                            </button>
                            <button type="button" class="btn btn-primary" id="new-article-submit-btn">
                                确定
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
        </div>
    </div>
</body>
<?php $this->load->view('admin/templates/base-css-js'); ?>
<link rel="stylesheet" href="/application/assets/bootstrap-table/bootstrap-table.css">
<script src="/application/assets/public/js/common.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table-zh-CN.js"></script>
<link rel="stylesheet" href="/application/assets/bootstrap-markdown/css/bootstrap-markdown-editor.css"/>
<script type="text/javascript" src="/application/assets/bootstrap-markdown/js/bootstrap-markdown-editor.js"></script>
<script type="text/javascript" src="/application/assets/bootstrap-markdown/js/ace-builds/src-noconflict/ace.js"></script>
<script type="text/javascript" src="/application/assets/bootstrap-markdown/js/marked.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var handerType = 1; //操作类型
        function initMarkdownEditor() {
            $('#markdown-editor').markdownEditor({
                preview: true,
                onPreview: function (content, callback) {
                    callback( marked(content) );
                }
            });
        }

        $('#table').bootstrapTable({
            columns: [{
                radio: true,
                align: 'center',
                valign: 'middle'
            },{
                field: 'id',
                title: '#ID'
            }, {
                field: 'title',
                title: '标题'
            }, {
                field: 'labels',
                title: '文章标签'
            }, {
                field: 'format_update_time',
                title: '最近更新时间'
            }, {
                field: 'format_m_time',
                title: '添加时间'
            }]
        });

        $('#table').on('check.bs.table', function () {
            $('#update-article').removeAttr('disabled');
            $('#remove-article').removeAttr('disabled');
        });

        $('#table').on('page-change.bs.table', function () {
            $('#update-article').attr('disabled',true);
            $('#remove-article').attr('disabled',true);
        });

        //获取选中的id
        function getSelectedArticleItem(){
            var selectItems = $('#table').bootstrapTable('getSelections');
            if(!isNull(selectItems)){
                var selectArticleItem = selectItems[0];
            }
            return selectArticleItem;
        }

        function updateModalInfo(titleStr,titleName,labelId,mdContent){
            $("#modal-title").html(titleStr)
            $('#title').val(titleName);
            $('#labels').val(labelId);
            $('#markdown-editor').val(mdContent);
            initMarkdownEditor();
        }

        //新增按钮操作
        $('#add-article').click(function(){
            handerType = 1;
            window.location.href = "/admin/articlemanager/markdown";
        });

        //更新按钮操作
        $('#update-article').click(function(){
            handerType = 2;
            var selectedArticleItem = getSelectedArticleItem();
            console.log(selectedArticleItem);
            if(isNull(selectedArticleItem)){
                alert("请选中需要修改的文章");
                return;
            }else{
                window.location.href = "/admin/articlemanager/markdown/" + selectedArticleItem.id;
            }
        });

        //删除标签
        $("#remove-article").click(function(){
            var selectedArticleItem = getSelectedArticleItem();
            console.log(selectedArticleItem);
            if(isNull(selectedArticleItem)){
                alert("请选中需要删除的文章");
                return;
            }else{
                $.get("/admin/articlemanager/deleteArticle",{article_id:selectedArticleItem.id},function(json){
                    $('#table').bootstrapTable('refresh',{url:"getArticleLists"});
                    if(json.status == 1){
                        alert(json.msg);
                    }
                },"json");
            }

        });

        $("#new-article-submit-btn").click(function(){
            var title = $("#title").val();
            var labels = $("#labels").val();
            var mdContent = $("#markdown-editor").val();
            var htmlContent = marked(mdContent);
            var data = {
                md_content : mdContent,
                html_content : htmlContent,
                title : title,
                labels : labels
            };
            if(isNull(mdContent)){
                alert('请完善内容');
                return;
            }
            if(handerType == 1){
                var url = "/admin/articlemanager/addArticle";

            }else{
                var url = "/admin/articlemanager/saveArticle";
                var selectedArticleItem = getSelectedArticleItem();
                data.id = selectedArticleItem.id;
            }
            $.ajax({
                url: url,
                data:data,
                method: 'post',
                dataType: 'json',
                success: function(json){
                    if(json.status == 1){
                        $('#table').bootstrapTable('refresh',{url:"getArticleLists"});
                        $('#newArticleModal').modal('hide');
                        alert(json.msg);
                    }
                }
            });
        });
    })
</script>
<?php $this->load->view('admin/templates/base-footer'); ?>