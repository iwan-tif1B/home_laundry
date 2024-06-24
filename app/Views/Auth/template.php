<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in with illustration - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="<?= base_url('/assets/dist/css/'); ?>tabler.min.css?1692870487" rel="stylesheet" />
    <link href="<?= base_url('/assets/dist/css/'); ?>tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="<?= base_url('/assets/dist/css/'); ?>tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="<?= base_url('/assets/dist/css/'); ?>tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="<?= base_url('/assets/dist/css/'); ?>demo.min.css?1692870487" rel="stylesheet" />
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="<?= base_url('/assets/dist/js'); ?>/demo-theme.min.js?1692870487"></script>
    <!-- render halaman dinamis -->
    <?= $this->renderSection('content'); ?>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?= base_url('/assets/dist/js'); ?>/tabler.min.js?1692870487"></script>
    <script src="<?= base_url('/assets/dist/js'); ?>/demo.min.js?1692870487"></script>
    <script type="text/javascript" src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
</body>

</html>