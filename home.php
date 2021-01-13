<?php
include 'server.php';
include 'navbar.php';

$_SESSION['category'] = $_GET['category'];
$category = $_SESSION['category'];

$limit = 3;
if (empty($category)) {
    $sql = "SELECT COUNT(post_ID) FROM posts";
} else {
    $sql = "SELECT COUNT(post_ID) FROM posts WHERE category='$category'";
}

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
$posts = $row[0];
$pages = ceil($posts / $limit);
?>
<title>Domov</title>
<div class="container">
    <div class="row " style="border: 3px solid black">
        <div class="col-lg-8 col-md-9" style="border-right: 3px solid black">
            <div id="target">

            </div>
            <ul class="pagination">
                <?php
                if (!empty($pages)) {
                    for ($i = 1; $i <= $pages; ++$i) {
                        ?>

                        <li class="page-item" id="<?php echo $i ?>"><a href="JavaScript:Void(0);"
                                                                       data-id="<?php echo $i; ?>"
                                                                       class="page-link"><?php echo $i; ?></a>
                        </li>

                        <?php
                    }
                }
                ?>
            </ul>
            <script>
                $(document).ready(function () {
                    $("#target").load("pagelimit.php?page=1");
                    $(".page-link").click(function () {
                        var id = $(this).attr("data-id");
                        var select_id = $(this).parent().attr("post_ID");
                        $.ajax({
                            url: "pagelimit.php",
                            type: "GET",
                            data: {
                                page: id
                            },
                            cache: false,
                            success: function (dataResult) {
                                $("#target").html(dataResult);
                                $(".pageitem").removeClass("active");
                                $("#" + select_id).addClass("active");
                            }
                        });
                    });
                });
            </script>
        </div>
        <div class="col-lg-4 col-md-3">
            <div class="row" style="padding: 0 20px;">
                <h2 style="text-align: center">Nadpis</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis
                    arcu rhoncus non. Aene</p>
            </div>
            <div class="row" style="padding: 0 20px;">
                <h2 style="text-align: center">Nadpis</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis
                    arcu rhoncus non. Aene</p>
            </div>
        </div>

    </div>
</div>
</body>
</html>