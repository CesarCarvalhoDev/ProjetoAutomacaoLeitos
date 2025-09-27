<?php 
include "../App/views/partials/header.php"
?>

<main>
    <div class="card-login">
        <form action="" method="post">
            <label for="email">
                Email:
                <input type="email" require>
            </label>
            <label for="senha">
                Senha:
                <input type="password" require>
            </label>
            <input type="submit">
        </form>
    </div>
</main>

<?php
include "../App/views/partials/footer.php"
?>
