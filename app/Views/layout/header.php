<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- Metadata dan link CSS -->
    <title><?= $title ?? 'Dashboard' ?> - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
    <!-- DataTables CSS jika diperlukan -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body class="sb-nav-fixed">
    <!-- Include Topbar -->

    <div id="layoutSidenav">