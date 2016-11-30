<?php $this->load->view('admin/templates/base-header');?>
<body>
    <div id="wrapper">
        <?php $this->load->view('admin/templates/base-nav'); ?>
        <div id="page-wrapper">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="/admin/index/index">管理后台</a></li>
                    <li><a href="/admin/articlemanager/index">博客管理</a></li>
                    <li class="active">标签管理</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tasks"></i> 全部标签列表
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div id="toolbar">
                                    <button type="button" class="btn btn-sm btn-primary" id="add-label">新增</button>
                                    <button id="update-label" type="button" class="btn btn-sm btn-success" disabled>更新</button>
                                    <button id="remove-label" class="btn btn-sm btn-danger" disabled>删除</button>
                                </div>
                                <br>
                                <table id="table"
                                       data-toolbar="#toolbar"
                                       data-url="getLabelLists"
                                       data-pagination="true"
                                       data-search="true"
                                       data-show-refresh="true"
                                       data-click-to-select="true"
                                >
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 添加/更新标签静态框（Modal） -->
            <div class="modal fade" id="newLabelModal" tabindex="-1" role="dialog"
                 aria-labelledby="newLabelModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                    data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="newLabelModal">
                                <span id="modal-title">新增标签</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form id="form-new-label" method="post" action="/admin/labelmanager/addLabel" role="form" class="bs-example bs-example-form">
                                <div class="input-group">
                                    <span class="input-group-addon">标签名称</span>
                                    <input type="text" id="new-label-name" class="form-control" placeholder="请输入标签名称">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                关闭
                            </button>
                            <button type="button" class="btn btn-primary" id="new-label-submit-btn">
                                确定
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
        </div>
    </div>
    <!-- /#wrapper -->
</body>
<?php $this->load->view('admin/templates/base-css-js'); ?>
<link rel="stylesheet" href="/application/assets/bootstrap-table/bootstrap-table.css">
<script src="/application/assets/public/js/common.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table.js"></script>
<script src="/application/assets/bootstrap-table/bootstrap-table-zh-CN.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var handerType = 1; //操作类型
        $('#update-label').attr('disabled',true);
        $('#remove-label').attr('disabled',true);
        $('#table').bootstrapTable({
            columns: [{
                radio: true,
                align: 'center',
                valign: 'middle'
            },{
                field: 'id',
                title: '#ID'
            }, {
                field: 'label_name',
                title: '标签名称'
            }, {
                field: 'format_update_time',
                title: '最近更新时间'
            }, {
                field: 'format_m_time',
                title: '添加时间'
            }]
        });
        function updateModalInfo(titleStr,labelName){
            $("#modal-title").html(titleStr)
            $('#new-label-name').val(labelName);
        }
        //获取选中的id
        function getSelectedLabelItem(){
            var selectItems = $('#table').bootstrapTable('getSelections');
            if(!isNull(selectItems)){
                var selectLabelItem = selectItems[0];
            }
            return selectLabelItem;
        }
        $('#table').on('page-change.bs.table', function () {
            $('#update-label').attr('disabled',true);
            $('#remove-label').attr('disabled',true);
        });
        $('#table').on('check.bs.table', function () {
            $('#update-label').removeAttr('disabled');
            $('#remove-label').removeAttr('disabled');
        });
        //新增/保存标签按钮
        $("#new-label-submit-btn").click(function(){
            var newLabelName = $('#new-label-name').val();
            if(isNull(newLabelName)){
                alert('标签名不能为空');
                return;
            }
            if(handerType == 1){
                var url = "/admin/labelmanager/addLabel";
                var data = {label_name : newLabelName};
            }else{
                var url = "/admin/labelmanager/saveLabel";
                var selectedLabelItem = getSelectedLabelItem();
                var data = {id: selectedLabelItem.id , label_name : newLabelName};
            }
            $.ajax({
                url: url,
                data:data,
                method: 'post',
                dataType: 'json',
                success: function(json){
                    if(json.status == 1){
                        $('#table').bootstrapTable('refresh',{url:"getLabelLists"});
                        $('#new-label-name').val('');
                        $('#newLabelModal').modal('hide');
                        alert(json.msg);
                    }
                }
            });
        });
        //删除标签
        $("#remove-label").click(function(){
            var selectedLabelItem = getSelectedLabelItem();
            if(isNull(selectedLabelItem)){
                alert("请选中需要删除的标签");
            }else{
                $.get("/admin/labelmanager/deleteLabel",{label_id:selectedLabelItem.id},function(json){
                    $('#table').bootstrapTable('refresh',{url:"getLabelLists"});
                    if(json.status == 1){
                        alert(json.msg);
                    }
                },"json");
            }
        });

        //新增按钮操作
        $('#add-label').click(function(){
            handerType = 1;
            updateModalInfo('新增标签','');
            $('#newLabelModal').modal('show');
        });

        //更新按钮操作
        $('#update-label').click(function(){
            handerType = 2;
            var selectedLabelItem = getSelectedLabelItem();
            if(isNull(selectedLabelItem)){
                alert("请选中需要修改的标签");
            }else{
                updateModalInfo('修改标签',selectedLabelItem.label_name);
                $('#newLabelModal').modal('show');
            }
        });
    });
</script>
<?php $this->load->view('admin/templates/base-footer'); ?>