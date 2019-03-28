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
<nav class="top-menu">
    <ul class="menu-main">
        <li class="right-item"><a href="/admin/reports.php">Назад</a></li>

    </ul>
</nav>
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
                        <button type="button" name="delete" value="' . $item['id'] . '" id="delete">Отклонить</button>
                        
                        </form></td>
                      </tr>';

        }


    }


    ?>
</table>


<div id="result"></div>
<div id="work_delete" class="modal">
    <div class="work_content">
        <span class="close">&times;</span>
        <p>Причина отклонения</p>
        <form>
            <textarea required name="not_accepted_body"></textarea>
            <button id="go_to_delete" value="<? echo $_POST['delete']; ?>" name="go_to_delete">Отклонить</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    var modal = document.getElementById('work_delete');
    var btn = document.getElementById("delete");
    var span = document.getElementsByClassName("close")[0];
    var btn_select = document.querySelector('#delete');
    btn.onclick = function () {
        modal.style.display = "block";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onload = function () {
        var text_set = document.querySelector('textarea[name=not_accepted_body]');
        var btn_set = document.querySelector('#delete');
        var btn_accept = document.querySelector('#accept')

        document.querySelector('#go_to_delete').onclick = function () {
            var params = 'not_accepted_body=' + text_set.value + '&' + 'go_to_delete=' + btn_set.value;
            var worker = 'ajax_not_accept_worker.php';
            ajaxPOST(params, worker);
        }
        document.querySelector('#accept').onclick = function () {
            var params = 'accept=' + btn_accept.value;
            var worker = 'ajax_worker.php';
            ajaxPOST(params, worker);
        }
    }

    function ajaxPOST(params, worker) {
        var request = new XMLHttpRequest();


        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.querySelector('#result').innerHTML = request.responseText;
                document.querySelector('form').style.display = 'none';
            }

        }

        request.open('POST', worker);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(params);
    }
</script>

</body>
</html>
