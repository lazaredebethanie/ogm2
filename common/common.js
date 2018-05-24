function ajaxSelect(urlCalled) {
          var result;
          $.ajax
          ({
          url: urlCalled,
          async: false,
          method:"GET",
          dataType: "json"
          })
          .done(function(data2) {
              //alert("DONE call "+urlCalled);
              console.log("call ajaxSelect : success for "+urlCalled);
              result=data2;
          })
          .fail(function(){
              alert("FAIL call "+urlCalled);
              result="";
          }); 
          return result;
      }; // end of function ajaxSelect