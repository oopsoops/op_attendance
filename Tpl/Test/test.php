remoteAjax
<script>

$.ajax({
    type : "get",
    url : "http://192.168.1.104:8080/LibMgr/remoteAjax",
    dataType : "jsonp",
    jsonp: "jsoncallback",//服务端用于接收callback调用的function名的参数
    success : function(json){
        alert(json);
        alert(json.total);
    },
    error:function(){
        alert('fail');
    }
});

</script>