<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <header>
    <div class="">
      <img src="img/logo.svg" alt="" height='112px'>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="row main-area">

        <div class="col-4 group-area">
          <div class="selector">
            <div id="ergebnis" class="ergebnis">
              <span id="status">Все</span>
            </div>

            <label class="toggle">
              <input id="toggleswitch" type="checkbox">
              <span class="roundbutton"></span>
            </label>
          </div>
          <ul id="myList" class="users-groups"></ul>
          <?php 
            require("get_all_phones.php");
            require("get_all_groups.php");
            $groups = get_all_groups();
            $json = get_all_phones();
          ?>
          <script>
            let phones = <?php echo $json; ?>;
            let groups = <?php echo $groups; ?>;
            let list = document.getElementById("myList");
            var input = document.getElementById('toggleswitch');
            var outputtext = document.getElementById('status');
            var numbers_array = document.getElementsByClassName("Numbers");
            var groups_array = document.getElementsByClassName("Groups");

            for (i = 0; i < groups.length; ++i) {
              let li = document.createElement('li');
              li.innerText = groups[i][0];
              li.className = "Groups";
              list.appendChild(li);
            }

            for (i = 0; i < phones.length; ++i) {
              let li = document.createElement('li');
              li.innerText = phones[i][0];
              li.className = "Numbers";
              list.appendChild(li);
            }
            
            input.addEventListener('change',function(){
              if(this.checked) {
                outputtext.innerHTML = "Группы";
                for(var i=0; i<numbers_array.length; i++)numbers_array[i].style.display='none';
                for(var i=0; i<groups_array.length; i++)groups_array[i].style.removeProperty('display');
                
              } else {
                outputtext.innerHTML = "Номера";
                for(var i=0; i<groups_array.length; i++)groups_array[i].style.display='none';
                for(var i=0; i<numbers_array.length; i++)numbers_array[i].style.removeProperty('display');
              }
            });
          </script>
        </div>

        <div class="col-8 text-area">
          <form class="message-for-users" action="catch_message.php" onsubmit="catch_message()" method="POST">
            <label for="group-or-number"><b>Введите номер или группу</b></label>
            <br>
            <input type="text" name="group-or-number" id="group-or-number" placeholder="Номер или группа" required>

            <textarea name="message-for-users" id="message-for-users" placeholder="Введите сообщение..." required></textarea>

            <button type="submit">Отправить сообщение</button>
          </form>
          <!-- <button class="text-message-btn" type="submit" value="">Отправить</button> -->
        </div>
            
      </div>
    </div>
  </main>

  <footer>

  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <script src="toogle_button.js"></script> -->
</body>
</html>
