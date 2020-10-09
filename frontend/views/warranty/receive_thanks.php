<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/component.css" />
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
    	<div class="row">
    	<?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
    		
	   
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;margin-top: 20px;">
	                
	               
	              
	               
	               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light ptop15">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light box-shadow" style="border-radius: 5px;">
	                	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center ptop15 pbottom15">
	                	        
	                	    </div>
	                	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium talign-center" style="font-size:36px;">
        	                    Terima Kasih!
        	               </div>
	                	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center ptop15 pbottom15">
	                	        
	                	    </div>
	                	
	                	   
	                	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:30px;"></div>
	                	    
	                	    
	                	</div>
	                   
	                </div>
	              
	               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light talign-center ptop15">
	                    <a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/details/<?php echo $service->service_id; ?>" class="blue-round" style="width:100%;">Kembali</a>
	               </div>
	                
	 
	                <div class="hidden-lg col-md-12 col-sm-12 hidden-xs" style="padding-top:90px;"></div>
	            </div>
	     	
	            
            </div>
            
        </div>
    </div>
</section>
<?php
    echo Yii::$app->view->renderFile('@app/views/warranty/modal.php',['service'=>$service]);
?>
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/custom-file-input.js"></script>
<style type="text/css">
    
    a.blue-round#choose-service{
        color: #fff;
    }
    a.blue-round#choose-service:hover{
        color: #1d6068;
    }
	.card-left{
		width: 62% !important;
	
	}
	.card-right{
		width: 38% !important;
	}
	.bgcolorgray{
		background-color: rgb(193,185,179);
	}
	.select2-container .select2-selection--single {
	    height: 35px !important;
	    border-radius: 25px;
	    background-color: #1d6068;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered{
		line-height: 33px;
		padding-left: 15px;

	}
	.select2-container--default .select2-selection--single .select2-selection__placeholder{
		color: #fff;
	}
	.select2-container--default .select2-selection--multiple {
	    /*background-color: #1d6068;*/
	    border-radius: 25px;
	}
	.inputfile + label {
	    color: rgb(69,69,69);
	}
	.inputfile + label {
	    max-width: 100%;
    	width: 100%;
	    font-size: 1.25rem;
	    font-weight: 700;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    cursor: pointer;
	    display: inline-block;
	    overflow: hidden;
	    padding: 0; 
	}
	.close {
	    float: right;
	    font-size: 21px;
	    font-weight: 700;
	    line-height: 1;
	    color: #000;
	    text-shadow: 0 1px 0 #fff;
	    filter: alpha(opacity=20);
	    opacity: 1;
	}
	p {
	    font-size: 11px;
	    line-height: 1.2;
	}
	
	@media only screen and (max-width : 768px) {
        a.blue-round {
            float: right;
            border: 1px solid #1d6068;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 12px;
            padding-right: 12px;
            letter-spacing: 1.5px;
         
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
        a.grey-round {
            float: right;
            border: 1px solid grey;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 1.5px;

            background: grey;
            color: #fff;
            /*width: 10%;*/
        }
    }
</style>


<style>
.drop-service {
   
    padding-top: 7px;
    padding-bottom: 7px;
   
    font-family: gotham-light;
    border: none;
    cursor: pointer;
    padding-left: 15px;
    border-radius: 15px;
}

.dropbtn:hover, .dropbtn:focus {
    /*background-color: #2980B9;*/
}
a.bgcolorblue:hover{
    color:#fff;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 0 0 15px 15px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd}

.show {display:block;}
.checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::before{
   
     background-color: rgb(32,97,103); 
    background-image: url(/img/warranty/icons/Icon-22-green.png);
    background-size: cover;
    border-radius: 2px;
}
.checkbox-btn label.black-style::after{
        border: 1px solid rgb(32,97,103);
}
.checkbox-btn label.black-style::before{
    margin-top: 0px;
}
</style>
<style>

.control {
display: block;
position: relative;
padding-left: 27px;
padding-top: 3px;
margin-bottom: 8px;
cursor: pointer;
font-size: 11px;
}
.control input {
position: absolute;
z-index: -1;
opacity: 0;
}
.control__indicator {
position: absolute;
top: 2px;
left: 10px;
height: 15px;
width: 15px;
background: #fff;
    border: solid 1px rgb(158,131,97);
    border-radius: 4px;
}
.control--radio .control__indicator {
border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control input:checked ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control input:disabled ~ .control__indicator {
background: #fff;
opacity: 0.6;
pointer-events: none;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control__indicator:after {
content: '';
position: absolute;
display: none;
}
.control input:checked ~ .control__indicator:after {
display: block;
}
.control--checkbox .control__indicator:after {
left: 5px;
top: 2px;
width: 4px;
height: 8px;
border: solid rgb(158,131,97);
border-width: 0 2px 2px 0;
transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
border-color: rgb(158,131,97);
}


</style>
<style type="text/css">
    
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::before,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::before
     {
        opacity: 1;
        background-color: rgb(32,97,103);
        width: 13px;
        border-radius: 2px;
        height: 13px;
        top: 7px;
        left: 7px;
    }
   
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::after,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::after,
    .radio-btn.agreement-radio input[type="checkbox"]:checked+label::after,
    .radio-btn.agreement-radio input[type="radio"]:checked+label::after {
        border: 1px solid rgb(32,97,103);
    }

    .checkbox-btn label.black-style::after {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        left: 0;
        top: 0;
        margin-left: -9px;
        margin-top: 6px;
        background-color: transparent;
        border: 1px solid rgb(32,97,103);
        border-radius: 4px;
        background-clip: padding-box;
        cursor: pointer
    }
    .radio-btn label.black-style::before {
        background: rgb(32,97,103);
        border: 1px solid rgb(32,97,103);
        width: 8px;
        height: 8px;
        top: 9px;
        left: 9px;
    }
    .radio-btn label.black-style::after {
    
        border: 1px solid rgb(32,97,103);
        width: 12px;
        height: 12px;
    }
    .checkbox-btn.agreement-checkbox{
        padding-left: 12px;
        padding-top: 0;
    }
    
    button.blue-round {
        float: right;
        border: 1px solid #1d6068;
        cursor: pointer;
        border-radius: 20px;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        letter-spacing: 1.5px;
        font-size: 12px;
        background: #1d6068;
        color: #fff;
        /* width: 10%; */
    }
    button.blue-round:hover {
       
        background: #fff;
        color: #1d6068;
        /* width: 10%; */
    }
    
</style>