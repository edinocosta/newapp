
self.addEventListener('message', function(e) {
   var files = e.data;
   var a="";
   
   reader = new FileReader();
    reader.onload = function(file) {
    	 return function (e) { // return handler function for 'onload' event
    	    var a="";
        	var contents = e.target.result;
            var allData = contents.split("\n");
            var mData={};
            mData.allData=allData;
            var dados = allData[3].split(",");
            var dados2 = allData[allData.length-2].split(",")
            mData.dataRange=dados[0]+" "+dados[1]+ "-"+dados2[0]+" "+dados2[1];
            mData.timeIni=dados[1];
            mData.dataIni = dados[0];
            mData.consumo=parseInt(dados[63])-parseInt(dados2[63]);
            self.postMessage(mData);
        
         }

     }(files);
    reader.readAsText(files);
   //self.postMessage(a);

}, false); 


