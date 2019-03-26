<?php
require '../../db.php';
?>
<html>
<head>
    <title>Не принятые жалобы</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>
<body>
<script type="text/javascript">
    window.onload = function () {
        var btn_set = document.querySelector('button[name=accept]');
        document.querySelector('#accept').onclick = function () {
            var params = 'accept=' + btn_set.value;

            ajaxPOST(params);
        }
    }

    function ajaxPOST(params) {
        var request = new XMLHttpRequest();


        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.querySelector('#result').innerHTML = request.responseText;

            }

        }

        request.open('POST', 'ajax_worker.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(params);
    }


</script>
<table>
    <tr>
        <th>Жалоба</th>
        <th>Принять/Отклонить</th>
    </tr>
    <?php
    $type = 'report';
    $report_base = R::find('questions', 'type = ?', array($type));
    foreach ($report_base as $item) {
        if ($item['status'] == 'Не принято') {
            echo '
                      <tr>
                        <td>' . $item['body'] . '</td>
                        <td><form>
                        <button type="button" name="accept" value="' . $item['id'] . '" id="accept">Принять</button>
                        <button type="button" name="delete" id="delete">Отклонить</button>
                        
                        </form></td>
                      </tr>';

        }


    }


    ?>
</table>
<div id="result"></div>
</body>
</html>
