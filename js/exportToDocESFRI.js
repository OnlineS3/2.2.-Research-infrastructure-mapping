$(document).ready(function() {
    $('#export-doc-esfri').click(function() {
      var selectedDomain = [];
      $('#domainBox :selected').each(function(i, selected) {
          selectedDomain[i] = $(selected).val();
      });
      var selectedEsfriType = [];
      $('#esfriTypeBox :selected').each(function(i, selected) {
          selectedEsfriType[i] = $(selected).val();
      });
      var selectedCoordcountry = [];
      $('#countryBox :selected').each(function(i, selected) {
          selectedCoordcountry[i] = $(selected).val();
      });
      var selectedType = [];
      $('#typeBox :selected').each(function(i, selected) {
          selectedType[i] = $(selected).val();
      });

        $.ajax({
            type: "POST",
            url: "/app_2_2/php/esfriFilterSubmit.php",
            data: {'selectedDomain':JSON.stringify(selectedDomain),'selectedEsfri_type':JSON.stringify(selectedEsfriType), 'selectedType':JSON.stringify(selectedType),'selectedCoordinating_country':JSON.stringify(selectedCoordcountry)},
            cache: false,
            success: function (result) {
                    var selectBox = document.getElementById("domainBox");
                    var selectedDomain = selectBox.options[selectBox.selectedIndex].text;
                    var esfriTypeBox = document.getElementById("esfriTypeBox");
                    var selectedEsfriType = esfriTypeBox.options[esfriTypeBox.selectedIndex].text;
                    var countryBox = document.getElementById("countryBox");
                    var selectedCoordcountry = countryBox.options[countryBox.selectedIndex].text;
                    var typeBox = document.getElementById("typeBox");
                    var selectedType = typeBox.options[typeBox.selectedIndex].text;
                    var js_var =  JSON.parse(result);
                    var iterationCounter = 1;
                    var addToDoc = [];
                    for (var i = 0; i < js_var.length; i++) {
                      var total = JSON.stringify(js_var[i]);
                      total = JSON.parse(total);
                      var name = total[2]; //
                      var url = total[3];//
                      var coord = total[4];//
                      var hq = total[5];//
                      var domain = total[6];//
                      var partners = total[8];//
                      var location = total[7];//
                      var members = total[9];//
                      var start = total[11];//
                      var prepcost = total[12];//
                      var constcost = total[13];//
                      var opercost = total[14];//
                      var description = total[15];//

                      var tmpRI = {
                                "number": iterationCounter,
                                "title": name,
                                "domain": domain,
                                "location": location,
                                "hq": hq,
                                "url": url,
                                "partners": partners,
                                "coord": coord,
                                "members": members,
                                "start": start,
                                "prepcost": prepcost,
                                "constcost": constcost,
                                "opercost": opercost,
                                "desc": description
                            };
                      addToDoc.push(tmpRI);
                      iterationCounter++;
                    }
                      function loadFile(url, callback) {
                          JSZipUtils.getBinaryContent(url, callback);
                      }
                      loadFile("/app_2_2/js/templates/esfri-report-template.docx", function(err, content) {
                          var zip = new JSZip(content);
                          var doc = new Docxtemplater().loadZip(zip);



                          var tmp = {"ris": addToDoc,
                                     "selectedDomain": selectedDomain,
                                     "selectedEsfriType": selectedEsfriType,
                                     "selectedCoordcountry": selectedCoordcountry,
                                     "type" : selectedType
                                     };
                          doc.setData(tmp);
                          doc.render();
                          var output = doc.getZip().generate({
                              type: "blob"
                          });
                          saveAs(output, "ESFRI RI report.docx");
                      });
                    }
                });
        return false;
        });

        // Returns successful data submission message when the entered information is stored in database.
        // AJAX Code To Submit Form.


});
