<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Maqe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid mt-3">
    <h2>Maqe</h2>
        <form method="GET" action="cal.php">
            <div class="input-group mb-2 xs-3">
                <span class="input-group-text ">Input</span>
                <input type="text" class="form-control d-inline-block" id="value" name='value' placeholder="RW15RW1">
            </div>
            <input type="submit" class="btn btn-secondary mb-2">
            <div class="form-control" id="result">
                <?php if(isset($_GET['result']))echo $_GET['result'];
                ?>
            </div>
        </form>
    </div>
</body>

</html>