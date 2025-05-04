<?php
require "head.php";
?>

<body>
    <div class="wrapper">
        <?php
        include "head1.php";
        ?>
        <div class="table1">
            <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
                    class="fab fa-linode" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Categories
            </h4>
            <div id="jsGrid"></div>
        </div>
        <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
        <link type="text/css" rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
        <!-- jsGrid JS -->
        <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
        <script>
            $("#jsGrid").jsGrid({
                height: "auto",
                width: "100%",
                sorting: true,
                paging: false,
                autoload: true,
                controller: {
                    loadData: function (filter) {
                        console.log(filter);
                        return $.ajax({
                            type: "GET",
                            url: "getcategories.php",
                            data: filter,
                            dataType: "json"
                        });
                    }
                },
                fields: [
                    { name: "category_id", type: "hidden", css: 'hide' },
                    { name: "category_name", title: "Category", type: "text", width: 150 },
                ]
            });
        </script>
    </div>
</body>
<?php
require "foot.php";
?>