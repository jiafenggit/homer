<?php 
/*
 * HOMER Web Interface
 * Homer's admin.html.php
 *
 * Copyright (C) 2011-2012 Alexandr Dubovikov <alexandr.dubovikov@gmail.com>
 * Copyright (C) 2011-2012 Lorenzo Mangani <lorenzo.mangani@gmail.com>
 *
 * The Initial Developers of the Original Code are
 *
 * Alexandr Dubovikov <alexandr.dubovikov@gmail.com>
 * Lorenzo Mangani <lorenzo.mangani@gmail.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
*/
?>

<?php

defined( '_HOMEREXEC' ) or die( 'Restricted access' );

class HTML_Admin {

	function displayNewAdminOverView($type, $allrows, $allnames, $task, $alldval) {

			global $mynodeshost, $task;
			        	
		
?>
	<script type="text/javascript" src="js/cookie.jquery.js"></script>
	<script type="text/javascript" src="js/inettuts3.js"></script> 
        <script type="text/javascript" src="js/jquery.Dialog.js"></script>
        <script type="text/javascript" src="js/jquery.inlineEdit.js"></script>
        <script type="text/javascript">
            $(function(){

		$('#date').datepicker({ dateFormat: 'dd-mm-yy' });
	
		 iNettuts.init();

                $.inlineEdit({
			categoryhost: 'adminajax.php?type=host&categoryId=',			
			categoryname: 'adminajax.php?type=name&categoryId=',
			categorystatus: 'adminajax.php?type=status&categoryId=',
			categorypassword: 'adminajax.php?type=password&categoryId=',			
			categoryuseremail: 'adminajax.php?type=useremail&categoryId=',
			categoryuserlevel: 'adminajax.php?type=userlevel&categoryId=',			
			remove: 'adminajax.php?type=remove&categoryId='
		}, {
	
			animate: false,
	
			filterElementValue: function($o){
                                return $o.html();
			},
	
			afterSave: function(o){
        if(o.type == 'categorypassword') {
               $('.categorypassword.id' + o.id).html('xxx');
        }
				if (o.type == 'category2name') {
					$('.category2name.id' + o.id).prepend('$');
			}
		}	            
                });
                                                    
            });
        
        </script>
        <style type="text/css"> 
		#data td {
			width: 1px;
			vertical-align: top;
			cursor: pointer;
		}
		.editFieldSaveControllers {
			width: 150px;
			font-size: 80%;
		}
		.editableSingle button, .editableSingle input {
			padding: 1px;
		}

		.editableDropDown button, .editableDropDown input {
			padding: 1px;
		}		
		a.editFieldRemove {
			color: red;
		}
		a.editFieldCancel {
			color: orange;
		}
	</style> 
        
<!-- admin mod start -->
  <div id="columns"  style="margin: 1px 1px 0 1px;">
	<center>

