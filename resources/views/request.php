<html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<h1>http request</h1>
</body>
</html>

<script>
    function getRequest() {
        $.ajax({
            type:"GET",
            url:"/get-demo?id=1&name=2",
            dataType:"json",
            success:function(data){

            },
            error:function(jqXHR){
                // alert("发生错误："+ jqXHR.status);
            }
        });
    }
    getRequest();
</script>