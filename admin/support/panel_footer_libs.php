<script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="../assets/node_modules/popper/popper.min.js"></script>
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--Sky Icons JavaScript -->
<script src="../assets/node_modules/skycons/skycons.js"></script>
<!--morris JavaScript -->
<script src="../assets/node_modules/raphael/raphael-min.js"></script>
<script src="../assets/node_modules/morrisjs/morris.min.js"></script>
<script src="../assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Chart JS -->
<script src="dist/js/dashboard4.js"></script>

<script src="dist/js/jscolor.js"></script>

<!-- wysuhtml5 Plugin JavaScript -->
<script src="../assets/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="../assets/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();


    });
</script>
<script type="text/javascript">
    $('#slimtest1, #slimtest2, #slimtest3, #slimtest4').perfectScrollbar();
</script>




<script src="../assets/node_modules/switchery/dist/switchery.min.js"></script>
<script src="../assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/node_modules/multiselect/js/jquery.multi-select.js"></script>

<script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<!-- Sweet-Alert  -->
<script src="../assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script src="../assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>

<!-- Color Picker Plugin JavaScript -->

<script src="../assets/node_modules/icheck/icheck.min.js"></script>
<script src="../assets/node_modules/icheck/icheck.init.js"></script>



<script id="rendered-js">
    $(".selectall").click(function () {
        $(".individual").prop("checked", $(this).prop("checked"));
    });
    //# sourceURL=pen.js
</script>

<!-- wysuhtml5 Plugin JavaScript -->
<script src="../assets/node_modules/tinymce_2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#mymce',
        height:450,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | code | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        language: 'tr_TR',
        branding: false,

        // without images_upload_url set, Upload tab won't show up
        images_upload_url: 'editor_upload.php',

        // override default upload handler to simulate successful upload
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'editor_upload.php');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
    });
    tinymce.init({
        selector: '#mymce2',
        height:450,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | code | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        language: 'tr_TR',
        branding: false,

        // without images_upload_url set, Upload tab won't show up
        images_upload_url: 'editor_upload.php',

        // override default upload handler to simulate successful upload
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'editor_upload.php');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
    });
</script>


<!-- CODE EDITOR !-->
<script>
    var nonEmpty = false;
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: "application/xml",
        styleActiveLine: true,
        lineNumbers: true,
        theme:"3024-day",
        lineWrapping: true
    });

    function toggleSelProp() {
        nonEmpty = !nonEmpty;
        editor.setOption("styleActiveLine", {nonEmpty: nonEmpty});
        var label = nonEmpty ? 'Disable nonEmpty option' : 'Enable nonEmpty option';
        document.getElementById('toggleButton').innerText = label;
    }
</script>

<script src='../assets/node_modules/select//select2.min.js'></script>
<script id="rendered-js">
    function format(item, state) {
        if (!item.id) {
            return item.text;
        }
        var countryUrl = "../assets/css/flag/flags/4x3/";
        var url = state ? stateUrl : countryUrl;
        var img = $("<img>", {
            class: "img-flag",
            width: 26,
            src: url + item.element.value.toLowerCase() + ".svg" });

        var span = $("<span>", {
            text: " " + item.text });

        span.prepend(img);
        return span;
    }

    $(document).ready(function () {
        $("#countries").select2({
            templateResult: function (item) {
                return format(item, false);
            } });

        $("#us-states").select2({
            templateResult: function (item) {
                return format(item, true);
            } });

    });
    //# sourceURL=pen.js
</script


        <!-- This is data table -->
<script src="../assets/node_modules/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 22
                }],
                "order": [
                    [22, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(22, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 22 && currentOrder[1] === 'asc') {
                    table.order([22, 'desc']).draw();
                } else {
                    table.order([22, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


<script id="rendered-js">
    $(document).on("click", ".browse", function () {
        var file = $(this).
        parent().
        parent().
        parent().
        find(".file");
        file.trigger("click");
    });
    $(document).on("change", ".file", function () {
        $(this).
        parent().
        find(".form-control").
        val(
            $(this).
            val().
            replace(/C:\\fakepath\\/i, ""));

    });
    //# sourceURL=pen.js
</script>


<script src="dist/js/bs-custom-file-input.min.js"></script>
<script>
    bsCustomFileInput.init()

    var btn = document.getElementById('btnResetForm')
    var form = document.querySelector('form')
    btn.addEventListener('click', function() {
        form.reset()
    })
</script>


<script id="rendered-js">
    var $fileInput = $('.file-input');
    var $droparea = $('.file-drop-area');

    // highlight drag area
    $fileInput.on('dragenter focus click', function () {
        $droparea.addClass('is-active');
    });

    // back to normal state
    $fileInput.on('dragleave blur drop', function () {
        $droparea.removeClass('is-active');
    });

    // change inner text
    $fileInput.on('change', function () {
        var filesCount = $(this)[0].files.length;
        var $textContainer = $(this).prev();

        if (filesCount === 1) {
            // if single file is selected, show file name
            var fileName = $(this).val().split('\\').pop();
            $textContainer.text(fileName);
        } else {
            // otherwise show number of files
            $textContainer.text(filesCount + ' Dosya Seçildi');
        }
    });
    //# sourceURL=pen.js
</script>


<script src="dist/js/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
<script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>
<!-- Date Picker Plugin JavaScript -->
<script src="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true
    });

</script>