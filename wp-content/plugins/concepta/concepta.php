<?php
/**
 * @package Concepta
 */
/*
Plugin Name: Concepta Test
Plugin URI: https://github.com/evandrogtr/concepta
Description: Concepta Test
Author: Evandro Morini
Author URI: https://github.com/evandrogtr
Text Domain: concepta
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define( 'CONCEPTA_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Concepta', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Concepta', 'plugin_deactivation' ) );

require_once( CONCEPTA_DIR . 'class.token.php' );
require_once( CONCEPTA_DIR . 'class.ticket.php' );

function render()
{
   ?>
    <form id="concepta-form" name="concepta-form" action="" method="post">
        <div class="form-group row">
            <label for="cmb-destination" class="col-md-2 mb-2 col-form-label">Destination</label>
            <div class="col-md-4 mb-3">
                <select name="cmb-destination" id="cmb-destination" class="selectpicker form-control" required>
                <option value="">Select Destination</option>
                    <option value="MCO">MCO</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="cmb-language" class="col-md-2 mb-2 col-form-label">Language</label>
            <div class="col-md-4 mb-3">
                <select name="cmb-language" id="cmb-language" class="selectpicker form-control" required>
                    <option value="">Select Language</option>
                    <option value="ENG">English</option>
                </select>
            </div>
            <label for="cmb-currency" class="col-md-2 mb-2 col-form-label">Currency</label>
            <div class="col-md-4 mb-3">
                <select name="cmb-currency" id="cmb-currency" class="selectpicker form-control" required>
                    <option value="">Select Currency</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="date-from" class="col-md-2 mb-2 col-form-label">From</label>
            <div class="col-md-4 mb-3">
                <input name="date-from" id="date-from" class="form-control" type="date" required>
            </div>
            <label for="date-to" class="col-md-2 mb-2 col-form-label">To</label>
            <div class="col-md-4 mb-3">
                <input name="date-to" id="date-to" class="form-control" type="date" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="adult-count" class="col-md-2 mb-2 col-form-label">Adults</label>
            <div class="col-md-4 mb-3">
                <input name="adult-count" id="adult-count" class="form-control" type="number" required>
            </div>
            <label for="child-count" class="col-md-2 mb-2 col-form-label">Children</label>
            <div class="col-md-4 mb-3">
                <input name="child-count" id="child-count" class="form-control" type="number" required>
            </div>
        </div>
        <div id="child-age"></div>
        <div class="form-group row">
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
   <?php
}
add_shortcode('render', 'render');

function postHandler()
{
    $request = $_POST;

    if(!empty($request)) {
        $dateFrom = str_replace('/', '-', $request['date-from']);
        $dateTo = str_replace('/', '-', $request['date-to']);

        $arrBody = array(
            'Language'      => $request['cmb-language'],
            'Currency'      => $request['cmb-currency'],
            'destination'   => $request['cmb-destination'],
            'DateFrom'      => date('m/d/Y', strtotime($dateFrom)),
            'DateTO'        => date('m/d/Y', strtotime($dateTo)),
            'Occupancy' => array(
                'AdultCount'    => $request['adult-count'],
                'ChildCount'    => $request['child-count'],
                'ChildAges'     => $request['child-age']
            )
        );
        $strBody = json_encode($arrBody);

        $token = new Token();
        $ticket = new Ticket($token->getToken(), $token->getAuth(), $strBody);
        $response = $ticket->getResponse();
        //echo '<pre>';print_r($response);echo '</pre>';
        
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
?>
    <div class="container">
        <div class="row">
            <?php foreach ($response as $row) : ?>
                <?php 
                    foreach($row['TicketInfo']['ImageList'] as $img) {
                        if($img['Type'] === 'S') {
                            $imgSrc = $img['Url'];
                            break;
                        }
                    }
                ?>
                <div class="col-md-<?= $bootstrapColWidth; ?>">
                    <div class="card mb-<?= $bootstrapColWidth; ?> box-shadow">
                        <img class="card-img-top" data-src="<?= $imgSrc; ?>" src="<?= $imgSrc; ?>" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <p class="card-text">
                                <?=$row['TicketInfo']['Name'];?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
                $rowCount++;
                if($rowCount % $numOfCols == 0) 
                    echo '</div><div class="row">';
                endforeach;
            ?>
        </div>
    </div>
    <?php
    }
}
add_action( 'template_redirect', 'postHandler' );
