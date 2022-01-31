# player Add 

# Description
Here we implements the functionality of player adding 

# Active Controller

Connection : 

``` 
<?php
    session_start();
    $conn = mysqli_connect ('localhost', 'root', '', 'auction system');
?>
```


# File

1. AddPlayer.php

query
 ``` $sql = "SELECT players.*, categories.categories_name FROM players, categories WHERE players.categories_id = categories.id order by players.player_name desc";
```

2. ManagePlayer.php
    
# View-Route

| # | Request Type     |      Paths         |    RouteName   |
|:-:|:----------------:|:------------------:|:--------------:|
| 1 |    /plater id    |   Manage Player    |  player id     |
| 2 |    /player id    |   AddPlayer        |  add player    |
 
