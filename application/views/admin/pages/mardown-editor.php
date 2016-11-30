<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>Simple example - Editor.md examples</title>
    <link rel="stylesheet" href="/application/assets/markdown-editor/css/style.css" />
    <link rel="stylesheet" href="/application/assets/markdown-editor/css/editormd.css" />
<!--    <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />-->
</head>
<body>
<div id="layout">
    <div id="test-editormd">
        <textarea style="display:none;">
            123
        </textarea>
    </div>
</div>
<!--<link rel="stylesheet" href="/application/assets/markdown-editor/css/style.css" />-->
<!--<link rel="stylesheet" href="/application/assets/markdown-editor/css/editormd.css" />-->
<script src="/application/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/application/assets/markdown-editor/editormd.min.js"></script>
<script type="text/javascript">
    var testEditor;
    $(function() {
        testEditor = editormd("test-editormd", {
            width   : "90%",
            height  : 640,
            syncScrolling : "single",
            path    : "/application/assets/markdown-editor/lib/"
        });
    });
</script>
</body>
</html>