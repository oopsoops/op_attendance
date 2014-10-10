//初始化日历
function initClndr(id,date) {
    //获取dom
    var dom = $("#"+id+" #clndr");
    //清空table
    dom.empty();
    //获取年月
    var year = date.getFullYear();
    var month = date.getMonth();
    //console.log("initClndr:"+month);
    //var month = $("#worktimelist_month").val() - 1;
    //表头
    dom.append("<tr><th colspan=\"7\" id=\"win_month\">"+(month+1)+"月</th></tr>");
    dom.append("<tr><th>日</th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th></tr>");
    //获取本月1号
    var first = new Date(year,month,1);
    var ht = "";
    for(i=1;i<=6;i++) {
        ht = "<tr>";
            var j = 0;
            week = first.getDay();
            //如果星期数相等则写入
            while(week!=j) {
                ht += "<td>";
                ht += "-";
                j++;
                ht += "</td>";
            }
            while(j<=6) {
                if(first.getMonth()!=month) {
                    //如果超过本月
                    ht += "<td>";
                    ht += "-";
                } else {
                    //如果属于本月
                    ht += "<td id=\"day_"+first.getDate()+"\">";
                    ht += first.getDate();
                }
                ht += "</td>";
                j++;
                first.setTime(first.getTime() + 60*60*1000*24);
            }
        ht += "</tr>";
        dom.append(ht);
    }

}
//获取日历信息
function fetchClndr(id,date,data) {
    //获取当月天数
    var year = date.getFullYear();
    //当前月
    var month = date.getMonth();
    //var month = $("#worktimelist_month").val() - 1;
    //获取本月月底
    var date2 = new Date(year,month+1,0);
    var days = date2.getDate();

    //生成数组
    var arr = new Array();
    //清空数组
    for(i=1;i<=days;i++) {
        //$("#"+id+" #day_"+i).html(i);
        arr[i] = 0;
    }

    //显示月份
    $("#"+id+" #clndr #win_month").text((month+1)+"月");
    //遍历排班列表
    for(k = 0; k < data.rows.length; k++) {
        start = timeparser(data.rows[k].workdate1);
        end = timeparser(data.rows[k].workdate2);
        if(date.getFullYear()==start.getFullYear() && month==start.getMonth()) {
            for(i = start.getDate(); i <= end.getDate(); i++) {
                //$("#"+id+" #day_"+i).html("<span style=\"color:blue;font-weight:bold;\">"+i+"</span>");
                arr[i] += 1;
            }
        }
    }
    
    //显示
    var isError = false;
    for(i=1;i<=days;i++) {
        if(arr[i]==0) {
            $("#"+id+" #clndr #day_"+i).html(i);
        } else if(arr[i]==1) {
            //有一次排班
            $("#"+id+" #clndr #day_"+i).html("<span style=\"color:blue;font-weight:bold;\">"+i+"</span>");
        } else {
            //重复排班
            isError = true;
            $("#"+id+" #clndr #day_"+i).html("<span style=\"color:red;font-weight:bold;\">"+i+"</span>");
        }
    }
    //如果有重复则提示
    if(isError) {
        $.messager.alert('提示','当月有重复排班的情况！');
        $("#"+id).window('open');
    }
}