        <ul id="column1" class="column" style="width: 9%;">
		<br>


<!-- start db tools -->
<?php

	}
	
	function displayAdminUsers($datas,$names,$types) {
	
	/* USERS/HOSTS/NODES  FORM */
        $headers  = array("USERS","ALIASES","NODES"); 
        $adminGroup = array("Admin","Manager","User","Guest");
                
        foreach($datas as $index=>$rows) {

		$name=$names[$index];
		$type = $types[$index];
		/* HEADER */
		$header = $headers[$index];
		$columns = $rows[0];		
    	    	    
?>	
      	    <li class="widget color-orange" id="widget-admin<?php echo $type;?>">
        	    <div class="widget-head">
	                    <h3><?php echo $header; ?></h3>
        	        </div>
	                <div class="widget-content">
			<br>
            <table border="1" id="data" cellspacing="0" width="95%" style="background: #f9f9f9;">            	
		<tr>
<?php
	     
        	   foreach ($columns as $key=>$value) {
          	    if($key == "id" || $key == "userid") continue;
			$ktitle = strtoupper($key);
                    echo "<th>$ktitle</th>";                
                }        
		echo "</tr>";

                foreach($rows as $row) {      
                    
                    echo "<tr align='center'>\n";

                    foreach($row as $key=>$value) {
                        if($key == "id" || $key == "userid") continue;          
                        $id = !isset($row->userid) ? $row->id : $row->userid;
                        
                        if($key == "password") $value = "xxx";
                        
                        if($key == "userlevel") 
                        	echo "<td class=\"editableDropDown category{$key} removable id{$type}{$id}\">".$adminGroup[$value-1]."</td>\n";                  
                        else echo "<td class=\"editableSingle category{$key} removable id{$type}{$id}\">$value</td>\n";                    
                    }
                    echo "</tr>\n";
}
?>			    
	            </table>               
			<br><div id="bar_<? echo $name ?>" align="right"><button id="create-<?php echo $type?>">Create New</button></div><br>
		</div>
		</li>
<?php 
	}
?>	
<!-- end db tools -->


	</ul>

<?php
	}
	
	function displayAdminInfo() {
	
?>	


<!-- column2 start -->

        <ul id="column2" class="column" style="margin: 0 0 0 0; min-height: 0px; height: 0px;" >
       

	<!-- about widget -->

	<li class="widget color-blue" id="widget-about">
                <div class="widget-head"><h3>About</h3></div>
                <div class="widget-content">

		<br><h1><font size=+2>webHomer</font> <?php echo WEBHOMER_VERSION;?> </h1>
		<br>
		Please use latest <a href="http://homer.googlecode.com" target="_blank">GIT Code</a> or visit <a href="http://sipcapture.org" target="_blank">http://sipcapture.org</a>
		<br><br><hr><br>
<!--
 		</div>
	</li>


	<li  class="widget color-blue" id="widget-prefs">
		<div class="widget-head"><h3>Preferences</h3></div>
                <div class="widget-content">
-->
	<table border="0" id="prefs" cellspacing="0" width="95%" style="background: transparent;">
   


<?php

// Check for new definitions in configuration_example
if (NOCHECK != 1) {

	if (!is_writable(PCAPDIR)) {
                echo "<b>WARNING: ".PCAPDIR." MUST be writable!</b><br>";
                echo "<br><hr><br>";
        }

 }
// Print subset
$userdef = get_defined_constants(true);
        foreach($userdef['user'] as $key => $value){
	if(!preg_match("/HOMER_|__|_HOMER|RADIUS_|DB|USER|IERROR|PW|GEOIP_URL/", "$key")){
        echo '<tr><td width="150">'.$key.'</td><td>';
	echo '<button class="ui-state-default ui-button ui-widget ui-corner-all" style="width:200px;" disabled>';
	if ($value != '0') {echo $value;} else {echo "<i>default</i>";}
	echo "</button>";
	echo '</td></tr>';
	}
        }
?>



	</table><br>
	</div>
	</li>

	</ul>
		
<?php
	}
	
	function displayAdminHealth($report) {
?>	
	
	<ul id="column3" class="column">


		 <li class="widget color-green" id="widget-alarms">
                <div class="widget-head">
                    <h3>Server Health</h3>
                </div>
                <div class="widget-content">
		<br><h1>Homer Core</h1><br><br>

		<table  class="bodystyle" cellspacing="0" width="95%" height="132">

<?php
	 foreach ($report as $key=>$value) {

?>
		  <tr>
			 <td><?php echo $key ?></td>
		    <td>
<!--			<input type="button" value="<?php echo $value ? "SERVICE OK" : "SERVICE KO"; ?>"  style="background: transparent;" role="button"  role="button"  class="<?php echo $value ? " ui-state-default" : " ui-state-error"; ?> ui-button ui-widget ui-corner-all" disabled> --> 
		<button id='sw_autocomplete' style='width:150;' class=' class="<?php echo $value ? " ui-state-default" : " ui-state-error" ?> ui-button ui-widget ui-corner-all'><?php echo $value ? "SERVICE OK" : "SERVICE KO"; ?></button>
		    </td>
		  </tr>

<?php
	}
?>
		
		</table><br>
		</div>
		</li>

<?php 
		foreach($report as $key=>$value) {
			if ($value != 1) $alarm=1; 
		}
		if ($alarm) { 
?>
		<script type="text/javascript">
                        jQuery('#widget-alarms').removeClass("color-green").addClass("color-red");
                </script>
<?php 
		} 
?>


</ul><br>
<?php

	}

	function displayAdminForms() {
	
?>	
		

<!-- HORIZONTAL CONTAINER - NOT IN USE
<ul id="column04" class="column"  style="width: 81%; height: 10; margin: 0 0 0 90px ;">
</ul>
-->


<!-- </div> -->

<div id="createuser-form" title="Create new user"> 
	<p class="validateTips">All form fields are required.</p> 
 	<br>
	<form action="index.php" name="createuser" id="createuser">
	<fieldset> 		
		<label for="email">Email/ID &nbsp;</label> 
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" /><br> 
		<label for="password">Password</label> 
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" /><br> 
		<label for="name">UserLevel</label> 
		<select name=level" id="level" class="text ui-widget-content ui-corner-all">
			<option value="1">Admin</option>
			<option value="2">Manager</option>
			<option value="3">User</option>
			<option value="4">Guest</option>			
		</select>
	</fieldset> 
	<input type="hidden" name="task" value="createuser">
	<input type="hidden" name="component" value="admin">
	<input type="hidden" name="returntask" value="<?php echo $task;?>">
	</form> 
</div> 

<div id="createhost-form" title="Create new host alias"> 
	<form action="index.php" name="createhost" id="createhost">
	<fieldset> 		
		<label for="email">Host</label> 
		<input type="text" name="host" id="host" value="" class="text ui-widget-content ui-corner-all" /><br> 
		<label for="name">Name</label> 
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" /> <br>
		<label for="status">Status</label> 
		<input type="text" name="status" id="status" class="text ui-widget-content ui-corner-all" value="1" /><br> 
	</fieldset> 
	<input type="hidden" name="task" value="createhost">
	<input type="hidden" name="component" value="admin">
	<input type="hidden" name="returntask" value="<?php echo $task;?>">
	</form> 
</div> 

<div id="createnode-form" title="Create new node"> 
	<form action="index.php" name="createnode" id="createnode">
	<fieldset> 		
		<label for="email">Host</label> 
		<input type="text" name="host" id="host" value="" class="text ui-widget-content ui-corner-all" /> <br>
		<label for="name">Name</label> 
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" /> <br>
		<label for="status">Status</label> 
		<input type="text" name="status" id="status" class="text ui-widget-content ui-corner-all" value="1"/> <br> 
	</fieldset> 
	<input type="hidden" name="task" value="createnode">
	<input type="hidden" name="component" value="admin">
	<input type="hidden" name="returntask" value="<?php echo $task;?>">
	</form> 
</div> 

<!-- admin mod end -->               
<?php

	}
}

?>
