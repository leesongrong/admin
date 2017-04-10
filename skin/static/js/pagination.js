 function getPagination(num,pageList,currentPage){
    var page = Math.ceil(num/pageList);
    var data = "<li><a href='?page=1'>首页</a><li>";
    if(currentPage > 1){
        data += "<li class='previous-off'><a >«上一页</a></li>";
    }
    
    for(var i = 1;i<=page;i++){
        if(currentPage == i){
            data += "<li class='p-active'>"+i+"</li>";
        }else{
            data += "<li><a href='?page="+i+"'>"+i+"</a></li>";
        }
    }
    
    data += "<li class='next'><a href='?page=2'>下一页 »</a></li>";
    data += "<li><a href='?page=7'>尾页</a><li>";
    data += "<li style='clear:both;'></li>";
    $("#pagination-flickr").html(data);
  }