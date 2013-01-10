<script>
$(function(){
	 $("#combobox").wijcombobox({
               data: [
                       {
                           label: 'c++',
                           value: 'c++'
                       },
                       {
                           label: 'java',
                           value: 'java'
                       },
                       {
                           label: 'php',
                           value: 'php'
                       },
                       {
                           label: 'coldfusion',
                           value: 'coldfusion'
                       }
                   ]
           });
});

</script>
<div class="popup" style="width:200px;height:200px">content goes here</div>

<input id="combobox" /> 