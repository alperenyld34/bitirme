<?php
function total_online()
{
    global $db;
    include "../../includes/config/config.php";
    $current_time = time();
    $timeout = $current_time - (80);

    $select_total = $db->prepare("SELECT * From total_visitors WHERE time>='$timeout'");
    $select_total->execute();
    $total_online_visitors = $select_total->rowCount();

    return $total_online_visitors;
}

if (isset($_POST['get_online_visitor']))
{
    $total_online = $total_online();
    echo $total_online;
    exit();
}

$total_online_visitors = total_online();
?>
<?php echo $total_online_visitors; ?>


