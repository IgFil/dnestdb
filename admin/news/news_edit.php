<?php
require '../../db.php';
$news_base = R::getAll('SELECT * FROM `news`');
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="/css/main.css" type="text/css" rel="stylesheet">
    <title>Редактировние новостей</title>
</head>
<body>
<h1>Новости</h1>
<div class="container">
    <table>
        <tr>
            <th>Тема</th>
            <th>Новость</th>
            <th>Время создания</th>
            <th>Принять/удалить</th>
        </tr>
        <tr>
            <?php
            foreach ($news_base as $item) {
                echo ' <td>' . $item['title'] . '</td>
                <td>' . $item['body'] . '</td>
                <td>' . $item['time_create'] . '</td>
                <td>    
                     <form>
                        <button name="edit" value="' . $item['id'] . '" id="edit" type="button">Редактировать</button>
                        <button name="delete" value="' . $item['id'] . '" id="delete" >Удалить</button>
                     </form>
                </td>';


            }
            ?>
        </tr>
    </table>
</div>
<div id="result"></div>

<div id="news_edit" class="modal">
    <div class="window_content">
        <span class="close">&times;</span>
        <p>Редактирование новости</p>
        <form>
            <input name="news_edit_title" id="news_edit_title" placeholder="Новая тема новости">
            <textarea required name="news_edit_body" id="news_edit_body" placeholder="Новая суть новости"></textarea>
            <button id="accept" value="<? echo $_POST['edit']; ?>" name="go_to_edit">Отредактировать</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    var modal = document.getElementById('news_edit');
    var btn = document.getElementById("edit");
    var span = document.getElementsByClassName("close")[0];
    var btn_select = document.querySelector('#edit');


    btn.onclick = function () {
        modal.style.display = "block";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onload = function () {
        var text_set = document.querySelector('textarea[name=news_edit_body]');
        var text_set2 = document.querySelector('input[name=news_edit_title');
        var btn_set = document.querySelector('#delete');
        var btn_accept = document.querySelector('#edit');


        document.querySelector('#delete').onclick = function () {
            var params = 'id=' + btn_set.value;
            var worker = 'ajax_delete.php';
            ajaxPOST(params, worker);

        }
        document.querySelector('#accept').onclick = function () {
            var params = 'edit=' + btn_accept.value + '&' + 'news_edit_title=' + text_set2.value + '&' + 'news_edit_body=' + text_set.value;
            var worker = 'ajax_worker_edit.php';

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
