# player Add 

# Description
Here we implements the payment feature where teachers can contact with the authority. Teacher can fill up a form and submit this with there payment details.


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
 Query : 
 ``` $sql = "SELECT players.*, categories.categories_name FROM players, categories WHERE players.categories_id = categories.id order by players.player_name desc";
```

2. ManagePlayer.php
    
# View-Route

| # | Request Type     |      Paths         |    RouteName   |
|:-:|:----------------:|:------------------:|:--------------:|
| 1 |    /plater id    |   Manage Player    |  player id     |
| 2 |    /player id    |   AddPlayer        |  add player    |
 
