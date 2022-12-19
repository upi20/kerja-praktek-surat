<style>
    @page {
        margin: .3cm;
        /* padding: 1cm; */
    }

    body {
        font-family: sans-serif;
        padding: 0cm
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    table,
    th,
    td {
        padding: 8px 4px;
        border-collapse: collapse;
        vertical-align: top;
    }

    .tbl-2 table,
    .tbl-2 th,
    .tbl-2 td,
        {
        padding: 2px 2px;
    }

    .p-title {
        margin: 4px;
    }

    .garis {
        border: none;
        height: 2px !important;
        color: #000;
        background-color: #000;
        opacity: 1;
        border-radius: 4px;
    }

    .my-table td,
    .my-table th {
        border: 1px solid #000;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .no-border {
        border: 0 !important;
        padding: 2px
    }

    .table-detail td {
        padding: 2px
    }

    a {
        text-decoration: none;
    }

    a {
        color: black;
    }

    .b-left {
        border-left: 1px solid #000;
    }

    .b-right {
        border-right: 1px solid #000;
    }

    .b-top {
        border-top: 1px solid #000;
    }

    .b-bottom {
        border-bottom: 1px solid #000;
    }

    .b-all {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    .fw-bold {
        font-weight: bold;
    }

    div.breakNow {
        page-break-inside: avoid;
        page-break-after: always;
    }
</style>

@for ($i = 1; $i <= 150; $i++)
    <style>
        .w-{{ $i }} {
            width: {{ $i }}% !important;
        }

        .p-{{ $i }} {
            padding: {{ $i }}% !important;
        }


        .m-{{ $i }} {
            margin: {{ $i }}% !important;
        }

        .pt-{{ $i }} {
            padding-top: {{ $i }}% !important;
        }

        .mt-{{ $i }} {
            margin-top: {{ $i }}% !important;
        }

        .pb-{{ $i }} {
            padding-bottom: {{ $i }}% !important;
        }

        .mb-{{ $i }} {
            margin-bottom: {{ $i }}% !important;
        }

        .pl-{{ $i }} {
            padding-left: {{ $i }}% !important;
        }

        .ml-{{ $i }} {
            margin-left: {{ $i }}% !important;
        }

        .pr-{{ $i }} {
            padding-right: {{ $i }}% !important;
        }

        .mr-{{ $i }} {
            margin-right: {{ $i }}% !important;
        }
    </style>
@endfor
