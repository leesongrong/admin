function initData(listdata){
   
    var con = "";
    for(var i = 0;i < listdata.length;i++){
      con += "<tr><td>"+listdata[i]['name']+"</td><td>"+listdata[i]['city']+"</td><td>"+listdata[i]['youbian']+"</td><td>查看</td></tr>";

    }
    $("#table_con").html(con);
  }