<?php include('../header.php'); ?>
<?php include('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>

<link rel="stylesheet" href="css/graphs.css" type="text/css" />

<?php
  $link = db_start();
?>


<div class="container-fluid below-nav">  

<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked well text-center">
      <h2>Gráficos</h2>
      <li class="active"><a href="#tab_percentage" data-toggle="tab">Distribuição de produtos por categoria</a></li>
      <li><a href="#tab_interval" data-toggle="tab">Intervalos dos teores de sal por categoria</a></li>
    </ul>




  <!--  <div class="col-md-2 text-left">-->
    <h4>Selecione a categoria:</h4>
    <div id="categoriestree" class="hidden text-left well categories-tree">
            <ul id='tree1'>
                <?php                    
                    $sql = 'SELECT DISTINCT category from  ' . DB_TABLE_FOOD . ' where validationdate is not NULL order by category';
                    $query = mysqli_query($link, $sql);
                    if (!$query) {
                        Error("Problemas com a base de dados. " . mysqli_error($link));
                        die();
                    }
                    echo '<li id="first_node" data-path="root">Produtos';
                    echo '<ul>';
                    $first = true;
                    while ($row1 = mysqli_fetch_array($query))
                    {
                      if ($row1['category'] == '') continue;
                        if ($first) {
                           echo '<li data-path="' . $row1['category'] .'">'.$row1['category'];
                           $first = false;
                        } else {
                          echo '<li data-path="' . $row1['category'] .'">'.$row1['category'];
                        }
                    
                        $sql = 'SELECT DISTINCT subcategory1 from  ' . DB_TABLE_FOOD . ' where category = "'. $row1['category'] . '" order by subcategory1';
                        $query2 = mysqli_query($link, $sql);
                        if (!$query2) {
                          Error("Problemas com a base de dados. " . mysqli_error($link));
                          die();
                        }
                    
                        if ($query2->num_rows > 0) echo '<ul>';
                        while ($row2 = mysqli_fetch_array($query2)) 
                        {
                          if ($row2['subcategory1'] == '') continue;
                              echo '<li data-path="' . $row2['subcategory1'] .'">'.$row2['subcategory1'];
                        
                              $sql = 'SELECT DISTINCT subcategory2 from  ' . DB_TABLE_FOOD . ' where category = "'. $row1['category'] . '" and subcategory1 = "'. $row2['subcategory1'] . '" order by subcategory2';
                              $query3 = mysqli_query($link, $sql);
                              if (!$query3) {
                                  Error("Problemas com a base de dados. " . mysqli_error($link));
                                  die();
                              }
                    
                    
                              if ($query3->num_rows > 0) echo '<ul>';
                              while ($row3 = mysqli_fetch_array($query3)) 
                              {
                                if ($row3['subcategory2'] == '') continue;
                                  echo '<li data-path="' . $row3['subcategory2'] .'">'.$row3['subcategory2'];
                    
                                  $sql = 'SELECT DISTINCT subcategory3 from  ' . DB_TABLE_FOOD . ' where category = "'. $row1['category'] . '" and subcategory1 = "'. $row2['subcategory1'] . '" and subcategory2 = "'. $row3['subcategory2'] . '" order by subcategory3';
                                    $query4 = mysqli_query($link, $sql);
                                    if (!$query4) {
                                        Error("Problemas com a base de dados. " . mysqli_error($link));
                                        die();
                                    }
                                    if ($query4->num_rows > 0) echo '<ul>';
                                    while ($row4 = mysqli_fetch_array($query4)) {
                                      if ($row4['subcategory3'] == '') continue;
                                        echo '<li data-path="' . $row4['subcategory3'] .'">'.$row4['subcategory3'].'</li>';
                                    }
                                    if ($query4->num_rows > 0) echo '</ul>';    
                    
                                    echo '</li>';
                              }           
                              if ($query3->num_rows > 0) echo '</ul>';
                    
                          echo '</li>';
                    
                        }
                        if ($query2->num_rows > 0) echo '</ul>';
                    
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                ?>
            </ul>
          </div>
  </div> 





  <div class="tab-content col-md-9 text-center">       
      <div id="loader" style=" margin: -75px 0 0 -60px;"></div> 
      <div class="tab-pane active" id="tab_percentage">
            <h3>Distribuição de produtos por categoria</h3>
            <h4 class="category_path"><h4>
            <div id="productspercentage" style=" height: 60vh; max-width: 60vw;/*display: inline-block;*/ margin: 0 auto;"></div>
      </div>
      <div class="tab-pane" id="tab_interval">
            <h3>Intervalos [média, máx, min] dos teores de sal por categoria</h3>
            <h4 class="category_path"><h4>
            <div id="intervalsaltcategories" style="height: 60vh; max-width: 60vw; margin: 0 auto;"></div>
      </div>
  </div>


</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


<script>
    // charts
    var chart_salt_interval = null;
    var chart_products_numbers = null;

    // category tree path
    var path = null;

    // categories
    var cat = undefined;
    var sc1 = undefined;
    var sc2 = undefined;
    var sc3 = undefined;

    // to avoid double fetch caused by the double click
    var ready = true;

    $(document).ready(function() {
        $('#categoriestree').jstree();
        $('#categoriestree').removeClass("hidden");
        // once page and table loaded => select first node of tree
        $('#categoriestree').jstree(true).select_node("first_node");
    });

    // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(salt_interval);
      google.charts.setOnLoadCallback(percentage_numbers);



    // if any leaf of the categories tree is selected => expand/contract the leaf
    $('#categoriestree').on('select_node.jstree', function (e, data)
    {
        data.instance.toggle_node(data.node);
    });    

    // tree changed (clicked) => get path to selected leaf
    $('#categoriestree').on("changed.jstree", function (e, data) {
       setTimeout(function(){ ready = true; }, 500);
       if (!ready) return;
       ready = false;

       var new_path = data.instance.get_path(data.selected[0]);
        for (var i = 0; i < new_path.length; i++) {
          new_path[i] = new_path[i].trim();
          new_path[i] = $.trim( new_path[i].replace(/[\t\n]+/g,' '));
          
        }
        cat = (new_path[1] == undefined)? '' : new_path[1];
        sc1 = (new_path[2] == undefined)? '' : new_path[2];
        sc2 = (new_path[3] == undefined)? '' : new_path[3];
        sc3 = (new_path[4] == undefined)? '' : new_path[4];
    
        // if same categories prevent fetch and draw
        // stiches and patches!!!!
        if (path && path[1] == new_path[1] && path[2] == new_path[2] && path[3] == new_path[3] && path[4] == new_path[4]) return;

        path = new_path;
        $('.category_path').html(path.join('\\'));
      
        // update graphs
        if (chart_salt_interval) salt_interval();
        if (chart_products_numbers) percentage_numbers();

    });
/*
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href") // activated tab
      //alert(target);
      if (target == "#tab_interval") {
          salt_interval();
      } else if (target == "#tab_percentage") {
        percentage_numbers();
      }
    });
*/


    function percentage_numbers() {
        document.getElementById("loader").style.display = "block";
        $.ajax({  
                  url:"graphs/productnumbers.php",  
                  method:"POST",
                  data:{path:path},
                  dataType:"json",
                  success:function(response) {
                    DrawProductsNumbers(response);
                  },
                  error: function( jqXHR, status ) {
                    /*
                        var msg = '';
                        if (jqXHR.status === 0) {
                             msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                             msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        window.location.href="/error.php?error=" + msg; */
                    }
        });
	};

	function salt_interval() {
        document.getElementById("loader").style.display = "block";
        $.ajax({  
                  url:"graphs/saltinterval.php",  
                  method:"POST",
                  data:{path:path},
                  dataType:"json",
                  success:function(response) {
                    DrawSaltInterval(response);
                  },
                  error: function( jqXHR, status ) {
                     /*   var msg = '';
                        if (jqXHR.status === 0) {
                             msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                             msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        window.location.href="/error.php?error=" + msg; */
                    }
        });
	};


    function DrawSaltInterval(values) {

      if (chart_salt_interval != null)
        chart_salt_interval.clearChart();

      // table loaded and ready => hide spinner
      document.getElementById("loader").style.display = "none";

		  var dp = [];
	  	for (var i= 0; i < values.length; i+=4) {
		    dp.push([values[i], Number(values[i+3]), Number(values[i+2]), Number(values[i+1]) ]);
	  	}

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'x');
      data.addColumn('number', 'values');

      data.addColumn({id:'i0', type:'number', role:'interval'});
      data.addColumn({id:'i1', type:'number', role:'interval'});

      data.addRows(dp);
  
      // The intervals data as narrow lines (useful for showing raw source data)
      var options_bars = {
          title: 'Intervalos (máx, min e média) dos teores de sal por categoria',
          curveType: 'function',
          series: [{'color': '#D9544C'}],
          intervals: { style: 'bars' },
          legend: 'none',
          titlePosition: 'none',  // don't show title
          hAxis: {
            title: 'Categorias'
          },
          vAxis: {
            title: 'Teor [g/100g]'
        }
      };
  
      chart_salt_interval = new google.visualization.LineChart(document.getElementById('intervalsaltcategories'));

      chart_salt_interval.draw(data, options_bars);
    }


  	function DrawProductsNumbers(values) {

      // table loaded and ready => hide spinner
      document.getElementById("loader").style.display = "none";

      if (chart_products_numbers != null) {
        chart_products_numbers.clearChart();
      }


	  	var dp = [];
	  	for (var i= 0; i < values.length; i+=2) {
			   dp.push([values[i], Number(values[i+1])]);
	     } 


      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Categoria');
      data.addColumn('number', 'Numero de produtos');
      data.addRows(dp);

      // Set chart options
      var options = {
        'title':'Distribuição de produtos por categoria', 
        is3D: true,
        titlePosition: 'none' // don't show title
      };

      // Instantiate and draw our chart, passing in some options.
      chart_products_numbers = new google.visualization.PieChart(document.getElementById('productspercentage'));

      chart_products_numbers.draw(data, options);
    }




</script>



<?php include('../footer.php'); ?>