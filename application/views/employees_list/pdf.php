<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js')?>" > </script>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Transcription</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />



<div id="mydiv">
<style type="text/css">
	body {
	  background: rgb(204,204,204); 
	}
	page[size="A4"] {
	  background: white;
	  /*background-image: url("<?php echo base_url('assets/img/img2.jpg')?>");*/
	  background-size: contain;
	  width: 21cm;
	  height: 29.7cm;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	@media print {
	  body, page[size="A4"] {
	    margin: 0;
	    box-shadow: 0;
	  }
	}
	/*++++++++ start body transcript++++++++*/
	.body_transcript{    
						padding-top: 209px;
    					line-height: 11px;
	}
	h2{font-size: 23.5px;}
	.text_indent{
		    			text-indent: 9px;
	}
	#director_detail{
					    font-size: 14px;
			    		letter-spacing: 0.2px;
	}
	#info_left{
						float:left;   
						padding: 8px 0 0 70px;
					    line-height: 15px;
					    letter-spacing: 0px;
					    position: absolute;
    					margin-left: 0px;
    					font-size: 13px;
	}
	#info_right{		float: right;
					    padding: 8px 80px 0 0;
					    line-height: 15px;
					    letter-spacing: 0px;
					    position: absolute;
    					margin-left: 470px;
    					font-size: 13px;
	}
	#the_following{
						color: black;
				    	padding: 6px 0px;
					    font-size: 14px;
					    font-weight: bold;
					    letter-spacing: 0.2px;
	}
	.table_score{
		    color: black;
		    margin: 0 auto;
		    font-size: 11px;
		    border-style: solid solid none none;
		    border-width: 1px;
		    border-color: black;
    		line-height: 14px;
	}

	.table_score tr{
						padding: 1px 0px;
	}
	.table_score tr th{
						padding: 1px 6px;
						border-style: none none solid solid;
						border-width: 1px;
    					border-color: black;
    					font-weight: bolder;
    					font-size: 10px;
	}

	.table_score tr td{
						border-style: none none solid solid;   
						border-width: 1px;
    					border-color: black;
	}
	.table_score tr th span{
						text-indent: 12px;
	}
	.head_subject{
			   		    width: 167px;
					    font-size: 9px;
	}	
	.head_credit{
			   		    width: 38px;
					    font-size: 9px;
	}
	.head_grade{
			   		    width: 38px;
					    font-size: 9px;
	}
	.head_score{
			   		    width: 38px;
					    font-size: 9px;
	}
	.director{    
						width: 300px;
					    float: right;
					    margin-top: 16px;
					    font-size: 14px;
					    letter-spacing: 0.4px;
    					line-height: 16px;
	}
	.system_grading{
					    width: 300px;
					    float: left;
					    margin-top: 160px;
					    margin-left: 59px;
					    font-size: 11px;
	}
	.system_grading table{    
						font-size: 10px;
					    line-height: 11px;
					    text-indent: 6px;
					    margin-top: 4px;
	}
	.system_grading table tr th{    
						font-weight: bold;
	}

</style>

<page size="A4">
	
		<div class="body_transcript">
		<center><h2>EMPLOYEES LIST</h2></center>
		
		<div style="width:100%;min-height: 100px">
			<table id="info_left">
				<tr>
					<td>Department</td>
					<td><b>: </b></td>
				</tr>
				<tr>
					<td>Employee Type</td>
					<td><b>: </b></td>
				</tr>

				<tr>
					<td>Active</td>
					<td><b>: </b></td>
				</tr>
				<tr>
					<td>Other</td>
					<td><b>: </b></td>
				</tr>

			</table>
		</div>
		<div style="width:100%;overflow:auto;">
			<table class="table_score" cellpadding="0" cellspacing="0" width="705">

				  <colgroup>
				    <col style="width:3%">
				    <col style="width:20%">
				    <col style="width:20%">
				    <col style="width:10%">
				    <col style="width:10%">
				    <col style="width:10%">
				  </colgroup>

				<tr>
					<th><center>No.</center></th>
					<th><center>Professor Name</center></th>
					<th><center>Professor Name(kh)</center></th>
					<th><center>Sex</center></th>
					<th><center>D.O.B</center></th>
					<th><center>Start Date</center></th>
				</tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>1</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>2</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>3</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>4</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>5</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>6</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>7</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>

				<tr style="cursor: pointer;">                                                                       
                    <td><center>8</center></td>                                
                    <td><center>បុគ្គលិក</center></td>                                
                    <td><center>Employee</center></td>
                    <td><center>Male</center></td>
                    <td><center>16-03-1988</center></td>
                    <td><center>16-03-2016</center></td>
                </tr>
				

		<!--  -->

			</table>
		</div>
		</div>

</page>
</div>

