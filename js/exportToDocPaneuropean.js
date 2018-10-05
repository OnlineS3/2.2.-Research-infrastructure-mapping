$(document).ready(function() {
    $('#export-doc-paneuropean').click(function() {
        var selectedDomain = [];
        $('#domainBox :selected').each(function(i, selected) {
            selectedDomain[i] = $(selected).val();
        });
        var selectedType = [];
        $('#typeBox :selected').each(function(i, selected) {
            selectedType[i] = $(selected).val();
        });
        var selectedCoordcountry = [];
        $('#countryBox :selected').each(function(i, selected) {
            selectedCoordcountry[i] = $(selected).val();
        });

        // Returns successful data submission message when the entered information is stored in database.
        // AJAX Code To Submit Form.
        $.ajax({
            type: "POST",
            url: "/app_2_2/php/filterSubmit.php",
            data: {
                'selectedDomain': JSON.stringify(selectedDomain),
                'selectedType': JSON.stringify(selectedType),
                'selectedCoordcountry': JSON.stringify(selectedCoordcountry)
            },
            cache: false,
            success: function(result) {
              var selectBox = document.getElementById("domainBox");
      				var selectedDomain = selectBox.options[selectBox.selectedIndex].text;
              var typeBox = document.getElementById("typeBox");
      				var selectedType = typeBox.options[typeBox.selectedIndex].text;
      				var countryBox = document.getElementById("countryBox");
      				var selectedCountry = countryBox.options[countryBox.selectedIndex].text;
							var js_var =  JSON.parse(result);
							var iterationCounter = 1;
							var addToDoc = [];
							for (var i = 0; i < js_var.length; i++) {
								var total = JSON.stringify(js_var[i]);
								total = JSON.parse(total);
								var name = total[2];
								var domain = total[8];
								var location = total[6];
								var host = total[5];
								var url = total[3];
								var type = total[12];
								var coord = total[11];
								var ric = total[10];
								var status = total[4];
								var description = total[7];

								var tmpRI = {
													"number": iterationCounter,
													"title": name,
													"domain": domain,
													"location": location,
													"host": host,
													"url": url,
													"category": type,
													"coord": coord,
													"ric": ric,
													"status": status,
													"desc": description
											};
								addToDoc.push(tmpRI);
								iterationCounter++;
							}
                function loadFile(url, callback) {
                    JSZipUtils.getBinaryContent(url, callback);
                }
                loadFile("/app_2_2/js/templates/paneuropean-report-template.docx", function(err, content) {
                    var zip = new JSZip(content);
                    var doc = new Docxtemplater().loadZip(zip);



										var tmp = {"ris": addToDoc,
                               "selectedDomain": selectedDomain,
                               "type" : selectedType,
                               "selectedCountry": selectedCountry};
                    doc.setData(tmp);
                    doc.render();
                    var output = doc.getZip().generate({
                        type: "blob"
                    });
                    saveAs(output, "PanEuropean RI report.docx");
                });
            }
        });
        return false;
    });

});
