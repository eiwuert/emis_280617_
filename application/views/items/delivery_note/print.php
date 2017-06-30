<meta charset="utf-8" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js" > </script>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Delivery</title>');
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
	@font-face {
		    font-family: khmerOsMollight;
		    src: url(../../../assets/img/fonts/KhmerOSmuollight.ttf);
		}
		@font-face {
		    font-family: ahronbd;
		    src: url(../../../assets/img/fonts/ahronbd.ttf);
		}			
		@font-face {
		    font-family: khmerOSmuol;
		    src: url(../../../assets/img/fonts/KhmerOSmuol.ttf);
		}
		@font-face {
		    font-family: khmerOScontent;
		    src: url(../../../assets/img/fonts/KhmerOScontent.ttf);
		}
		@font-face {
		    font-family: time_new_romen;
		    src: url(../../../assets/img/fonts/times.ttf);
		}	
		@font-face {
		    font-family: coprgtb;
		    src: url(../../../assets/img/fonts/COPRGTB.TTF);
		}	
	/*++++++++ start body transcript++++++++*/
	.body_transcript{    
		padding-top: 130px;
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
	#info_right{		float: left;
					    padding: 0px 80px 0 0;
					    line-height: 15px;
					    letter-spacing: 0px;
					    margin-left: 40px;
					    font-size: 13px;
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
						padding: 4px 6px;
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
    					padding:2px 0px;
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
	.receiver{    
						width: 415px;
					    float: left;
					    position: absolute;
					    margin-top: 16px;
					    font-size: 14px;
					    letter-spacing: 0.4px;
    					line-height: 16px;
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
	.left{text-align:left;}
	.right{text-align:right;}
	.center{text-align:center;}

	/**/
	@font-face {
			    font-family: khmerOsMollight;
			    src: url(../../../assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: ahronbd;
			    src: url(../../../assets/img/fonts/ahronbd.ttf);
			}			
			@font-face {
			    font-family: khmerOSmuol;
			    src: url(../../../assets/img/fonts/KhmerOSmuol.ttf);
			}
			@font-face {
			    font-family: khmerOScontent;
			    src: url(../../../assets/img/fonts/KhmerOScontent.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(../../../assets/img/fonts/times.ttf);
			}	
			@font-face {
			    font-family: coprgtb;
			    src: url(../../../assets/img/fonts/COPRGTB.TTF);
			}	
			.header_form{
			        padding: 48px 0px 0px 36px;
			}
			.inner_header_form{
					width: 732px;
					margin-bottom: 15px;
					float: left;
			}
			.logo{
				padding: 27px 0px 0px 87px;
			}
			.logo img{
				width:85px;
			}
			.body_logo{
    width: 311px;
   	overflow: auto;
    margin: -3px 0px 0px 0px;
    float: left;
    color:blue;
			}
			.logo_text{
    padding-left: 0px;
    margin-top: 3px;
    font-size: 16.1px;
    font-family: khmerOsMollight;
    letter-spacing: 0.2;
			}
			.logo_text_eng{
    padding-left: 0px;
    font-size: 14px;
    font-family: time_new_romen;
    margin-top: -2px;
    letter-spacing: 1.1;
			}
			.logo_text_kh{
    padding-left: 2px;
    font-size: 13px;
    font-family: khmerOScontent;
    margin-top: 0px;
    letter-spacing: 1.1;
			}
			.logo_text_no{
    padding-left: 2px;
    font-size: 13px;
    font-family: khmerOScontent;
    margin-top: 2px;
    letter-spacing: 1.1;
			}
			.body_kingdom{
				    float: right;
				    width: 230px;
				    margin: 41px 12px 0px 0px;
				    height: 170px;
				    font-family: khmerOsMollight;
				    color:blue;
			}
			.txt_kingdom{  
				    margin: -7px 0px 0px 12px;
				    font-family: khmerOsMollight;
				    font-size: 18.6px;
			}
			.txt_kingdom_eng{  
				    margin: 1px 0px 0px 21px;
				    font-family: time_new_romen;
				    letter-spacing: 0;
			}
			.txt_nation_kingdom{  
			    	margin: 0px 0px 0px 1px;
				    font-family: khmerOsMollight;
				    font-size: 16px;
				    letter-spacing: 0.9;
			}
			.txt_nation_kingdom_eng{  
				    margin: 1px 0px 0px 19px;
				    font-family: time_new_romen;
				    letter-spacing: 1.1px;
			}
</style>

<page size="A4">
		
		
		<div class="header_form">
			<div class="inner_header_form">
				<div class="body_logo">
					<div class='logo'>
						<img src="<?php echo base_url('assets/img/logo.png')?>">
					</div>
					<div class="logo_text">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
					<div class="logo_text_eng">University of Management and Economics</div>
					<div class="logo_text_kh">សាខាខេត្តបន្ទាយមានជ័យ</div>
					<div class="logo_text_no">លេខោ:.............................</div>
				</div>

				<div class="body_kingdom">				
					<div class="txt_kingdom">ព្រះរាជាណាចក្រកម្ពុជា</div>
					<div class="txt_kingdom_eng">KINGDOM OF CAMBODIA</div>
					<div class="txt_nation_kingdom">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
					<div class="txt_nation_kingdom_eng">NATION RELIGION KING</div>
				</div>
			</div>
		</div>
		<div class="body_transcript">
		<center><h2>បញ្ជីចេញសំភារះ</h2></center>
		<center><span id='director_detail'>DELIVERY NOTE</span></center>
		
		<!-- <div style="width:100%;min-height:70px"> -->
			<!-- <table id="info_left">
				<tr>
					<td>Send By</td>
					<td><b>: <?php echo ($send_by)? $send_by : '' ?></b></td>
				</tr>
				<tr>
					<td>ចេញដោយ</td>
					<td><b>: <?php echo ($send_by_kh)? $send_by_kh : '' ?></b></td>
				</tr>				
				<tr>
					<td>Date</td>
					<td><b>: <?php echo ($delivery_ondate)? $delivery_ondate : '' ?></b></td>
				</tr>
			</table> -->

			
		<!-- </div> -->

		<div style="width:100%;overflow:auto;margin-top:20px">
			<table class="table_score" cellpadding="0" cellspacing="0" width="705">

				  <colgroup>
				    <col style="width: 10px;">
				    <col style="width: 80px;">
				    <col style="width: 130px;">
				    <col style="width: 130px;">
				    <col style="width: 80px;">
				    <col style="width: 80px;">
				    <col style="width: 80px;">
				    <col style="width: 120px;">
				    <col style="width: 120px;">
				    <col style="width: 120px;">
				  </colgroup>
				  <?php echo $get_delivery?>
			</table>
		</div>
		<div style="width:100%;overflow:auto;">
			<div class="receiver">
				<table id="info_right">
					<tr>
						<td>Received by:<?php echo ($receiver)? $receiver : '' ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="	height:50px;"></td>
					</tr>
					<tr>
						<td>Name<b>: <?php echo ($send_by)? $send_by : '' ?></b></td>
					</tr>
					<tr>						
						<td>Date:.</td>
					</tr>
				</table>
			</div>
		</div>
		<div style="width:100%;overflow:auto;">
			<div class="director">
				<center>Banteay Meanchey, April ......., 2015</center>
				<center>Director</center>
			</div>
		</div>

		
		</div>

</page>
</div>

