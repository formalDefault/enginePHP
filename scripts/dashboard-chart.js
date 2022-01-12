var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Action to be performed when the document is read;
       var json = JSON.parse(this.responseText);
       //console.log(json);
       var label = [];
       var data = [];
       var color = [	 
        "#9966CC"	 
        ,"#8A2BE2"	 
        ,"#9400D3"	 
        ,"#9932CC"	 
        ,"#8B008B"	 
        ,"#800080"	 
        ,"#FFC0CB"
        ,"#4B0082"	 
        ,"#6A5ACD"	 
        ,"#483D8B"	 
        ,"#7B68EE"
        ,"#98FB98"
        ,"#00FFFF"	 
        ,"#E0FFFF"	 
        ,"#AFEEEE"	 
        ,"#7FFFD4"	 
        ,"#40E0D0"	 
        ,"#48D1CC"	 
        ,"#00CED1"	 
        ,"#5F9EA0"	 
        ,"#4682B4"	 
        ,"#B0C4DE"	 
        ,"#B0E0E6"	 
        ,"#ADD8E6"	 
        ,"#87CEEB"	 
        ,"#87CEFA"	 
        ,"#00BFFF"
        ,"#1E90FF"	 
        ,"#6495ED" 
        ,"#7B68EE"
        ,"#4169E1"
        ,"#FFB6C1"
        ,"#FF69B4"
        ,"#FF1493"
        ,"#C71585"
        ,"#DB7093"
        ,"#FFA07A"	 
        ,"#FF7F50"	 
        ,"#FF6347"	 
        ,"#FF4500"	 
        ,"#FF8C00"	 
        ,"#FFA500"
        ,"#BA55D3"	 
        ,"#9370DB"
        ,"#90EE90"	 
        ,"#00FA9A"	 
        ,"#00FF7F"	 
        ,"#3CB371"	 
        ,"#2E8B57"	 
        ,"#228B22"	 
        ,"#008000"	 
        ,"#006400"	 
        ,"#9ACD32"	 
        ,"#6B8E23"	 
        ,"#808000"	 
        ,"#556B2F"	 
        ,"#66CDAA"	 
        ,"#8FBC8F"	 
        ,"#20B2AA"	 
        ,"#008B8B"	 
        ,"#008080"
        ,"#00FFFF"
      ];
       for(let val of json){
         if(label.find(item => item == val.coordinacion)){
          data.find(item => item.coordinacion == val.coordinacion).cant += 1;
         }else{
          label.push(val.coordinacion);
          data.push({
            coordinacion: val.coordinacion,
            cant: 1
          });
         }
       }
       var datachart = [];
       for(let i of data){
        datachart.push(i.cant);
       }
       var ctx = document.getElementById("myChart").getContext('2d');
       var myChartt = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: label,
          datasets: [{
            backgroundColor: color,
            data: datachart
          }]
        },
        options: {
          title: {
            display: false,
            text: 'Bienes dentro de la institución'
          }
        }
      });
    }
};
xhttp.open("GET", "http://difgdl.gob.mx/patrimonio/webservices/view-inventarios-home.php", true);
xhttp.send();
