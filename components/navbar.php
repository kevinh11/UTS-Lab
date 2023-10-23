<nav class='navbar p-3 container-fluid d-flex flex-row justify-content-between align-items-center bg-primary'>
        <h2>todo</h2>

        <div class='acc-option'>
            <?php
                echo $_COOKIE['username'];

            ?>
           <a href='logout.php'>Log Out</a>
        </div>
    </nav>