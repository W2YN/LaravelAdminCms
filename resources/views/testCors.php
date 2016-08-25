<html>
<head>
    <title>11111</title>
</head>
<body>
<button id="get22222">Click</button>

<script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.0.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#get22222").click(function () {
        $.ajax({
            url: 'http://laravel.admin.lomocoin.com/newsBoard?token=57b436b451ce4c0adf679704&skip=0&limit=1',
//            url: 'http://127.0.0.1:1025/newsBoard',
            type: 'get',
            success: function (data) {
                alert(data);
            },
            error:function()
            {
                alert("error");
            }
        })
    })
</script>
</body>
</html>