self.addEventListener('message', function(e) {
  var files = e.data;
  
   $a="Ass"
   reader = new FileReader();
    reader.onload = function(e) {
        var contents = e.target.result;
        // console.log(contents.split("\n"),[1]);
               $a = contents.split("\n"),[1];
               postMessage($a);
        };
  reader.readAsText(files);
  postMessage($a);
}, false);