<?php
include_once ("header.php");
?>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
      <h2>Информация выводится из списка файлов</h2>
      <table class="table table-bordered">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
        <tr>
          <td>1.jpg</td>
          <td><img src="http://lorempixel.com/people/200/200/" alt=""></td>
          <td>
            <a href="">Удалить аватарку пользователя</a>
          </td>
        </tr>
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../public/js/main.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>

  </body>
</html>
