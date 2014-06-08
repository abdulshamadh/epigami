<?php
date_default_timezone_set("Asia/Kolkata");

function thousandsCurrencyFormat($num) {
    $x = round($num);
    $x_number_format = number_format($x);
    $x_array = explode(',', $x_number_format);
    $x_parts = array('k', 'm', 'b', 't');
    $x_count_parts = count($x_array) - 1;
    $x_display = $x;
    $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
    $x_display .= $x_parts[$x_count_parts - 1];
    return $x_display;
}
?>

<div class="span10 contentborder">
    <div class="row-fluid">
        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin') ?>">Admin Dashboard</a> <span class="divider">/</span></li>
                <li class="active">Dashboard</li>
                <li class="pull-right">
                    <p>
                        <?= date("F j, Y, g:i A") ?>
                    </p>
                </li>
            </ul>
        </div>
    </div>
    
    
</div>
