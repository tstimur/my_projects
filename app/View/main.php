<html>
<div class="container">
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                        <?php echo $product['brand']; ?>
                    </div>
                    <img class="card-img-top" src="<?php echo $product['link']; ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['category']; ?></p>
                        <a href="#"><h5 class="card-title"><?php echo $product['name']; ?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price']; ?> $
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</html>
<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

</style>



<html>
<div class="wrapper">
    <div class="row justify-content-between align-items-center">
        <div class="col-6 col-md-4 logo-wrapper">
            <img src="https://www.freeiconspng.com/uploads/abstract-png-15.png" alt="a free logo" class="logo">
        </div>
        <div class="col-6 col-md-7 sign-out-wrapper clearfix">
            <a href="/login" class="sign-out pull-right">
                <span>Log Out</span>
                <i class="fa fa-sign-out"></i>
            </a>
        </div>
    </div>
</div>
</html>
<style>
    @import url("https://fonts.googleapis.com/css?family=Roboto+Mono:400,700");

    .wrapper {
        width: 30%;
        margin: 0 auto;
    }

    .logo {
        width: 50%;
    }

    .sign-out-wrapper {
        margin-right: 1em;
    }

    .sign-out {
        color: black;
        outline: none;
        text-decoration: none;
        transition: all 0.1s;
    }

    .sign-out:focus,
    .sign-out:hover,
    .sign-out:active {
        color: black;
        background-color: grey;
        text-decoration: none;
    }

    .sign-out > span {
        margin: 0.1em;
    }

</style>