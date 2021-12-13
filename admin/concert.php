<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontserdihaldussüsteem</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
	<script src="../js/libs/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
	<script src="../js/libs/jquery/dist/jquery.slim.js" crossorigin="anonymous"></script>
	<script src="../js/libs/jquery/external/sizzle/dist/sizzle.min.js" crossorigin="anonymous"></script>
	<script src="../js/libs/jquery-ui/jquery-ui.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <header id="header">

        <span><img src="./images/nurmoja_net_ee.png" alt=""></span>
        <span>Kontserdid ja nende kavad</span>
    </header>
    <div class="container-fluid">
        <div class="repeat">
            <table class="wrapper" width="100%">
                <thead>
                    <tr>
                        <td width="10%" colspan="4"><span class="add">Add</span></td>
                    </tr>
                </thead>
                <tbody class="container">
                    <tr class="template row">
                        <td width="10%">
                            <span class="move">Move Row</span>
                            <span class="move-up">Move Up</span>
                            <input type="text" class="move-steps" value="1" />
                            <span class="move-down">Move Down</span>
                        </td>

                        <td width="10%">An Input Field</td>

                        <td width="70%">
                            <input type="text" name="an-input-field[{{row-count-placeholder}}]" />
                        </td>

                        <td width="10%"><span class="remove">Remove</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    jQuery(function() {
        jQuery('.repeat').each(function() {
            jQuery(this).repeatable_fields();
        });
    });
    </script>
</body>

</html>