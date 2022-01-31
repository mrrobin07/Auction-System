# sold player 

# Description
Here we implements the players sold features.

Connection : 
```
<?php
    session_start();
    $conn = mysqli_connect ('localhost', 'root', '', 'auction system');
?>
```

# File

1. soldPlayer.php

    
# View-Route

| # | Request Type     |      Paths         |    RouteName   |
|:-:|:----------------:|:------------------:|:--------------:|
| 1 |    /plater id    |   player           |  player id     |
| 2 |    /player id    |   playerPrice      |  add player    |
