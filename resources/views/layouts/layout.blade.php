<!DOCTYPE html>
<html lang="en">
<head>
    <title>Step By Step Learning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{asset('/images/loader.png')}}">
    {{--    bootstrap cdn--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    {{--    font family--}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@400;600&display=swap"
          rel="stylesheet">

    {{--    css file link--}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome 6 -->
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    {{--    lordicon cdn--}}
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

    {{--    DataTable--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.foundation.min.css">


    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <!-- Multi select -->
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet"/>
    <style>
        /*data table*/
        .dataTables_wrapper .dataTables_filter input {
            border-bottom: 1px solid #aaa !IMPORTANT;
            border-top: 0px solid #aaa !IMPORTANT;
            border-left: 0px solid #aaa !IMPORTANT;
            border-right: 0px solid #aaa !IMPORTANT;
            border-radius: 0px !important;
            padding: 5px;
            background-color: transparent;
            margin-left: 3px;
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 0px solid #aaa !important;
            border-radius: 40px !important;
            padding: 5px;
            background-color: transparent;
            padding: 4px;
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #003a98 !important;
            background-color: rgba(230, 230, 230, 0.1);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(230, 230, 230, 0.1)), color-stop(100%, rgba(0, 0, 0, 0.1)));
            background: -webkit-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -moz-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -ms-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -o-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: #003a98;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.2em 0.8em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: #fff !important;
            border: 1px solid transparent;
            border-radius: 6px !important;
        }

        a.active {
            border: 10px solid #00246B;
            background: #00246B;
            color: white !important;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        a {
            color: #ca5729;
            text-decoration: none;
        }
    </style>
</head>
<body>

{{--<div class="loading-screen" id="loading-screen">--}}
{{--    <div class="spinner-container">--}}
{{--        <span class="first"></span>--}}
{{--        <span class="bol"></span>--}}
{{--        <div class="spinner"></div>--}}
{{--    </div>--}}
{{--</div>--}}


@include('layouts.header')

<div class="container-fluid" style="margin-top: 100px!important;">
    @include('layouts.sidebar')
    @include('layouts.body')
</div>

{{--<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>--}}

{{--    datatables--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-reports/bootstrap-select.js') }}"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!---chart js----->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<script src="{{ asset('js/common.js') }}"></script>

<!-----multiple select-------------->
<script src="{{ asset('js/bootstrap-select.js') }}"></script>

<script>
    $(".select2").select2({
        placeholder: " ",
        allowClear: true
    });

    $(".customerSelect2").select2({
        placeholder: "Select Customer",
        allowClear: true
    });

    $(".viewModelSelect2").select2({
        allowClear: false
    });


</script>

{{-- TODO:: Need to Un-Comment when site goes to Live--}}
{{--<script>--}}

{{--    /**--}}
{{--     * Disable right-click of mouse, F12 key, and save key combinations on page--}}
{{--     */--}}
{{--    document.addEventListener("contextmenu", function(e){--}}
{{--        e.preventDefault();--}}
{{--    }, false);--}}
{{--    document.addEventListener("keydown", function(e) {--}}
{{--        //document.onkeydown = function(e) {--}}
{{--        // "I" key--}}
{{--        if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {--}}
{{--            disabledEvent(e);--}}
{{--        }--}}
{{--        // "J" key--}}
{{--        if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {--}}
{{--            disabledEvent(e);--}}
{{--        }--}}
{{--        // "S" key + macOS--}}
{{--        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {--}}
{{--            disabledEvent(e);--}}
{{--        }--}}
{{--        // "U" key--}}
{{--        if (e.ctrlKey && e.keyCode == 85) {--}}
{{--            disabledEvent(e);--}}
{{--        }--}}
{{--        // "F12" key--}}
{{--        // if (event.keyCode == 123) {--}}
{{--        //     disabledEvent(e);--}}
{{--        // }--}}
{{--        // "C" key--}}
{{--        if (e.ctrlKey && event.keyCode == 67) {--}}
{{--            disabledEvent(e);--}}
{{--        }--}}
{{--    }, false);--}}
{{--    function disabledEvent(e){--}}
{{--        if (e.stopPropagation){--}}
{{--            e.stopPropagation();--}}
{{--        } else if (window.event){--}}
{{--            window.event.cancelBubble = true;--}}
{{--        }--}}
{{--        e.preventDefault();--}}
{{--        return false;--}}
{{--    }--}}

{{--</script>--}}


@include('common_script.alert_script')
@include('common_script.delete_script')

@yield('script')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // $("#getFileInfo").on('click', function() {
    $('input[type="file"]').change(function (e) {
        $("#ulList").empty();
        var fp = $("#file");
        console.log(fp);
        var lg = fp[0].files.length; // get length
        console.log(lg);
        var items = fp[0].files;
        var fragment = "";
        if (lg > 0) {
            for (var i = 0; i < lg; i++) {
                var fileName = items[i].name; // get file name
                var fileSize = items[i].size; // get file size
                var fileType = items[i].type; // get file type
                var filevalue = items[i].value;
                // var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
                //     i = 0;
                // while (fileSize > 900) {
                //     fileSize /= 1024;
                //     i++;
                // }
                // var exactSize = (Math.round(fileSize * 100) / 100) + ' ' + fSExt[i];
                // console.log('FILE SIZE = ', exactSize);
                // alert(exactSize);
                // append li to UL tag to display File info
                // fragment += "<li>" + fileName + " (<b>" + fileSize + "</b> bytes) - Type :" + fileType + "</li>";
                fragment += '<div class="col-lg-6 col-md-12 mb-3"><div class="media border p-3">' +
                    '<img src="' + filevalue + '" alt="imagesLogo.png" class="rounded" style="width:150px; height:100px;"><div class="media-body"><p>' + fileName + '</p>' +
                    '<p>File Size : ' + fileSize + '</p></div></div></div>';
            }

            $("#ulList").append(fragment);
        }
    });


    var path = window.location.href;
    // because the 'href' property of the DOM element is the absolute path
    $('#sidebar ul a').each(function () {
        if ((this.href === path) || (this.href + "/create" === path) || (this.href + "/edit/" === path) || (this.href + "/show" === path)) {
            $(this).addClass('active');
        }
    });

    if ((path.split("/").includes('leave') === true) || (path.split("/").includes('permission') === true)) {
        $('#triggerLM').click();
    }

    if ((path.split("/").includes('reports') === true)) {
        $('#triggerReport').click();
    }
    if ((path.split("/").includes('office') === true)) {
        $('#officeTrigger').click();
    }
</script>

<script>
    function globalSearch() {
        let searchValue = $('#dropdownMenu2').val();

        if (searchValue) {
            $.ajax({
                type: "POST",
                url: '{{ route('globalSearch') }}',
                data: {
                    searchValue: searchValue,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    $('#search_menu_list').empty();
                    response.data.forEach(appendList);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Something went wrong!, Refresh the Page and Try Again...',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#search_menu_list').empty();
        }
    }

    function appendList(item, index) {
        $('#search_menu_list').append(item);
    }
</script>

</body>
</html>
