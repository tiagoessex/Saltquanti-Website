
jQuery.fn.extend({
    printElem: function() {
        var cloned = this.clone();
        var printSection = $('#printSection');
        if (printSection.length == 0) {
            printSection = $('<div id="printSection"></div>')
            $('body').append(printSection);
        }
        printSection.append(cloned);
        var toggleBody = $('body *:visible');
        toggleBody.hide();
        $('#printSection, #printSection *').show();
        window.print();
        printSection.remove();
        toggleBody.show();
    }
});

function printDiv(div) {
    $(div).printElem();
};



// count the number of fields in a object
function count(obj) {

    if (obj.__count__ !== undefined) { // Old FF
        return obj.__count__;
    }

    if (Object.keys) { // ES5 
        return Object.keys(obj).length;
    }

    // Everything else:

    var c = 0, p;
    for (p in obj) {
        if (obj.hasOwnProperty(p)) {
            c += 1;
        }
    }

    return c;

}



// EXPORT TO CSV
/*
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv;charset=utf-8,%EF%BB%BF"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

*/
/*
function exportTableToCSV(filename, id) {
    var csv = [];
    var rows = document.querySelectorAll(id + " tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText);
        }
        
        csv.push(row.join(","));        

        //console.log(row);
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
*/
/*
function exportTableToCSV2(filename, header, data) {
    var csv = [];
    //var rows = document.querySelectorAll(id + " tr");
    console.log("data > " + data);
    console.log("header > " + header);
   
   var csv = [header];


    var index = 0;
    var value = '';
    for (var i = 0; i < (content.length / columns.length); i++) {
        var line=[];
        for (var j = 0; j < columns.length; j++) {
            value = content[index];
            if (value == null || value == 'null' || value == "NULL") value = '';
            else if (value == '0000-00-00') value = '';
            line.push(value);
            index += 1;
        }
        csv.push(line);
        line = [];              
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
*/