<?php $this->load->view('home/templates/base-header'); ?>
<?php $this->load->view('home/templates/base-nav'); ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-12">
            <div id="editormd-view">
                <textarea style="display:none;" name="editormd-markdown-doc"><?php echo ">**".$article_info['outline']."**\r\n\r\n".$article_info['md_content']; ?></textarea>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <?php $this->load->view('home/templates/base-container-footer'); ?>
</div>
<!-- /.container -->
<?php $this->load->view('home/templates/base-css-js'); ?>
<link rel="stylesheet" href="/application/assets/markdown-editor/css/editormd.preview.css" />
<link rel="stylesheet" href="/application/assets/markdown-editor/css/editormd.css" />
<script src="/application/assets/markdown-editor/lib/marked.min.js"></script>
<script src="/application/assets/markdown-editor/lib/prettify.min.js"></script>
<script src="/application/assets/markdown-editor/lib/raphael.min.js"></script>
<script src="/application/assets/markdown-editor/lib/underscore.min.js"></script>
<script src="/application/assets/markdown-editor/lib/sequence-diagram.min.js"></script>
<script src="/application/assets/markdown-editor/lib/flowchart.min.js"></script>
<script src="/application/assets/markdown-editor/lib/jquery.flowchart.min.js"></script>
<script src="/application/assets/markdown-editor/editormd.min.js"></script>
<script type="text/javascript">
    var editormdView;
    $(document).ready(function(){
        editormdView = editormd.markdownToHTML("editormd-view", {
//                        markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
//            htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            //toc             : false,
            tocm            : true,    // Using [TOCM]
//            tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
            //gfm             : false,
            //tocDropdown     : true,
//            markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    })
</script>
<?php $this->load->view('home/templates/base-end'); ?>
