<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontserdihaldussüsteem</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap-theme.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="../js/libs/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="../js/libs/jquery/external/sizzle/dist/sizzle.min.js" crossorigin="anonymous"></script>
    <script src="../js/libs/jquery-ui/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script src="../js/repeatable-fields/repeatable-fields.js"></script>
</head>

<body>
    <header id="header">

        <span><img src="./images/nurmoja_net_ee.png" alt=""></span>
        <span>Kontserdid ja nende kavad</span>
    </header>
    <div class="container-fluid">
        <form method="post">
            <div class="repeat">
                <table class="wrapper" width="100%">
                    <thead>
                        <tr>
                            <td colspan="4"><span class="add btn btn-success">Add</span>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="table" class="rows">
                        <tr class="template row">
                            <td width="10%">
                                <span class="move btn btn-info">Move ↕</span>
                                <input type="hidden" id="table[{{row-count-placeholder}}][jrk]"
                                    name="table[{{row-count-placeholder}}][jrk]" class="move-steps" value="1" />
                            </td>

                            <td width="30%">
                                <input type="text" name="table[{{row-count-placeholder}}][an-input-field]" />
                            </td>
                            <td width="30%">
                                <input type="text" name="table[{{row-count-placeholder}}][afield]" />
                            </td>

                            <td width="10%"><span class="remove">Remove</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="submit" value="Submit">
        </form>

        <script type="text/javascript">
        jQuery(function() {
            jQuery('.repeat').each(function() {
                jQuery(this).repeatable_fields({
                    wrapper: 'table',
                    container: 'tbody',
                    row: 'tr',
                });
            });
        });
        </script>
        <?php 

        $newlist = [];
        if (!empty($_POST)) $newlist = array_values($_POST['table']);

        unset($_POST);
        foreach ($newlist as $key => &$row)
        {
            //unset($row['jrk']);
            $row['jrk'] = $key;
            var_dump($key);
        }

        echo '<pre>';
        print_r($newlist);
        echo '</pre>';
        echo 'Kas näen?';

        foreach ($newlist as $value)
        {
            print_r($value['jrk']);
        }

        ?>
    </div>
</body>

</html>