﻿<script type="text/javascript">
	 $("#demo-dom").wijgrid();

            // array
            $("#demo-array").wijgrid({
                data: [
                ["ANATR", "Ana Trujillo Emparedados y helados", "Ana Trujillo"],
                ["ANTON", "Antonio Moreno Taqueria", "Antonio Moreno"],
                ["AROUT", "Around the Horn", "Thomas Hardy"],
                ["BERGS", "Berglunds snabbkop", "Christina Berglund"]
              ],
                columns: [
                 { headerText: "ID" }, { headerText: "Company" }, { headerText: "Name" }
              ]
            });
			
			
			 $("#demo-remote").wijgrid({
                data: new wijdatasource({
                    proxy: new wijhttpproxy({
                        url: "http://ws.geonames.org/searchJSON",
                        dataType: "jsonp",
                        data: {
                            featureClass: "P",
                            style: "full",
                            maxRows: 5,
                            name_startsWith: "ab"
                        },
                        key: "geonames"
                    }),
                    reader: new wijarrayreader([
                     { name: "label", mapping: function (item) { return item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName } },
                     { name: "name", mapping: "name" },
                     { name: "countryCode", mapping: "countryCode" },
                     { name: "continentCode", mapping: "continentCode" }
                  ])
                })
            });
</script>
<div class="container">
        <div class="header">
            <h2>
                Datasources</h2>
        </div>
        <div class="main demo">
            <!-- Begin demo markup -->
            <p>DOM table:</p>
            <table id="demo-dom">
               <thead>
                  <tr>
                     <th>ID</th><th>Company</th><th>Name</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>ANATR</td><td>Ana Trujillo Emparedados y helados</td><td>Ana Trujillo</td>
                  </tr>
                  <tr>
                     <td>ANTON</td><td>Antonio Moreno Taqueria</td><td>Antonio Moreno</td>
                  </tr>
                  <tr>
                     <td>AROUT</td><td>Around the Horn</td><td>Thomas Hardy</td>
                  </tr>
                  <tr>
                     <td>BERGS</td><td>Berglunds snabbkop</td><td>Christina Berglund</td>
                  </tr>
               </tbody>
            </table>

            <p>Array:</p>
            <table id="demo-array">
            </table>

            <p>Hash:</p>
            <table id="demo-hash">
            </table>

            <p>Remote:</p>
            <table id="demo-remote">
            </table>
            <!-- End demo markup -->
            <div class="demo-options">
                <!-- Begin options markup -->
                <!-- End options markup -->
            </div>
            <div class="footer demo-description">
                <p>
                    This sample shows how to load data into the grid using various methods such as array, hash and remote.
                </p>
            </div>
        </div>
    </div>