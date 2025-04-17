<?php
require "../Common/pdo.php";
require "../Main/header.php";
?>

<body>
    <div class="wrapper">
        <style>
            .products {
                display: inline-block;
                text-align: center;
                padding: 14px;
                position: relative;
                height: 300px;
                background: white;
                color: #000;
            }

            .products img {
                margin: auto;
                display: block;
                background: white;
                image-rendering: auto;
                image-rendering: crisp-edges;
                width: auto;
                max-width: 170px;
                height: auto;
                max-height: 200px;
            }

            .products:hover {
                opacity: 0.5;
                transition: opacity .5s;
            }

            .content {
                position: relative;
                background: white;
                height: auto;
                padding-bottom: 50px;
                border-top: none;
            }

            .divhed {
                padding: 20px;
                font-family: Roboto;
                font-size: 32px;
                text-align: center;
                border-bottom: 1px solid #dcdcdc;
                margin-bottom: 50px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            nav.numbering {
                float: right;
            }

            @media(max-width:568px) {
                .products {
                    padding: 10px;
                    position: relative;
                    height: 280px;
                    background: white;
                    color: #000;
                }

                .products img {
                    margin: auto;
                    display: block;
                    background: white;
                    image-rendering: auto;
                    image-rendering: crisp-edges;
                    width: auto;
                    max-width: 160px;
                    height: auto;
                    max-height: 160px;
                }
            }

            @media(max-width:450px) {
                .products {
                    padding: 10px;
                    position: relative;
                    height: 260px;
                    background: white;
                    color: #000;
                }

                .products img {
                    margin: auto;
                    display: block;
                    background: white;
                    image-rendering: auto;
                    image-rendering: crisp-edges;
                    width: auto;
                    max-width: 130px;
                    height: auto;
                    max-height: 130px;
                }
            }

            @media(max-width:320px) {
                .products {
                    padding: 10px;
                    position: relative;
                    height: 260px;
                    width: 100%;
                    background: white;
                    color: #000;
                }

                .products img {
                    margin: auto;
                    display: block;
                    background: white;
                    image-rendering: auto;
                    image-rendering: crisp-edges;
                    width: auto;
                    max-width: 130px;
                    height: auto;
                    max-height: 130px;
                }
            }
        </style>
        <?php
        if (isset($_GET['category_id'])) {
            $ctid = $_GET['category_id'];
        } else {
            die("<div class='alert alert-danger'>You have not specified Category</div>");
        }
        $results_per_page = 12;
        //find the total number of results stored in the database
        $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ctid  GROUP BY item_description.item_id";
        $result = $pdo->query($query);
        $number_of_result = $result->rowCount();
        //determine the total number of pages available
        $number_of_page = ceil($number_of_result / $results_per_page);
        //determine which page number visitor is currently on
        if (!isset($_GET['pageno'])) {
            $pageno = 1;
        } else {
            $pageno = $_GET['pageno'];
        }
        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($pageno - 1) * $results_per_page;
        ?>
        <div class="content table1 col-sm-12">
            <div class="divhed">
                <?php
                $query6 = "SELECT * FROM category
where category_id=$ctid ";
                $st6 = $pdo->query($query6);
                $row6 = $st6->fetch(PDO::FETCH_ASSOC);
                ?><?= $row6['category_name'] ?>
            </div>
            <?php
            //display the link of the pages in URL
            
            $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ctid  GROUP BY item_description.item_id LIMIT " . $page_first_result . "," . $results_per_page;
            $st = $pdo->query($query);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                if (strlen($row['item_name']) >= 35) {
                    $item = $row['item_name'];
                    $item_name = substr($item, 0, 35) . "...";
                } else {
                    $item_name = $row['item_name'];
                }
                ?>
                <div class="products col-lg-3 col-sm-4 col-xs-6"
                    onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                    <div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"><img class="image"
                            align="middle"
                            src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                    </div>
                    <div class="deupd"><?= $item_name ?><br></div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="clearfix"> </div>
        <nav class="numbering">
            <ul class="pagination">
                <li class="<?php if ($pageno <= 1) {
                    echo 'disabled';
                } ?>">
                    <a id="prev" href="<?php if ($pageno <= 1) {
                        echo '#';
                    } else {
                        $_GET['pageno'] = $pageno - 1;
                        echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
                    } ?>">Prev</a>
                </li>
                <?php
                $ends_count = 1;  //how many items at the ends (before and after [...])
                $middle_count = 1;  //how many items before and after current page
                $dots = false;
                for ($page = 1; $page <= $number_of_page; $page++) {
                    if ($page == $pageno) {
                        ?>
                        <li class="active">
                            <a href="<?php
                            $_GET['pageno'] = $page;
                            echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
                                <?= $page ?></a>
                        </li>
                        <?php
                        $dots = true;
                    } else {
                        if ($page <= $ends_count || ($pageno && $page >= $pageno - $middle_count && $page <= $pageno + $middle_count) || $page > $number_of_page - $ends_count) {
                            ?>
                            <li>
                                <a href="<?php
                                $_GET['pageno'] = $page;
                                echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
                                    <?= $page ?></a>
                            </li>
                            <?php
                            $dots = true;
                        } elseif ($dots) {
                            ?>
                            <li><a>&hellip;</a></li><?php
                            $dots = false;
                        }
                    }
                    ?>
                    <?php
                }
                ?>
                <li class="<?php if ($pageno >= $number_of_page) {
                    echo 'disabled';
                } ?>">
                    <a id="next" href="<?php if ($pageno >= $number_of_page) {
                        echo '#';
                    } else {
                        $_GET['pageno'] = $pageno + 1;
                        echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
                    } ?>">Next</a>
                </li>
            </ul>
        </nav>
        <div class="clearfix">
        </div>
        <script>
            if ($(window).width() < 370) {
                $("#prev").html("<i class='fa fa-angle-double-left'></i>");
                $("#next").html("<i class='fa fa-angle-double-right'></i>");
            }
            else {
                $("#prev").html("Prev");
                $("#next").html("Next");
            }
            $(window).resize(function () {
                if ($(window).width() < 370) {
                    $("#prev").html("<i class='fa fa-angle-double-left'></i>");
                    $("#next").html("<i class='fa fa-angle-double-right'></i>");
                }
                else {
                    $("#prev").html("Prev");
                    $("#next").html("Next");
                }
            });
        </script>
        <?php
        require "../Main/footer.php";
        ?>