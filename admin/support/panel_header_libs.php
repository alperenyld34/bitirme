<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.ico">

<link href="../assets/node_modules/morrisjs/morris.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="dist/css/style.min.css" rel="stylesheet">
<link href="dist/css/pages/dashboard4.css" rel="stylesheet">

<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<link rel="stylesheet" href="../assets/css/flag/flag-icon.css" >
<link href="dist/css/pages/icon-page.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/node_modules/html5-editor/bootstrap-wysihtml5.css" />

<!-- page CSS -->
<link href="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/node_modules/select/select2.css" rel="stylesheet" type="text/css" />
<link href="../assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="../assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="../assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="../assets/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

<!--alerts CSS -->
<link href="../assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<link href="dist/css/pages/tab-page.css" rel="stylesheet">
<link href="../assets/node_modules/icheck/skins/all.css" rel="stylesheet">

<link href="dist/css/pages/form-icheck.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/node_modules/html5-editor/bootstrap-wysihtml5.css" />


<!-- CODE EDITOR !-->
<link rel="stylesheet" href="../assets/node_modules/codemirror/codemirror.css">
<script src="../assets/node_modules/codemirror/codemirror.js"></script>
<script src="../assets/node_modules/codemirror/active-line.js"></script>
<link rel="stylesheet" href="../assets/node_modules/codemirror/theme/3024-day.css">
<!-- CODE EDITOR !-->



<style>

    .CodeMirror {border-top: 1px solid #EBEBEB; border-bottom: 1px solid #EBEBEB;}
    /* This css is for normalizing styles. You can skip this. */
    *, *:before, *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }




    .new {
        padding: 50px;
    }

    .form-checkbox {
        display: block;
        margin-bottom: 0 !important;
    }

    .form-checkbox input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-checkbox label {
        position: relative;
        cursor: pointer;
    }

    .form-checkbox label:before {
        content:'';
        -webkit-appearance: none;
        background-color: #FFF;
        border: 1px solid #999;
        padding: 10px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    .form-checkbox input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 2px;
        left: 9px;
        width: 6px;
        height: 14px;
        border: solid #0b67cd;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }


     .awesome-select{
         font-family: 'fontAwesome',Arial; font-size:14px;
     }

    .table td, .table th{padding: 15px !important; vertical-align: middle !important;}
    table thead th {
        vertical-align: top !important;
    }



</style>

<style>

    .custom-file-input ~ .custom-file-label::after {
        content: "Dosya Seçin";
    }

    .file {
        visibility: hidden;
        position: absolute;
    }

    .btn.btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        outline: none;
        color: #fff;
    }

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<?php
//todo sitemap için jquery eklendi
?>
